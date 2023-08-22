@extends('layouts.app')

@section('content')
<div class="container bg-white">
    <div class="row justify-content-center">
        <div class="col-md-2"></div>
        <div class="col-md-8 mt-2 mb-3">
            <div class="text-center">
                <div class="text-center">
                    <img src="{{asset('images/logo.png')}}" width="150px" alt="Logo TalentHub">
                </div>
                <h2 class="mb-3 mt-2 section-title">
                    {{ __('Faça seu cadastro preenchendo os dados abaixo') }}
                </h2>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nome') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-mail') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Senha') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirme sua senha') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Criar conta') }}
                            </button>
                        </div>
                    </div>

                    <div class="row col-md-12 mt-4">
                        <span class="text-muted">Já tem uma conta? <a href="{{route('login')}}"> Faça Login </a></span>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
@endsection
