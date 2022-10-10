<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
        integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous">
    </script>

    <link rel="shortcut icon" href="/img/control.png" type="image/x-icon">

    {{-- ICONS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    {{-- CSS --}}
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/media-query.css">

    {{-- JS --}}
    <script src="/js/mask-phone.js"></script>
    <script src="/js/remove-msg.js"></script>

    <title>@yield('title')</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-class">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                    <img src="/img/control.png" alt="Bootstrap" width="30" height="24">
                </a>
                <div class="collapse navbar-collapse item-nav" id="navbarNav">
                    <ul class="navbar-nav">

                        @guest
                            <li class="nav-item">
                                <a class="nav-link item-nav" href="/login"><i class="bi bi-box-arrow-in-right"></i>
                                    Entrar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/register"><i class="bi bi-person-plus"></i> Cadastrar-se</a>
                            </li>
                        @endguest

                        @auth
                            <li class="nav-item">
                                <a class="nav-link item-nav" href="/user/profile"><i class="bi bi-person-square"></i>
                                    {{ Auth::user()->name }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link item-nav" href="/dashboard"><i class="bi bi-key"></i>

                                    {{-- Exibindo role do usuário --}}
                                    @foreach (Auth::user()->roles->pluck('name') as $role)
                                        {{ $role }}
                                    @endforeach

                                </a>
                            </li>

                            @can('Visualizar painel administrativo')
                                <li class="nav-item">
                                    <a class="nav-link item-nav" href="/painel"><i class="bi bi-controller"></i>
                                        Controle de Acesso</a>
                                </li>
                            @endcan

                            <form action="/logout" method="post">
                                @csrf
                                <li class="nav-logout">
                                    <a href="/logout" onclick="event.preventDefault();this.closest('form').submit();">
                                        <i class="bi bi-box-arrow-in-left"></i> Sair
                                    </a>
                                </li>
                            </form>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    @yield('content')

</body>
</html>