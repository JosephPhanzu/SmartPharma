<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Accueil')</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="favicon.png"/>
    
    @vite('resources/css/app.css')
    @vite('resources/css/bootstrap.min.css')
    @vite('resources/js/jquery-3.7.1.min.js')
    <!-- Fontawesome CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="../public/js/jquery-3.6.1.min.js"></script>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="authent-bloc col-md-12 rounded-5 shadow">
            <div class="d-flex flex-row head-authent text-center p-3 position-relative border-white border-bottom">
                <div class="logo-block flex-grow-2 me-5">
                    <img src="{{ asset('images/logos/logo.png') }}" alt="Logo" width="45px" title="Logo">
                </div>
                <div class="title-block ms-5">
                    <h4 class="fs-4">Smart Pharma</h4>
                </div>
                <div class="profil-block d-flex justify-content-end px-4">
                    <img src="{{ asset('images/mancolor.png') }}" class="img-fluid cursor-pointer rounded-circle border" alt="Profil" title="Profil" width="30" srcset="">
                </div>
            </div>
            <div class="d-flex flex-row">
                <div class="navigation d-flex me-2">
                    <div class="nav py-2 px-3 flex-column">
                        <a class="btn btn-light flex-row mt-2 mb-4"><i class="fa-solid fa-gauge"></i> Dashboard</a>
                        <ul class="">
                            <li class="nav-items" id="Accueil"><a href="{{ route('accueil') }}"><i class="fa-solid fa-house-chimney me-3"></i> Accueil</a></li>
                            <li class="nav-items" id="Produit"><a href="{{ route('ajoutProd') }}"><i class="fa-solid fa-pills me-3"></i> Produits</a></li>
                            <li class="nav-items"><a href=""><i class="fa-brands fa-sellsy me-3"></i> Vente</a></li>
                            <li class="nav-items"><a href=""><i class="fa-solid fa-circle-info me-3"></i> Plus</a></li>
                        </ul>
                    </div>
                </div>
                <div class="main d-flex flex-column">
                    @yield('contenuMain')
                </div>
            </div>
        </div>
    </div>
    @vite('resources/js/bootstrap.bundle.min.js')
    @vite('resources/js/app.js')
    @stack('scripts')
</body>
</html>