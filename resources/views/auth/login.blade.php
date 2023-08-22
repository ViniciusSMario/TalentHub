@extends('layouts.app')

@section('content')
<div class="container-fluid bg-white container-login-page">
    <div class="row">
        <div class="col-md-6 left-login-page"></div>
        <div class="col-md-6 rigth-login-page">
            <div class="mt-4">
                <div class="text-center">
                    <img src="{{asset('images/logo.png')}}" width="150px" alt="Logo TalentHub">
                </div>
                <h2 class="text-center mt-3 mb-5 section-title"> Faça Login para continuar </h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-mail') }}</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Senha') }}</label>
                        <div class="col-md-6 text-center">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check text-center ">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-lasbel" for="remember">
                                    {{ __('Manter conectado') }}
                                </label>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Esqueceu sua senha?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-7 text-center">
                            <button type="submit" class="btn btn-primary w-100">
                                {{ __('Entrar') }}
                                <i class="bi bi-arrow-bar-right"></i>
                            </button>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <div class="row text-center mt-3">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 text-center">
                            <span class="text-muted">Ainda não tem uma conta? <a href="{{ route('register') }}"> Cadastre-se </a> </span>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
