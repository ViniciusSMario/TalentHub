@extends('layouts.app')

@section('content')
<div class="container-fluid vh-100">
        <div class="pageLoader" id="pageLoader"></div>
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center section-title">
                    Triagem da vaga: {{$vaga->nome}} #{{$vaga->id}}
                </h2>
                <hr>
                @if ($has_candidados == false)
                    <div class="row">
                        <h2 class="text-center">Nenhum candidato para esta vaga ainda! :(</h2>
                    </div>
                @else
                    <div class="row">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <div class="col-md-3 mt-3 border-start border-end">
                            <h3 class="text-center triagem-title">Análise de Currículo</h3>
                            @foreach ($triagem_analise_curriculo as $triagem)
                                <div class="card-triagem mt-3">
                                    <div class="card-triagem-title text-center text-uppercase">
                                        <h4 class="fw-bold">
                                            {{$triagem->candidatos->nome}}
                                        </h4>
                                    </div>
                                    <div class="card-triagem-description">
                                        <ul class="list-unstyled text-center">
                                            <li>Data de Nascimento: {{ date_format(date_create($triagem->candidatos->data_nascimento), 'd/m/Y')}}</li>
                                            <li><a class="btn btn-secondary text-center mt-3" href="{{ route('baixar_curriculo', ['url_curriculo' => $triagem->candidatos->url_curriculo]) }}" target="_blank">Baixar CV <i class="bi bi-download"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="card-triagem-footer-admin">
                                        <div class="row text-center">
                                            <div class="col-md-5 mt-1">
                                                <a href="{{ route('eliminar_candidato', ['id_candidato' => $triagem->candidatos->id, 'id_vaga' => $triagem->vagas->id]) }}" class="btn btn-danger w-100">
                                                    Eliminar
                                                    <i class="bi bi-x-circle"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-7 mt-1">
                                                <a href="{{ route('triagem_teste_comportamental', ['id_candidato' => $triagem->candidatos->id, 'id_vaga' => $triagem->vagas->id]) }}" class="btn btn-success w-100">
                                                    Próxima fase
                                                    <i class="bi bi-arrow-right-circle-fill"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-md-3 mt-3 border-start border-end">
                            <h3 class="text-center triagem-title">Teste Comportamental</h3>
                            @foreach ($triagem_teste_comportamental as $triagem)
                                <div class="card-triagem mt-3">
                                    <div class="card-triagem-title text-center text-uppercase">
                                        <h4 class="fw-bold">
                                            {{$triagem->candidatos->nome}}
                                        </h4>
                                    </div>
                                    <div class="card-triagem-description">
                                        <ul class="list-unstyled text-center">
                                            <li>Data de Nascimento: {{ date_format(date_create($triagem->candidatos->data_nascimento), 'd/m/Y')}}</li>
                                            <li><a class="btn btn-secondary text-center mt-3" href="{{ route('baixar_curriculo', ['url_curriculo' => $triagem->candidatos->url_curriculo]) }}" target="_blank">Baixar CV <i class="bi bi-download"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="card-triagem-footer-admin">
                                        <div class="row text-center">
                                            <div class="col-md-5 mt-1">
                                                <a href="{{ route('eliminar_candidato', ['id_candidato' => $triagem->candidatos->id, 'id_vaga' => $triagem->vagas->id]) }}" class="btn btn-danger w-100">
                                                    Eliminar
                                                    <i class="bi bi-x-circle"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-7 mt-1">
                                                <a href="{{ route('triagem_teste_pratico', ['id_candidato' => $triagem->candidatos->id, 'id_vaga' => $triagem->vagas->id]) }}" class="btn btn-success w-100">
                                                    Próxima fase
                                                    <i class="bi bi-arrow-right-circle-fill"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-md-3 mt-3 border-start border-end">
                            <h3 class="text-center triagem-title">Teste Prático</h3>
                            @foreach ($triagem_teste_pratico as $triagem)
                                <div class="card-triagem mt-3">
                                    <div class="card-triagem-title text-center text-uppercase">
                                        <h4 class="fw-bold">
                                            {{$triagem->candidatos->nome}}
                                        </h4>
                                    </div>
                                    <div class="card-triagem-description">
                                        <ul class="list-unstyled text-center">
                                            <li>Data de Nascimento: {{ date_format(date_create($triagem->candidatos->data_nascimento), 'd/m/Y')}}</li>
                                            <li><a class="btn btn-secondary text-center mt-3" href="{{ route('baixar_curriculo', ['url_curriculo' => $triagem->candidatos->url_curriculo]) }}" target="_blank">Baixar CV <i class="bi bi-download"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="card-triagem-footer-admin">
                                        <div class="row text-center">
                                            <div class="col-md-5 mt-1">
                                                <a href="{{ route('eliminar_candidato', ['id_candidato' => $triagem->candidatos->id, 'id_vaga' => $triagem->vagas->id]) }}" class="btn btn-danger w-100">
                                                    Eliminar
                                                    <i class="bi bi-x-circle"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-7 mt-1">
                                                <a href="{{ route('triagem_entrevista', ['id_candidato' => $triagem->candidatos->id, 'id_vaga' => $triagem->vagas->id]) }}" class="btn btn-success w-100">
                                                    Próxima fase
                                                    <i class="bi bi-arrow-right-circle-fill"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-md-3 mt-3 border-start border-end">
                            <h3 class="text-center triagem-title">Entrevista</h3>
                            @foreach ($triagem_entrevista as $triagem)
                                <div class="card-triagem mt-3">
                                    <div class="card-triagem-title text-center text-uppercase">
                                        <h4 class="fw-bold">
                                            {{$triagem->candidatos->nome}}
                                        </h4>
                                    </div>
                                    <div class="card-triagem-description">
                                        <ul class="list-unstyled text-center">
                                            <li>Data de Nascimento: {{ date_format(date_create($triagem->candidatos->data_nascimento), 'd/m/Y')}}</li>
                                            <li><a class="btn btn-secondary text-center mt-3" href="{{ route('baixar_curriculo', ['url_curriculo' => $triagem->candidatos->url_curriculo]) }}" target="_blank">Baixar CV <i class="bi bi-download"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="card-triagem-footer-admin">
                                        <div class="row text-center">
                                            <div class="col-md-6 mt-1">
                                                <a href="{{ route('eliminar_candidato', ['id_candidato' => $triagem->candidatos->id, 'id_vaga' => $triagem->vagas->id]) }}" class="btn btn-danger w-100">
                                                    Reprovar
                                                    <i class="bi bi-x-circle"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-6 mt-1">
                                                <a href="{{ route('aprovar_candidato', ['id_candidato' => $triagem->candidatos->id, 'id_vaga' => $triagem->vagas->id]) }}" class="btn btn-success w-100">
                                                    Aprovar
                                                    <i class="bi bi-check-circle"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(window).on('beforeunload', function(){
            $('#pageLoader').show();
        });

        $(function () {
            $('#pageLoader').hide();
        })
    });
</script>
