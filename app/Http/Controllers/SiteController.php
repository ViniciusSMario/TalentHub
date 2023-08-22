<?php

namespace App\Http\Controllers;

use App\Mail\EmailCandidatoCadastrado;
use App\Models\Candidato;
use App\Models\State;
use App\Models\Triagem;
use App\Models\Vaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SiteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $vagas = Vaga::all();

        return view('site/welcome', compact('vagas'));
    }

    public function visualizar($id)
    {
        $vaga = Vaga::find($id);
        return view('site/visualizar', compact('vaga'));
    }

    public function candidatar($id)
    {
        $vaga = Vaga::find($id);
        $estados = State::pluck('letter','id');
        return view('site/candidatar', compact('vaga', 'estados'));
    }

    public function aplicar(Request $request)
    {
        $request->validate([
            'nome' =>'required',
            'email' => 'required|email',
            'url_curriculo' => 'required',
            'data_nascimento' =>'required|date',
            'endereco' =>'required',
            'numero' =>'required',
            'bairro' =>'required',
            'cidade' =>'required',
            'estado' =>'required',
            'telefone_contato' =>'required',
            'vaga_id' =>'required',
        ]);

        $candidato_existente = Candidato::where('vaga_id', $request->vaga_id)->where('email', $request->email)->first();

        if (!empty($candidato_existente)) {
            return redirect()->route('vaga_candidatar', ['id' => $request->vaga_id])->with('error','Já existe um candidato cadastrado com esse e-mail para esta vaga!.');
        }

        if($request->hasFile('url_curriculo')){
            // Get filename with the extension
            $filenameWithExt = $request->file('url_curriculo')->getClientOriginalName();
            // Get just filename
            $filename = str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME));
            // Get just ext
            $extension = $request->file('url_curriculo')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('url_curriculo')->storeAs('public/curriculos', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.pdf';
        }

        $candidato = Candidato::create([
            'nome' => $request->nome,
            'email' => trim($request->email),
            'url_curriculo' => $fileNameToStore,
            'sexo' => $request->sexo,
            'data_nascimento' => $request->data_nascimento,
            'url_linkedin' => $request->url_linkedin,
            'url_site' => $request->url_site,
            'url_instagram' => $request->url_instagram,
            'url_facebook' => $request->url_facebook,
            'endereco' => $request->endereco,
            'numero' => $request->numero,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
            'telefone_contato' => $request->telefone_contato,
            'estado_civil' => $request->estado_civil,
            'referencias' => $request->referencias,
            'informacoes_adicionais' => $request->informacoes_adicionais,
            'vaga_id' =>$request->vaga_id
        ]);

        if ($candidato){
            Triagem::create([
                'vaga_id' => $request->vaga_id,
                'candidato_id' => $candidato->id
            ]);

            $vaga = Vaga::find($candidato->vaga_id);

            $email = new EmailCandidatoCadastrado(
                $candidato->nome,
                $vaga->nome,
            );

            Mail::to($candidato->email)->send($email);

            return redirect()->route('vaga_visualizar', ['id' => $request->vaga_id])->with('success','Candidatura enviada com sucesso! Confira seu e-mail e aguarde os próximos passos.');
        }
        return redirect()->route('vaga_visualizar', ['id' => $request->vaga_id])->with('error','Não foi possível candidatar-se a esta vaga!.');
    }
}
