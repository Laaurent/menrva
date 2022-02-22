    <div class="nav-container" >
        <div class="nav-container_item">
            <div class="nav-container_item_header">
                <div class="nav-container_item_header_logo">Logo</div>
                <button class="btn close-menu" onclick="myClose();">
                    <x-coolicon-close-small />
                </button>
            </div>

            <ul class="nav-container_part">
                <li class="nav-link-item @if (request()->routeIs('propound')) isactive @endif">
                    <div class="nav-link-item_content">
                        <x-coolicon-search /><a href="{{ route('propound') }}">
                            Proposer
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
            </ul>
        </div>

        <div class="nav-container_item">
            <ul class="nav-container_part">
                <li class="nav-link-item @if (request()->routeIs('settings')) isactive @endif">
                    <div class="nav-link-item_content">
                        <x-coolicon-settings /><a href="{{ route('settings') }}">
                            Paramètres
                        </a>
                    </div>
                    <div class="nav-link-item_point"></div>
                </li>
            </ul>
        </div>
    </div>
