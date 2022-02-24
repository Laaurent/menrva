    <div class="nav-container">
        <div class="nav-container_item">
            <div class="nav-container_item_header">
                <div class="nav-container_item_header_logo">Logo</div>
                <button class="btn close-menu" onclick="myClose();">
                    <x-coolicon-close-small />
                </button>
            </div>

            <ul class="nav-container_part">
                <li class="nav-link-item @if (request()->routeIs('home')) isactive @endif">
                    <div class="nav-link-item_content">
                        <x-coolicon-home-outline /><a href="{{ route('home') }}">
                            Accueil
                        </a>
                    </div>
                    <div class="nav-link-item_point"></div>
                </li>
                <li class="nav-link-item @if (request()->routeIs('search')) isactive @endif">
                    <div class="nav-link-item_content">
                        <x-coolicon-folder-plus /><a href="{{ route('search') }}">
                            Rechercher
                        </a>
                    </div>
                    <div class="nav-link-item_point"></div>
                </li>
                @if (Auth::check())
                    <li>
                        <hr>
                    </li>
                    <li class="nav-link-item @if (request()->routeIs('profil')) isactive @endif">
                        <div class="nav-link-item_content">
                            <x-coolicon-user-circle /><a href="{{ route('profil') }}">
                                Profil
                            </a>
                        </div>
                        <div class="nav-link-item_point"></div>
                    </li>
                @endif
            </ul>
        </div>

        <div class="nav-container_item">
            <ul class="nav-container_part">
                @if (Auth::check())
                    <li class="nav-link-item @if (request()->routeIs('settings')) isactive @endif">
                        <div class="nav-link-item_content">
                            <x-coolicon-settings /><a href="{{ route('settings') }}">
                                Paramètres
                            </a>
                        </div>
                        <div class="nav-link-item_point"></div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
