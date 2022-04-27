<div class="header-container lg:items-center">
    <div class="flex lg:items-center flex-col lg:flex-row gap-4">
        <div>
            <button class="btn open-menu" onclick="myOpen();">
                <x-coolicon-grid-big-round />
            </button>
        </div>
        @if (Auth::check())
        <div class="flex gap-2 items-center">


            <emoji-component type="hello"></emoji-component><span> Bonjour, <b>{{ Auth::user()->first_name }}</b>
                !</span>
        </div>
        @endif
    </div>
    <div class="header-container__log-links mt-1">
        @if (!Auth::check())
        <button-component type="empty" text="Se connecter" :url="{{ json_encode(route('login')) }}">
        </button-component>
        <button-component type="primary" text="S'inscrire" :url="{{ json_encode(route('register')) }}">
        </button-component>
        @else
        <form method="post" action="{{ route('logout') }}">
            {{ csrf_field() }}
            <button class="btn mt-1">
                <x-coolicon-home-minus />
            </button>
        </form>
        @endif

    </div>
</div>