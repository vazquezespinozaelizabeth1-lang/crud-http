<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'CRUD HTTP') | Almacén</title>

    {{-- Tipografías --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Fraunces:opsz,wght@9..144,600;9..144,700&display=swap" rel="stylesheet">

    {{-- Bootstrap Icons por CDN --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Bootstrap 5 compilado con Vite --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 mb-lg-5">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('productos.index') }}">
                <span class="marca"><i class="bi bi-box-seam"></i></span>
                <span>Almacén<span class="punto">.</span></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Menú">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('productos.index') ? 'active' : '' }}"
                           href="{{ route('productos.index') }}">
                            <i class="bi bi-list-ul"></i> Listado
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('productos.create') ? 'active' : '' }}"
                           href="{{ route('productos.create') }}">
                            <i class="bi bi-plus-lg"></i> Nuevo
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">
        @if (session('ok'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill"></i> {{ session('ok') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="container pie text-center py-4 mt-4">
        Aplicaciones Web · Práctica de peticiones HTTP · Laravel 12 + Bootstrap 5
    </footer>
</body>
</html>
