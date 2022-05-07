@extends('layouts.auth')

@section('content')
<div class="container-auth">
    <div class="side-block">

    </div>
    <div class="main-block">


        <div class="log-container">
            <a href="{{ route('home') }}"><img class="my-4" src="{{ asset('/img/svg/favicon.svg') }}"
                    alt="Logo of menrva" width="40"></a>
            <h1>Bonjour 👋</h1>
            <h3>Bon retour parmi nous !</h3>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="input-form mb-3">
                    <label for="email" class="mylabel">Email</label>

                    <div class="">
                        <input id="email" type="email" class="myinput @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="input-form mb-3">
                    <label for="password" class="mylabel">Mot de passe</label>

                    <div class="">
                        <input id="password" type="password" class="myinput @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                @if (Route::has('password.request'))
                {{-- <a class="forgot-password" href="{{ route('password.request') }}">
                    Mot de passe oublié ?
                </a> --}}
                @endif

                <button type="submit" class="btn btn-primary w-100">
                    Se connecter
                </button>
            </form>
        </div>
    </div>

</div>
@endsection