<div class="header-container">
    <div>
        <button class="btn open-menu" onclick="myOpen();">
            <x-coolicon-grid-big-round />
        </button>
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
