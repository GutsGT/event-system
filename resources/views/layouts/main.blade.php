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
        
        <link href="/css/styles.css" rel="stylesheet">

        <!-- Styles -->
        <style>
            html{
                line-height:1.15;-webkit-text-size-adjust:100%
            }
            body{
                margin:0;
                font-family: 'Nunito', sans-serif;
                overflow-x: hidden;
            }
            a{
                background-color:transparent
            }[hidden]{
                display:none
            }
            html{
                font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5
            }
            *,:after,:before{
                box-sizing:border-box;border:0 solid #e2e8f0
            }
            a{
                color:inherit;text-decoration:inherit
            }
            svg,video{
                display:block;
            }
            video{
                max-width:100%;height:auto
            }
            .bg-white{
                --bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))
            }
            .bg-gray-100{
                --bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))
            }
            .border-gray-200{
                --border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))
            }
            .border-t{
                border-top-width:1px
            }
            .flex{
                display:flex
            }
            .grid{
                display:grid
            }
            .hidden{
                display:none
            }
            .items-center{
                align-items:center
            }
            .justify-center{
                justify-content:center
            }
            .font-semibold{
                font-weight:600
            }
            .h-5{
                height:1.25rem
            }
            .h-8{
                height:2rem
            }
            .h-16{
                height:4rem
            }
            .text-sm{
                font-size:.875rem
            }
            .text-lg{
                font-size:1.125rem
            }
            .leading-7{
                line-height:1.75rem
            }
            .mx-auto{
                margin-left:auto;margin-right:auto
            }
            .ml-1{
                margin-left:.25rem
            }
            .mt-2{
                margin-top:.5rem
            }
            .mr-2{
                margin-right:.5rem
            }
            .ml-2{
                margin-left:.5rem
            }
            .mt-4{
                margin-top:1rem
            }
            .ml-4{
                margin-left:1rem
            }
            .mt-8{
                margin-top:2rem
            }
            .ml-12{
                margin-left:3rem
            }
            .-mt-px{
                margin-top:-1px
            }
            .max-w-6xl{
                max-width:72rem
            }
            .min-h-screen{
                min-height:100vh
            }
            .overflow-hidden{
                overflow:hidden
            }
            .p-6{
                padding:1.5rem
            }
            .py-4{
                padding-top:1rem;padding-bottom:1rem
            }
            .px-6{
                padding-left:1.5rem;padding-right:1.5rem
            }
            .pt-8{
                padding-top:2rem
            }
            .fixed{
                position:fixed
            }
            .relative{
                position:relative
            }
            .top-0{
                top:0
            }
            .right-0{
                right:0
            }
            .shadow{
                box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)
            }
            .text-center{
                text-align:center
            }
            .text-gray-200{
                --text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))
            }
            .text-gray-300{
                --text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))
            }
            .text-gray-400{
                --text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))
            }
            .text-gray-500{
                --text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))
            }
            .text-gray-600{
                --text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))
            }
            .text-gray-700{
                --text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))
            }
            .text-gray-900{
                --text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))
            }
            .underline{
                text-decoration:underline
            }
            .antialiased{
                -webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale
            }
            .w-5{
                width:1.25rem
            }
            .w-8{
                width:2rem
            }
            .w-auto{
                width:auto
            }
            .grid-cols-1{
                grid-template-columns:repeat(1,minmax(0,1fr))
            }
            @media (min-width:640px){
                .sm\:rounded-lg{
                    border-radius:.5rem
                }
                .sm\:block{
                    display:block
                }
                .sm\:items-center{
                    align-items:center
                }
                .sm\:justify-start{
                    justify-content:flex-start
                }
                .sm\:justify-between{
                    justify-content:space-between
                }
                .sm\:h-20{
                    height:5rem
                }
                .sm\:ml-0{
                    margin-left:0
                }
                .sm\:px-6{
                    padding-left:1.5rem;padding-right:1.5rem
                }
                .sm\:pt-0{
                    padding-top:0
                }
                .sm\:text-left{
                    text-align:left
                }
                .sm\:text-right{
                    text-align:right
                }
            }

            @media (min-width:768px){
                .md\:border-t-0{
                    border-top-width:0
                }
                .md\:border-l{
                    border-left-width:1px
                }
                .md\:grid-cols-2{
                    grid-template-columns:repeat(2,minmax(0,1fr))
                }
            }

            @media (min-width:1024px){
                .lg\:px-8{
                    padding-left:2rem;padding-right:2rem
                }
            }
            
            @media (prefers-color-scheme:dark){
                .dark\:bg-gray-800{
                    --bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))
                }
                .dark\:bg-gray-900{
                    --bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))
                }
                .dark\:border-gray-700{
                    --border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))
                }
                .dark\:text-white{
                    --text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))
                }
                .dark\:text-gray-400{
                    --text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))
                }
                .dark\:text-gray-500{
                    --tw-text-opacity:1;color:#6b7280;color:rgba(107,114,128,var(--tw-text-opacity))
                }
            }

        </style>

        <script src="/js/scripts.js"></script>
    </head>
    <body class="antialiased">
        <header>
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="collapse navbar-collapse" id="navbar">
                    <a href="/" class="navbar-brand">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 512 512">
                            <path d="M504.4,115.83a5.72,5.72,0,0,0-.28-.68,8.52,8.52,0,0,0-.53-1.25,6,6,0,0,0-.54-.71,9.36,9.36,0,0,0-.72-.94c-.23-.22-.52-.4-.77-.6a8.84,8.84,0,0,0-.9-.68L404.4,55.55a8,8,0,0,0-8,0L300.12,111h0a8.07,8.07,0,0,0-.88.69,7.68,7.68,0,0,0-.78.6,8.23,8.23,0,0,0-.72.93c-.17.24-.39.45-.54.71a9.7,9.7,0,0,0-.52,1.25c-.08.23-.21.44-.28.68a8.08,8.08,0,0,0-.28,2.08V223.18l-80.22,46.19V63.44a7.8,7.8,0,0,0-.28-2.09c-.06-.24-.2-.45-.28-.68a8.35,8.35,0,0,0-.52-1.24c-.14-.26-.37-.47-.54-.72a9.36,9.36,0,0,0-.72-.94,9.46,9.46,0,0,0-.78-.6,9.8,9.8,0,0,0-.88-.68h0L115.61,1.07a8,8,0,0,0-8,0L11.34,56.49h0a6.52,6.52,0,0,0-.88.69,7.81,7.81,0,0,0-.79.6,8.15,8.15,0,0,0-.71.93c-.18.25-.4.46-.55.72a7.88,7.88,0,0,0-.51,1.24,6.46,6.46,0,0,0-.29.67,8.18,8.18,0,0,0-.28,2.1v329.7a8,8,0,0,0,4,6.95l192.5,110.84a8.83,8.83,0,0,0,1.33.54c.21.08.41.2.63.26a7.92,7.92,0,0,0,4.1,0c.2-.05.37-.16.55-.22a8.6,8.6,0,0,0,1.4-.58L404.4,400.09a8,8,0,0,0,4-6.95V287.88l92.24-53.11a8,8,0,0,0,4-7V117.92A8.63,8.63,0,0,0,504.4,115.83ZM111.6,17.28h0l80.19,46.15-80.2,46.18L31.41,63.44Zm88.25,60V278.6l-46.53,26.79-33.69,19.4V123.5l46.53-26.79Zm0,412.78L23.37,388.5V77.32L57.06,96.7l46.52,26.8V338.68a6.94,6.94,0,0,0,.12.9,8,8,0,0,0,.16,1.18h0a5.92,5.92,0,0,0,.38.9,6.38,6.38,0,0,0,.42,1v0a8.54,8.54,0,0,0,.6.78,7.62,7.62,0,0,0,.66.84l0,0c.23.22.52.38.77.58a8.93,8.93,0,0,0,.86.66l0,0,0,0,92.19,52.18Zm8-106.17-80.06-45.32,84.09-48.41,92.26-53.11,80.13,46.13-58.8,33.56Zm184.52,4.57L215.88,490.11V397.8L346.6,323.2l45.77-26.15Zm0-119.13L358.68,250l-46.53-26.79V131.79l33.69,19.4L392.37,178Zm8-105.28-80.2-46.17,80.2-46.16,80.18,46.15Zm8,105.28V178L455,151.19l33.68-19.4v91.39h0Z"/>
                        </svg>
                    </a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/events/list" class="nav-link">Eventos</a>
                        </li>
                        <li class="nav-item">
                            <a href="/events/create" class="nav-link">Criar Eventos</a>
                        </li>
                        @auth
                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link">Meus Eventos</a>
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
                            <a href="/login" class="nav-link">Entrar</a>
                        </li>
                        <li class="nav-item">
                            <a href="/register" class="nav-link">Cadastrar</a>
                        </li>
                        @endguest
                    </ul>
                </div>
            </nav>
        </header>
        <main>
            <div class="container-gluid">
                <div class="row">
                    @if(session("msg"))
                        <p class="msg">{{ session("msg") }}</p>
                    @endif
                    @yield('content')
                </div>
            </div>
        </main>
        <footer>
            <p>HDC Events &copy; 2020</p>
        </footer>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>