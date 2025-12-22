<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Mesara</title>

    <!-- Bootstrap 5 CDN (CSS) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">Mesara</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('public.narudzbina.create') }}">Nova prodaja</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('nabavka.wizard.create') }}">Nabavka</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('raspored.index') }}">Raspored</a>
                </li>
                @auth
                    <li class="nav-item ms-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-outline-light btn-sm">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item ms-2">
                        <a class="btn btn-outline-light btn-sm" href="{{ route('login') }}">Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<main>
    @yield('content')
</main>

<!-- Bootstrap 5 CDN (JS) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
