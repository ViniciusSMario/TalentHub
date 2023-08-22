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
                    Informações do candidato
                </h2>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card-candidato">
                            <div class="card-candidato-title">
                                <h3 class="text-center">
                                    {{$candidato->nome}} ({{$candidato->email}}) <br> Vaga: #{{$candidato->vagas->id}} - {{$candidato->vagas->nome}}
                                </h3>
                            </div>
                            <div class="card-candidato-description">
                                <ul class="list-unstyled" style="font-size:16px">
                                    <li>
                                        Fase:
                                        @if (isset($candidato->analise_curriculo) && $candidato->analise_curriculo == true)
                                            <span class="fw-bold">Análise de Currículo</span>
                                        @endif
                                        @if (isset($candidato->teste_comportamental) && $candidato->teste_comportamental == true)
                                            <span class="fw-bold">Teste Comportamental</span>
                                        @endif
                                        @if (isset($candidato->teste_pratico) && $candidato->teste_pratico == true)
                                            <span class="fw-bold">Teste Prático</span>
                                        @endif
                                        @if (isset($candidato->entrevista) && $candidato->entrevista == true)
                                            <span class="fw-bold">Entrevista</span>
                                        @endif
                                        @if (isset($candidato->reprovado) && $candidato->reprovado == true)
                                            <span class="text-danger fw-bold">Reprovado</span>
                                        @endif
                                        @if (isset($candidato->aprovado) && $candidato->aprovado == true)
                                            <span class="text-success fw-bold">Aprovado</span>
                                        @endif
                                    </li>

                                    @if (isset($candidato->sexo) && !empty($candidato->sexo))
                                        <li>Gênero: <span class="text-uppercase"> {{$candidato->sexo}} </span></li>
                                    @endif
                                    <li>Data de Nascimento: {{ date_format(date_create($candidato->data_nascimento), 'd/m/Y')}}</li>
                                    <li>Endereço: {{$candidato->endereco}}, {{$candidato->numero}}, {{$candidato->bairro }}</li>
                                    <li>Cidade: {{ isset($candidato->title) ? $candidato->title : $candidato->cidade }} - {{isset($candidato->letter) ? $candidato->letter : $candidato->estado}}</li>
                                    @if (isset($candidato->referencias) && !empty($candidato->referencias))
                                        <li>Referência: {{$candidato->referencias}}</li>
                                    @endif
                                    @if (isset($candidato->informacoes_adicionais) && !empty($candidato->informacoes_adicionais))
                                        <li>Informações Adicionais: {{$candidato->informacoes_adicionais}}</li>
                                    @endif
                                    @if (isset($candidato->estado_civil) && !empty($candidato->estado_civil))
                                        <li>Estado Civil: <span class="text-uppercase">{{$candidato->estado_civil}}</span></li>
                                    @endif
                                    @if (isset($candidato->telefone_contato) && !empty($candidato->telefone_contato))
                                        <li>Cel.: {{$candidato->telefone_contato}}</li>
                                    @endif
                                    <li>
                                    @if (isset($candidato->url_linkedin) && !empty($candidato->url_linkedin))
                                        <a class="btn btn-primary" target="_blank" href="{{$candidato->url_linkedin}}"><i class="bi bi-linkedin"></i>  Linkedin</a>
                                    @endif
                                    @if (isset($candidato->url_site) && !empty($candidato->url_site))
                                        <a class="btn btn-primary" target="_blank" href="{{$candidato->url_site}}"><i class="bi bi-laptop"></i> Site/Portifólio</a>
                                    @endif
                                    @if (isset($candidato->url_instagram) && !empty($candidato->url_instagram))
                                        <a class="btn btn-primary" target="_blank" href="{{$candidato->url_instagram}}"><i class="bi bi-instagram"></i> Instagram</a>
                                    @endif
                                    @if (isset($candidato->url_facebook) && !empty($candidato->url_facebook))
                                        <a class="btn btn-primary" target="_blank" href="{{$candidato->url_facebook}}"><i class="bi bi-facebook"></i> Facebook</a>
                                    @endif
                                    </li>
                                </ul>
                            </div>
                            <div class="card-vaga-footer text-end">
                                <a class="btn btn-success" href="{{ route('baixar_curriculo', ['url_curriculo' => $candidato->url_curriculo]) }}" target="_blank">Baixar currículo <i class="bi bi-eye"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

