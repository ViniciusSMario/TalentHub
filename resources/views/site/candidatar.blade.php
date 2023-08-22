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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>

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
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

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
        <div  class="pageLoader" id="pageLoader"></div>

        <div class="container">

            <div class="row">
                <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="row col-md-12 mt-3 text-center">
                    <h2 class="section-title">Candidate-se a vaga {{$vaga->nome}}</h2>
                </div>

                <form action="{{route('vaga_aplicar')}}" role="form" id="msform" method="POST" class="form-group form- form-candidatar" enctype="multipart/form-data">
                    <!-- progressbar -->
                    <ul id="progressbar">
                        <li class="active" id="account"><strong>Dados Pessoais</strong></li>
                        <li id="personal"><strong>Dados Profissionais</strong></li>
                        <li id="payment"><strong>Outras Informações</strong></li>
                    </ul>
                    <!-- fieldsets -->
                    <fieldset>
                        <div class="form-card">
                            <h2 class="fs-title">Dados Pessoais</h2>
                            {{ csrf_field() }}
                            <input type="hidden" name="vaga_id" id="vaga_id" value="{{$vaga->id}}">
                            <div class="form-group">
                                <label for="nome">Nome Completo:</label>
                                <input type="text" required name="nome" id="nome" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail:</label>
                                <input type="email" required name="email" id="email" class="form-control">
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="sexo">Gênero:</label>
                                    <select name="sexo" id="sexo" class="form-control">
                                        <option value="">Prefiro não informar</option>
                                        <option value="masculino">Masculino</option>
                                        <option value="feminino">Feminino</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="data_nascimento">Data de nascimento:</label>
                                    <input type="date" required name="data_nascimento" id="data_nascimento" class="form-control">
                                </div>
                            </div>
                            {{-- <div class="text-end">
                                <button class="btn btn-primary nextBtn pull-left" type="button">Próximo</button>
                            </div> --}}
                        </div>
                        <input type="button" name="next" class="next action-button" value="Próximo"/>
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <h2 class="fs-title">Dados Profissionais</h2>
                            <div class="row">
                                <div class="form-group">
                                    <label for="url_curriculo">Anexe seu currículo: (utilizar formato PDF)</label>
                                    <input type="file" accept=".pdf" required name="url_curriculo" id="url_curriculo" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="url_linkedin">URL LinkedIn:</label>
                                    <input type="text" name="url_linkedin" id="url_linkedin" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="url_site">URL Portifólio/Site:</label>
                                    <input type="text" name="url_site" id="url_site" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="url_instagram">URL Instagram:</label>
                                    <input type="text" name="url_instagram" id="url_instagram" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="url_facebook">URL Facebook:</label>
                                    <input type="text" name="url_facebook" id="url_facebook" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label for="referencias">Referências profissionais:</label>
                                    <textarea name="referencias" id="referencias" class="form-control" cols="10" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label for="informacoes_adicionais">Informações adicionais:</label>
                                    <textarea name="informacoes_adicionais" id="informacoes_adicionais" class="form-control" cols="10" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <input type="button" name="previous" class="previous action-button-previous" value="Voltar"/>
                        <input type="button" name="next" class="next action-button" value="Próximo"/>
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <h2 class="fs-title">Outras Informações</h2>
                            <div class="row form-group">
                                <div class="col-md-5">
                                    <label for="endereco">Endereço:</label>
                                    <input type="text" required placeholder="Rua/Av." name="endereco" id="endereco" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <label for="numero">Número:</label>
                                    <input type="text" required name="numero" id="numero" class="form-control">
                                </div>
                                <div class="col-md-5">
                                    <label for="bairro">Bairro:</label>
                                    <input type="text" required name="bairro" id="bairro" class="form-control">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="estado">Estado:</label>
                                    <select name="estado" id="estado" class="form-control" required tabindex="1">
                                        <option value="" disabled selected>Escolha um Estado</option>
                                        @foreach($estados as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="cidade">Cidade:</label>
                                    <select name="cidade" id="cidade" class="form-control" required tabindex="1">
                                        <option value="">Escolha uma Cidade</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="telefone_contato">Cel.:</label>
                                    <input type="text" required name="telefone_contato" id="telefone_contato" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="estado_civil">Estado civil:</label>
                                    <select name="estado_civil" id="estado_civil" class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="solteiro">Solteiro(a)</option>
                                        <option value="casado">Casado(a)</option>
                                        <option value="divorciado">Divorciado(a)</option>
                                        <option value="viuvo">Viúvo(a)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="button" name="previous" class="previous action-button-previous" value="Voltar"/>
                        <input type="submit" class="next action-button" value="Finalizar"/>
                    </fieldset>
                </form>
            </div>
        </div>
    </body>
</html>

<script type="text/javascript">
$(document).ready(function(){
    $('#telefone_contato').inputmask('(99) 9 9999-9999');
    $('select[name="estado"]').on('change', function(){

        var estado_id = $(this).val();

        $.ajax({
            url: "{{ route('cidade_por_estado') }}",
            type: "POST",
            data: { id_estado: estado_id },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $('select[name=cidade]').empty();
                $.each(data, function(key, value) {
                    $('select[name=cidade]').append('<option value="'+key+'">'+value+'</option>');
                });
            },
        });
    });

    $('div.setup-panel div a.btn-info').trigger('click');

    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;

    $(".next").click(function(){

        var isValid = true;
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        var curInputs = current_fs.find("input[type='text'],input[type='email'],input[type='date'], input[type='file'], select,input[type='url']");

        $(".form-group").removeClass("has-error");
        for (var i = 0; i < curInputs.length; i++) {
            if (!curInputs[i].validity.valid) {
                isValid = false;
                $(curInputs[i]).addClass("is-invalid");
            }

            if (isValid == true){
                $(curInputs[i]).removeClass("is-invalid").addClass("is-valid");
            }
        }

        if (!isValid) {
            return
        }

        //Add Class Active
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                next_fs.css({'opacity': opacity});
            },
            duration: 600
        });
    });

    $(".previous").click(function(){

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //Remove class active
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();

        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previous_fs.css({'opacity': opacity});
            },
            duration: 600
        });
    });

    $('.radio-group .radio').click(function(){
        $(this).parent().find('.radio').removeClass('selected');
        $(this).addClass('selected');
    });

    $(window).on('beforeunload', function(){
        $('#pageLoader').show();
    });

    $(function () {
        $('#pageLoader').hide();
    })
});
</script>
