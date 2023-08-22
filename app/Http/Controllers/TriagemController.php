<?php

namespace App\Http\Controllers;

use App\Mail\EmailCandidatoAprovado;
use App\Mail\EmailCandidatoReprovado;
use App\Mail\EmailEntrevista;
use App\Mail\EmailTesteComportamental;
use App\Mail\EmailTestePratico;
use App\Models\Candidato;
use App\Models\Triagem;
use App\Models\Vaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TriagemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($id)
    {
        $vaga = Vaga::find($id);
        $triagem_analise_curriculo = Triagem::with('candidatos')->with('vagas')->where('triagems.analise_curriculo', true)->where('vaga_id', $id)->get();
        $triagem_teste_comportamental = Triagem::with('candidatos')->with('vagas')->where('triagems.teste_comportamental', true)->where('vaga_id', $id)->get();
        $triagem_teste_pratico = Triagem::with('candidatos')->with('vagas')->where('triagems.teste_pratico', true)->where('vaga_id', $id)->get();
        $triagem_entrevista = Triagem::with('candidatos')->with('vagas')->where('triagems.entrevista', true)->where('vaga_id', $id)->get();

        $has_candidados = false;

        if (count($triagem_analise_curriculo) + count($triagem_teste_comportamental) + count($triagem_teste_pratico) + count($triagem_entrevista) > 0) {
            $has_candidados = true;
        }

        return view('triagem/index', compact('vaga', 'has_candidados','triagem_analise_curriculo', 'triagem_teste_comportamental', 'triagem_teste_pratico', 'triagem_entrevista'));
    }

    public function triagem_teste_comportamental($id_candidato, $id_vaga)
    {

        $data['analise_curriculo'] = 0;
        $data['teste_comportamental'] = 1;
        $data['teste_pratico'] = 0;
        $data['entrevista'] = 0;

        $triagem_atualizada = Triagem::where('vaga_id', $id_vaga)
            ->where('candidato_id', $id_candidato)
            ->update($data);

        if ($triagem_atualizada) {
            $candidato = Candidato::find($id_candidato);

            $email = new EmailTesteComportamental(
                $candidato->nome
            );

            Mail::to($candidato->email)->send($email);

            return redirect()->route('triagem_vaga', ['id' => $id_vaga])->with('success','Candidato atualizado com sucesso!.');
        }

        return redirect()->route('triagem_vaga', ['id' => $id_vaga])->with('error','Não foi possível atualizar o candidato!.');
    }

    public function triagem_teste_pratico($id_candidato, $id_vaga)
    {

        $data['analise_curriculo'] = 0;
        $data['teste_comportamental'] = 0;
        $data['teste_pratico'] = 1;
        $data['entrevista'] = 0;

        $triagem_atualizada = Triagem::where('vaga_id', $id_vaga)
            ->where('candidato_id', $id_candidato)
            ->update($data);

        if ($triagem_atualizada) {
            $candidato = Candidato::find($id_candidato);

            $email = new EmailTestePratico(
                $candidato->nome
            );

            Mail::to($candidato->email)->send($email);

            return redirect()->route('triagem_vaga', ['id' => $id_vaga])->with('success','Candidato atualizado com sucesso!.');
        }

        return redirect()->route('triagem_vaga', ['id' => $id_vaga])->with('error','Não foi possível atualizar o candidato!.');
    }

    public function triagem_entrevista($id_candidato, $id_vaga)
    {

        $data['analise_curriculo'] = 0;
        $data['teste_comportamental'] = 0;
        $data['teste_pratico'] = 0;
        $data['entrevista'] = 1;

        $triagem_atualizada = Triagem::where('vaga_id', $id_vaga)
            ->where('candidato_id', $id_candidato)
            ->update($data);

        if ($triagem_atualizada) {
            $candidato = Candidato::find($id_candidato);

            $email = new EmailEntrevista(
                $candidato->nome
            );

            Mail::to($candidato->email)->send($email);
            return redirect()->route('triagem_vaga', ['id' => $id_vaga])->with('success','Candidato atualizado com sucesso!.');
        }

        return redirect()->route('triagem_vaga', ['id' => $id_vaga])->with('error','Não foi possível atualizar o candidato!.');
    }

    public function eliminar_candidato($id_candidato, $id_vaga)
    {
        $data['analise_curriculo'] = 0;
        $data['teste_comportamental'] = 0;
        $data['teste_pratico'] = 0;
        $data['entrevista'] = 0;
        $data['reprovado'] = 1;

        $triagem_atualizada = Triagem::where('vaga_id', $id_vaga)
            ->where('candidato_id', $id_candidato)
            ->update($data);

        if ($triagem_atualizada) {
            $candidato = Candidato::find($id_candidato);
            $vaga = Vaga::find($id_vaga);

            $email = new EmailCandidatoReprovado(
                $candidato->nome,
                $vaga->nome,
            );

            Mail::to($candidato->email)->send($email);

            return redirect()->route('triagem_vaga', ['id' => $id_vaga])->with('success','Candidato Eliminado!.');
        }

        return redirect()->route('triagem_vaga', ['id' => $id_vaga])->with('error','Não foi possível atualizar o candidato!.');
    }

    public function aprovar_candidato($id_candidato, $id_vaga)
    {
        $data['analise_curriculo'] = 0;
        $data['teste_comportamental'] = 0;
        $data['teste_pratico'] = 0;
        $data['entrevista'] = 0;
        $data['reprovado'] = 0;
        $data['aprovado'] = 1;

        $triagem_atualizada = Triagem::where('vaga_id', $id_vaga)
            ->where('candidato_id', $id_candidato)
            ->update($data);

        if ($triagem_atualizada) {
            $candidato = Candidato::find($id_candidato);
            $vaga = Vaga::find($id_vaga);

            $email = new EmailCandidatoAprovado(
                $candidato->nome,
                $vaga->nome,
            );

            Mail::to($candidato->email)->send($email);

            return redirect()->route('triagem_vaga', ['id' => $id_vaga])->with('success','O candidato foi aprovado!.');
        }

        return redirect()->route('triagem_vaga', ['id' => $id_vaga])->with('error','Não foi possível atualizar o candidato!.');
    }
}
