@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p class="text-center">{{ $message }}</p>
                        </div>
                    @endif
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger">
                            <p class="text-center">{{ $message }}</p>
                        </div>
                    @endif
                </div>
                <h2 class="text-center section-title">
                    Listagem de vagas
                </h2>

                <div class="row">
                    <div class="col-md-12">
                        <form method="GET">
                            <div class="row my-2">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" id="filter" name="filter" placeholder="Nome da Vaga" value="{{$filter}}">
                                </div>
                                <div class="col-md-2 text-center">
                                    <button type="submit" class="btn btn-outline-success w-100">Filtrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row mt-4">
                    @if (count($vagas) <= 0)
                        <div class="col-md-12">
                            <h2 class="text-center">Não há vagas cadastradas</h2>
                        </div>
                    @else
                        @foreach ($vagas as $vaga)
                            <div class="col-md-4">
                                <div class="card-candidato bg-light">
                                    <div class="card-candidato-title">
                                        <h3 class="text-center"> {{$vaga->nome }} </h3>
                                        @if (strtotime($vaga->datahora_fechamento) <= strtotime(now()))
                                            <h3 class="text-center fw-bold text-danger"> Vaga fora do prazo de inscrição! </h3>
                                        @endif
                                    </div>
                                    <div class="card-candidato-descricao" style="min-height: 280px">
                                        <p class="text-center">Nível: <span class="text-uppercase"> {{$vaga->nivel }} | {{$vaga->tipo_vaga}} </span></p>
                                        <p class="text-justify">Descrição: {{$vaga->descricao }} </p>
                                        <p class="text-justify">Fechamento: {{ date_format(date_create($vaga->datahora_fechamento), 'd/m/Y H:i') }} </p>
                                    </div>
                                    <div class="card-candidato-footer-admin">
                                        <div class="row text-center">
                                            @if (strtotime($vaga->datahora_fechamento) >= strtotime(now()))
                                            <div class="col-md-4">
                                                <a class="btn btn-warning" href="{{route('triagem_vaga', ['id' => $vaga->id])}}">
                                                    Triagem
                                                    <i class="bi bi-rocket-takeoff"></i>
                                                </a>
                                            </div>
                                            @else
                                            <div class="col-md-4"></div>
                                            @endif
                                            <div class="col-md-4">
                                                <a class="btn btn-success" href="{{route('vagas_edit', ['id' => $vaga->id])}}">
                                                    Editar
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-4">
                                                <a class="btn btn-danger" href="{{route('vagas_delete', ['id' => $vaga->id])}}">
                                                    Excluir <i class="bi bi-x-circle"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

