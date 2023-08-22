<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use App\Models\City;
use App\Models\Vaga;
use Illuminate\Http\Request;

class CandidatoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['cidade_por_estado']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter');

        if (!empty($filter)) {
            $candidatos = Candidato::with('vagas')
                ->with('triagems')
                ->where('candidatos.nome', 'like', '%'.$filter.'%')
                ->orWhere('candidatos.email', 'like', '%'.$filter.'%')
                ->orWhereHas('vagas', function ($query) use ($filter) {
                    return $query->Where('vagas.nome', 'like', '%'.$filter.'%');
                })
                ->paginate(5);

        }else {
            $candidatos = Candidato::with('vagas')->with('triagems')->paginate(5);
        }
        return view('candidatos/index', compact('candidatos', 'filter'));
    }

    public function create()
    {
        return view('vagas/create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'tipo_vaga' => 'required',
            'nivel' => 'required',
            'atividades' => 'required',
            'pre_requisitos' => 'required',
            'beneficios' => 'required',
            'datahora_fechamento' => 'required',
        ]);

        if (Vaga::create($request->post())){
            return redirect()->route('vagas_index')->with('success','Vaga criada com sucesso!');
        }
        return redirect()->route('vagas_index')->with('error','Não foi possível criar a vaga!');
    }

    public function baixar_curriculo($url_curriculo)
    {
        return response()->download(storage_path("app/public/curriculos/" . $url_curriculo));
    }

    public function cidade_por_estado(Request $request)
    {
        $cidades = City::where('cities.state_id', $request->id_estado)->pluck('title','id');

        return $cidades;
    }

    public function perfil_candidato($id)
    {
        $candidato = Candidato::with('vagas')
            ->join('triagems', 'triagems.candidato_id', 'candidatos.id')
            ->leftJoin('states', 'states.id', 'candidatos.estado')
            ->leftJoin('cities', 'cities.id', 'candidatos.cidade')
            ->where('candidatos.id', $id)
            ->first();

        return view('candidatos/perfil_candidato', compact('candidato'));
    }
}
