<?php

namespace App\Http\Controllers;

use App\Models\Vaga;
use Illuminate\Http\Request;

class VagaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
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
            $vagas = Vaga::where('vagas.nome', 'like', '%'.$filter.'%')->get();
        }else {
            $vagas = Vaga::all();
        }
        return view('vagas/index', compact('vagas', 'filter'));
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
            return redirect()->route('vagas_index')->with('success','Vaga criada com sucesso!.');
        }
        return redirect()->route('vagas_index')->with('error','Não foi possível criar a vaga!.');
    }

    public function edit($id)
    {
        $vaga = Vaga::find($id);

        if (empty($vaga)){
            return redirect()->route('vagas_index')->with('error','Vaga não cadastrada!');
        }

        $count_vaga_com_inscritos = Vaga::withCount('candidatos')->where('vagas.id', $id)->first();

        if ($count_vaga_com_inscritos->candidatos_count > 0) {
            return redirect()->route('vagas_index')->with('error','Não é possível editar uma vaga que já possui candidatos!');
        }

        return view('vagas/edit', compact('vaga'));
    }

    public function update(Request $request)
    {
        $vaga = Vaga::find($request->id);

        if (empty($vaga)){
            return redirect()->route('vagas_index')->with('error','Vaga não cadastrada!');
        }

        $count_vaga_com_inscritos = Vaga::withCount('candidatos')->where('vagas.id', $vaga->id)->first();

        if ($count_vaga_com_inscritos->candidatos_count > 0) {
            return redirect()->route('vagas_index')->with('error','Não é possível editar uma vaga que já possui candidatos!');
        }

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

        $vaga->nome = $request->nome;
        $vaga->descricao = $request->descricao;
        $vaga->tipo_vaga = $request->tipo_vaga;
        $vaga->nivel = $request->nivel;
        $vaga->atividades = $request->atividades;
        $vaga->pre_requisitos = $request->pre_requisitos;
        $vaga->beneficios = $request->beneficios;
        $vaga->datahora_fechamento = $request->datahora_fechamento;
        $vaga->empresa = $request->empresa;
        $vaga->remuneracao = $request->remuneracao;

        if ($vaga->update(array($vaga))){
            return redirect()->route('vagas_index')->with('success','Vaga atualizada com sucesso!');
        }
        return redirect()->route('vagas_index')->with('error','Não foi possível atualizar a vaga!');
    }

    public function destroy($id)
    {
        $vaga = Vaga::find($id);

        if (empty($vaga)){
            return redirect()->route('vagas_index')->with('error','Vaga não cadastrada!');
        }

        $count_vaga_com_inscritos = Vaga::withCount('candidatos')->where('vagas.id', $id)->first();

        if ($count_vaga_com_inscritos->candidatos_count > 0 && strtotime($vaga->datahora_fechamento) >= strtotime(now())) {
            return redirect()->route('vagas_index')->with('error','Não é possível excluir uma vaga que já possui candidatos!');
        }

        if ($vaga->delete()) {
            return redirect()->route('vagas_index')->with('success','Vaga excluida com sucesso!');
        }

        return redirect()->route('vagas_index')->with('error','Não foi possível excluir a vaga!');
    }
}
