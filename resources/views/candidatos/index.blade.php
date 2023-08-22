@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                </div>
                <h2 class="text-center mt-4 section-title">
                    Listagem de Candidatos
                </h2>

                <div class="row">
                    <div class="col-md-12">
                        <form method="GET">
                            <div class="row my-2">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" id="filter" name="filter" placeholder="Nome do Candidato, E-mail ou nome da vaga" value="{{$filter}}">
                                </div>
                                <div class="col-md-2 text-center">
                                    <button type="submit" class="btn btn-outline-success w-100">Filtrar</button>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="table-dark">
                                    <tr class="text-center">
                                        <th class="py-3" scope="col">#</th>
                                        <th class="py-3" scope="col">Candidato</th>
                                        <th class="py-3" scope="col">E-mail</th>
                                        <th class="py-3" scope="col">Vaga</th>
                                        <th class="py-3" scope="col">Fase</th>
                                        <th class="py-3" scope="col">Gênero</th>
                                        <th class="py-3" scope="col">Data de nascimento</th>
                                        <th class="py-3" scope="col">Currículo</th>
                                        <th class="py-3" scope="col">Data de Cadastro</th>
                                        <th class="py-3" scope="col">Perfil</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($candidatos as $candidato)
                                    <tr>
                                        <th class="py-3" scope="row">{{$candidato->id}}</th>
                                        <td class="py-3">{{$candidato->nome}}</td>
                                        <td class="py-3">{{$candidato->email}}</td>
                                        <td class="py-3">{{$candidato->vagas->nome}}</td>
                                        <td class="py-3">
                                            @if (isset($candidato->triagems->analise_curriculo) && $candidato->triagems->analise_curriculo == true)
                                            <span class="fw-bold">Análise de Currículo</span>
                                            @endif
                                            @if (isset($candidato->triagems->teste_comportamental) && $candidato->triagems->teste_comportamental == true)
                                            <span class="fw-bold">Teste Comportamental</span>
                                            @endif
                                            @if (isset($candidato->triagems->teste_pratico) && $candidato->triagems->teste_pratico == true)
                                            <span class="fw-bold">Teste Prático</span>
                                            @endif
                                            @if (isset($candidato->triagems->entrevista) && $candidato->triagems->entrevista == true)
                                            <span class="fw-bold">Entrevista</span>
                                            @endif
                                            @if (isset($candidato->triagems->reprovado) && $candidato->triagems->reprovado == true)
                                            <span class="text-danger fw-bold">Reprovado</span>
                                            @endif
                                            @if (isset($candidato->triagems->aprovado) && $candidato->triagems->aprovado == true)
                                            <span class="text-success fw-bold">Aprovado</span>
                                        @endif
                                        </td>
                                        <td class="py-3">{{ Str::upper($candidato->sexo)}}</td>
                                        <td class="py-3">{{ date_format(date_create($candidato->data_nascimento), 'd/m/Y')}}</td>
                                        <td class="py-3"><a class="btn btn-primary btn-sm" href="{{ route('baixar_curriculo', ['url_curriculo' => $candidato->url_curriculo]) }}" target="_blank"> Baixar <i class="bi bi-download"></i></a></td>
                                        <td class="py-3">{{ date_format(date_create($candidato->created_at), 'd/m/Y')}}</td>
                                        <td class="py-3"><a class="btn btn-warning text-white" href="{{ route('perfil_candidato', ['id' => $candidato->id])}}"> <i class="bi bi-eye"></i></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- {{ dd($candidatos) }} --}}
                    <div class="d-flex justify-content-start">
                        {{ "Mostrando " . count($candidatos) . "  de  " . $candidatos->total() }}
                    </div>
                    <div class="d-flex justify-content-center">
                        {!! $candidatos->appends(Request::except('page'))->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

