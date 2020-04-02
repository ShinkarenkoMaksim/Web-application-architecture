<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">НашиНовости</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link {{ request()->routeIs('news.all')?'active':'' }}"
                   href="{{ route('news.all') }}">Новости</a>
                <a class="nav-item nav-link {{ request()->routeIs('news.categories')?'active':'' }}"
                   href="{{ route('news.categories') }}">Категории</a>
                @if(Auth::user()?Auth::user()->is_admin:false)
                    <a class="nav-item nav-link {{ request()->routeIs('news.admin')?'active':'' }}"
                       href="{{ route('admin.index') }}">Админка</a>
                @endif
            </div>
        </div>

        <ul class="navbar-nav ml-auto">

            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('fbLogin') }}">{{ 'FB Login' }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('vkLogin') }}">{{ 'VK Login' }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item">
                    <img class="rounded-circle avatar" src="{{ Auth()->user()->avatar }}" alt="">
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @if(Auth::user()->id_in_soc == "")
                            <a class="dropdown-item" href="{{ route('myProfile') }}">Мой профиль</a>
                        @endif
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>

