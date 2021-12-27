@extends('layouts.auth')

@section('content')
    <div class="container-auth">
        <div class="side-block">

        </div>
        <div class="main-block">
            <div class="log-container">

                <h1>C'est votre chance ! </h1> <i class="ci-iconName"></i>
                <h3>Réflechissez bien à votre mot de passe.</h3>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="input-form mb-3">
                        <label for="email" class="mylabel">Email</label>

                        <div>
                            <input id="email" type="email" class="myinput @error('email') is-invalid @enderror" name="email"
                                value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="input-form mb-3">
                        <label for="password" class="mylabel">Mot de passe</label>

                        <div>
                            <input id="password" type="password" class="myinput @error('password') is-invalid @enderror"
                                name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="input-form mb-3">
                        <label for="password-confirm" class="mylabel">Confirmation mot de
                            passe</label>

                        <div>
                            <input id="password-confirm" type="password" class="myinput" name="password_confirmation"
                                required autocomplete="new-password">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Réinitialiser le mot de passe
                    </button>
                </form>
            </div>
        </div>

    </div>
    <div class="logo_container">
        <img src="{{ asset('img/logo/logo_osfrecouvrement.svg') }}" alt="">
    </div>
@endsection
