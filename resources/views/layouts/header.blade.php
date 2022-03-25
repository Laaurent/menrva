<div class="header-container items-center">
    <div class="flex items-center">
        <button class="btn open-menu" onclick="myOpen();">
            <x-coolicon-grid-big-round />
        </button>
        @if (Auth::check())
        <span>Bonjour, <b>{{ Auth::user()->first_name }}</b> !</span>
        @endif
    </div>
    <div class="header-container__log-links">
        @if (!Auth::check())
        <button-component type="empty" text="Se connecter" :url="{{ json_encode(route('login')) }}">
        </button-component>
        <button-component type="primary" text="S'inscrire" :url="{{ json_encode(route('register')) }}">
        </button-component>
        @else
        <form method="post" action="{{ route('logout') }}">
            {{ csrf_field() }}
            <button class="btn">
                <x-coolicon-home-minus />
            </button>
        </form>
        @endif

    </div>
</div>