@extends('layouts.app')

@section('content')
<div class="container bg-white">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mt-5 mb-5">
                <div class="row col-md-12">
                    <div class="text-center">
                        <img src="{{asset('images/logo.png')}}" width="150px" alt="Logo TalentHub">
                    </div>
                    <h2 class="text-center section-title mt-3 mb-4">
                        {{ __('Redefinir senha') }}
                    </h2>
                </div>

                <div class="row col-md-12">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-4">
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

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Enviar link de redefinição de senha') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
