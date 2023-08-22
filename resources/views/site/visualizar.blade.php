<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ asset('images/logo.png')}}" type="image/x-icon">

        <title>TalentHub</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- CSS do Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <!-- JavaScript do Bootstrap (jQuery é obrigatório para o funcionamento do carousel) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }

            .banner {
                height: 450px;
                width: 100%;
                background-color: #000;
                background-position: center center;
                background-repeat: no-repeat;
                background-size: cover;
                background-image: url('https://www.benner.com.br/wp-content/uploads/2022/04/quais-as-tendencias-do-rh-4-0.jpeg')
            }

            .banner-text {
                border: #000 solid 0px;
                background-color: #052c65;
            }

            .footer {
                height: 100%;
                width: 100%;
                background-color: #052c65;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.png')}}" width="100px" alt="Logo TalentHub">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('welcome') }}">{{ __('Página inicial') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="banner"></div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
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

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="text-center">
                                <h1> {{$vaga->nome }} </h1>
                                <h4> Nível: <span class="text-uppercase"> {{$vaga->nivel }} | {{$vaga->tipo_vaga}} </span></h4>
                                @if (isset($vaga->remuneracao) && !empty($vaga->remuneracao))
                                    <h4> Remuneração: R$ <span> {{$vaga->remuneracao }}</span></h4>
                                @endif
                            </div>
                            <hr>
                            <div>
                                <span class="vaga_titulo">Descrição da vaga:</span>
                                <p class="text-justify vaga_texto"> {{$vaga->descricao }} </p>
                            </div>
                            <div>
                                <span class="vaga_titulo">Principais atividades e responsabilidades:</span>
                                <p class="text-justify vaga_texto"> {{$vaga->atividades }} </p>
                            </div>
                            <div>
                                <span class="vaga_titulo">Pré-requisitos da vaga:</span>
                                <p class="text-justify vaga_texto"> {{ $vaga->pre_requisitos }} </p>
                            </div>
                            <div>
                                <span class="vaga_titulo">Benefícios da vaga:</span>
                                <p class="text-justify vaga_texto"> {{ $vaga->beneficios }} </p>
                            </div>
                            @if (isset($vaga->empresa) && !empty($vaga->empresa))
                                <div>
                                    <span class="vaga_titulo">Empresa:</span>
                                    <span class="text-justify vaga_texto"> {{ $vaga->empresa }} </span>
                                </div>
                            @endif
                            <div class="text-start">
                                <span class="vaga_texto">Data limite da vaga: {{ date_format(date_create($vaga->datahora_fechamento), 'd/m/Y') }}</span>
                            </div>
                            @if (strtotime($vaga->datahora_fechamento) <= strtotime(now()))
                                <div class="text-center border border-info bg-info-subtle rounded-4 p-3">
                                    <h2>O período de recrutamento expirou!</h2>
                                </div>
                            @else
                                <div class="text-center border border-info bg-info-subtle rounded-4 p-3">
                                    <h2>Quero aplicar para a vaga {{$vaga->nome}}</h2>
                                    <a class="btn btn-info text-center text-white" href="{{route('vaga_candidatar', ['id' => $vaga->id])}}">Candidatar-se a esta vaga</a>
                                </div>
                            @endif

                            <div class="row mt-3 text-center">
                                <span> &copy Todos os direitos reservados | <script> date = new Date().getFullYear(); document.write(date); </script> </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

