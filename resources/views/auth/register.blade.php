@extends('layouts.auth')

@section('content')

    <div class="container-auth">
        <div class="side-block">

        </div>
        <div class="main-block">
            <div class="log-container">

                <h1>Bienvenue 👋</h1> <i class="ci-iconName"></i>
                <h3>Content de vous compter parmi nous !</h3>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="input-form mb-3">
                        <div id="radio">
                            <div id="container-input-radio" class="container-input">
                                <input id="radio-1" class="radios" type="radio" name="user_type_id" value="1"
                                    checked>
                                <label id="label-radio-1" class="label-radio" for="radio-1">Étudiant</label>

                                <input id="radio-2" class="radios" type="radio" name="user_type_id" value="2">
                                <label id="label-radio-2" class="label-radio" for="radio-2">Professionnel</label>

                                <div id="btn-radio"></div>
                            </div>
                        </div>
                    </div>

                    <div class="input-form mb-3">
                        <label for="name" class="mylabel">Nom</label>

                        <div>
                            <input id="name" type="text" class="myinput @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

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
                        Nous rejoindre
                    </button>
                </form>
            </div>
        </div>

    </div>
    <div class="logo_container">
        <img src="{{ asset('img/logo/logo_osfrecouvrement.svg') }}" alt="">
    </div>
@endsection
