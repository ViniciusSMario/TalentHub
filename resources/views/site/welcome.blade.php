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
                font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
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
                        <li class="nav-item">
                            <a class="nav-link" href="#sobre">{{ __('Sobre nós') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#missao">{{ __('Missão') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#vagas">{{ __('Vagas') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="banner"></div>

        <div class="text-center">
            <h1 class="banner-text text-white py-1">TalentHub <br> Onde talentos e oportunidades se encontram</h1>
        </div>

        <div class="container">
            <div class="row" id="sobre">
                <div class="col-md-12">
                    <span class="mt-5 section-title">Sobre nós</span>
                    <p>Somos uma equipe de profissionais apaixonados por Recursos Humanos, especializados em conectar talentos promissores a empresas inovadoras e em crescimento. Nossa abordagem centrada nas pessoas nos torna únicos no mercado, permitindo que cada candidato seja tratado como um indivíduo único, com suas próprias habilidades, experiências e aspirações.</p>
                    <hr>

                    <span id="missao" class="section-title">Nossa missão</span>
                    <p>Nossa missão é ir além da simples conexão entre candidatos e empresas. Buscamos criar relações duradouras e benéficas para ambas as partes, construindo pontes que impulsionem o crescimento profissional dos indivíduos e o sucesso das empresas. Acreditamos no poder do talento e na importância de alinhar as aspirações de cada profissional com a visão de cada empresa.</p>
                    <hr>

                    <p>Estamos entusiasmados em ajudá-lo em sua jornada em busca de talentos ou oportunidades de emprego. Junte-se a nós e experimente o diferencial de nosso Site de Recrutamento e Seleção. Seja qual for o seu objetivo, estamos aqui para tornar sua busca mais eficaz, gratificante e bem-sucedida.</p>
                    <hr>
                </div>
            </div>
            <div class="row" id="vagas">
                <span class="text-center section-title mb-3">Nossas vagas em aberto</span>
                @foreach ($vagas as $vaga)
                    @if (strtotime($vaga->datahora_fechamento) >= strtotime(now()))
                        <div class="col-md-4">
                            <div class="card-vaga bg-white">
                                <div class="card-vaga-title row">
                                    <div class="col-md-3 text-center">
                                        <img src="{{asset('images/logo.png')}}" width="100px" alt="TalentHub Logo">
                                    </div>
                                    <div class="col-md-9">
                                        <h3 class="text-center">{{ $vaga->nome }} </h3>
                                    </div>
                                    <div class="row col-md-12 text-center">
                                        <p class="mt-2">Nível: <span class="text-uppercase"> {{$vaga->nivel }} | {{$vaga->tipo_vaga}} </span></p>
                                    </div>
                                </div>
                                <div class="card-vaga-descricao">
                                    <p class="text-justify">Descrição: {{$vaga->descricao }} </p>
                                    <p class="text-justify">Fechamento: {{ date_format(date_create($vaga->datahora_fechamento), 'd/m/Y H:i') }} </p>
                                </div>
                                <div class="card-vaga-footer">
                                    <a class="btn rounded-5" href="{{route('vaga_visualizar', ['id' => $vaga->id])}}">Ver vaga <i class="bi bi-eye"></i></a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

        </div>
        <div class="footer">
            <div class="container">
                <div class="row mt-5 text-white">
                    <div class="col-md-4 mt-3 text-center">
                        <h4>Redes sociais</h4>
                        <ul class="list-unstyled">
                            <li>Instagram</li>
                            <li>Facebook</li>
                            <li>LinkedIn</li>
                        </ul>
                    </div>
                    <div class="col-md-4 mt-3 text-center">
                        <h4>Links Úteis</h4>
                        <ul class="list-unstyled">
                            <li>
                                <a class="nav-link" href="/">{{ __('Início') }}</a>
                            </li>
                            <li>
                                <a class="nav-link" href="#sobre">{{ __('Sobre nós') }}</a>
                            </li>
                            <li>
                                <a class="nav-link" href="#missao">{{ __('Missão') }}</a>
                            </li>
                            <li>
                                <a class="nav-link" href="#vagas">{{ __('Vagas') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4 mt-3 text-center">
                        <h4>Contate-nos</h4>
                        <ul class="list-unstyled">
                            <li>contato.rh@email.com</li>
                            <li>(19)9 9909-0900</li>
                        </ul>
                    </div>
                </div>
                <div class="row text-white text-center">
                    <span> &copy Todos os direitos reservados | <script> date = new Date().getFullYear(); document.write(date); </script> </span>
                </div>
            </div>
        </div>
    </body>
</html>
