<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="https://kit.fontawesome.com/ec3b584267.css" crossorigin="anonymous">
        
        <!-- Styles -->
        <link href="/css/main.css" rel="stylesheet">
        <link href="/css/@yield('style')" rel="stylesheet">

    </head>

    <body class="antialiased">
        <div id="loading" style="display: block">
            <p>Carregando...</p>
        </div>
        <div id="conteudo" style="display:none;">
            <header>
                <nav class="navbar">
                    <a href="/" class="logo">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="{{Request::is('/')? '#55f' : 'white'}}" viewBox="0 0 512 512">
                            <path d="M504.4,115.83a5.72,5.72,0,0,0-.28-.68,8.52,8.52,0,0,0-.53-1.25,6,6,0,0,0-.54-.71,9.36,9.36,0,0,0-.72-.94c-.23-.22-.52-.4-.77-.6a8.84,8.84,0,0,0-.9-.68L404.4,55.55a8,8,0,0,0-8,0L300.12,111h0a8.07,8.07,0,0,0-.88.69,7.68,7.68,0,0,0-.78.6,8.23,8.23,0,0,0-.72.93c-.17.24-.39.45-.54.71a9.7,9.7,0,0,0-.52,1.25c-.08.23-.21.44-.28.68a8.08,8.08,0,0,0-.28,2.08V223.18l-80.22,46.19V63.44a7.8,7.8,0,0,0-.28-2.09c-.06-.24-.2-.45-.28-.68a8.35,8.35,0,0,0-.52-1.24c-.14-.26-.37-.47-.54-.72a9.36,9.36,0,0,0-.72-.94,9.46,9.46,0,0,0-.78-.6,9.8,9.8,0,0,0-.88-.68h0L115.61,1.07a8,8,0,0,0-8,0L11.34,56.49h0a6.52,6.52,0,0,0-.88.69,7.81,7.81,0,0,0-.79.6,8.15,8.15,0,0,0-.71.93c-.18.25-.4.46-.55.72a7.88,7.88,0,0,0-.51,1.24,6.46,6.46,0,0,0-.29.67,8.18,8.18,0,0,0-.28,2.1v329.7a8,8,0,0,0,4,6.95l192.5,110.84a8.83,8.83,0,0,0,1.33.54c.21.08.41.2.63.26a7.92,7.92,0,0,0,4.1,0c.2-.05.37-.16.55-.22a8.6,8.6,0,0,0,1.4-.58L404.4,400.09a8,8,0,0,0,4-6.95V287.88l92.24-53.11a8,8,0,0,0,4-7V117.92A8.63,8.63,0,0,0,504.4,115.83ZM111.6,17.28h0l80.19,46.15-80.2,46.18L31.41,63.44Zm88.25,60V278.6l-46.53,26.79-33.69,19.4V123.5l46.53-26.79Zm0,412.78L23.37,388.5V77.32L57.06,96.7l46.52,26.8V338.68a6.94,6.94,0,0,0,.12.9,8,8,0,0,0,.16,1.18h0a5.92,5.92,0,0,0,.38.9,6.38,6.38,0,0,0,.42,1v0a8.54,8.54,0,0,0,.6.78,7.62,7.62,0,0,0,.66.84l0,0c.23.22.52.38.77.58a8.93,8.93,0,0,0,.86.66l0,0,0,0,92.19,52.18Zm8-106.17-80.06-45.32,84.09-48.41,92.26-53.11,80.13,46.13-58.8,33.56Zm184.52,4.57L215.88,490.11V397.8L346.6,323.2l45.77-26.15Zm0-119.13L358.68,250l-46.53-26.79V131.79l33.69,19.4L392.37,178Zm8-105.28-80.2-46.17,80.2-46.16,80.18,46.15Zm8,105.28V178L455,151.19l33.68-19.4v91.39h0Z"/>
                        </svg>
                    </a>
                    <input type="checkbox" id="toggler" />
                    <label for="toggler" class="toggler-label">
                        <ion-icon name="menu"></ion-icon>
                    </label>
                    <div class="menu">
                        <ul class="list">
                            <li class="nav-item">
                                <a href="/events/list" class="{{Request::is('events/list')? 'nav-link selected' : 'nav-link'}}">
                                    Eventos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/events/manage" class="{{Request::is('events/manage') && !request('id')? 'nav-link selected' : 'nav-link'}}">Criar Evento</a>
                            </li>
                            @auth
                                <li class="nav-item">
                                    <a href="/my_events" class="{{Request::is('my_events')? 'nav-link selected' : 'nav-link'}}">Meus Eventos</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/schedule" class="{{Request::is('schedule')? 'nav-link selected' : 'nav-link'}}">Agenda</a>
                                </li>
                                <li class="nav-item">
                                    <form action="/logout" method="post">
                                        @csrf
                                        <a href="/logout" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">
                                            Sair
                                        </a>
                                    </form>
                                </li>    
                            @endauth
                            @guest
                                <li class="nav-item">
                                    <a href="/login" class="{{Request::is('login')? 'nav-link selected' : 'nav-link'}}">Entrar</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/register" class="{{Request::is('register')? 'nav-link selected' : 'nav-link'}}">Cadastrar</a>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </nav>
            </header>
            <main>
                <div class="container-fluid">
                    <div class="row">
                        @if(session("msg"))
                            <p class="msg">{{ session("msg") }}</p>
                        @endif
                        @yield('content')
                    </div>
                </div>
            </main>
            <footer>
                <p>Laravel Project 2023</p>
            </footer>
            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        </div>
    </body>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="/js/scripts.js"></script>
    <script src="/js/@yield('js')"></script>
</html>