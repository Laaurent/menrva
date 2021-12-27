@extends('layouts.auth')

@section('content')

    <div class="container-auth">
        <div class="side-block">

        </div>
        <div class="main-block">
            <div class="log-container">

                <h1>Pas de panique ... 😅 </h1> <i class="ci-iconName"></i>
                <h3>Vous pouvez encore revenir en arrière !</h3>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="input-form mb-3">
                        <label for="email" class="mylabel">Email</label>

                        <div>
                            <input id="email" type="email" class="myinput @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
