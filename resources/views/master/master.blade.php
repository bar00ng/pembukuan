<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> - Voler Admin Dashboard</title>

    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <script src="/dist/app.js"></script>


    <link rel="stylesheet" href="/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="/assets/css/app.css">
    <link rel="shortcut icon" href="/assets/images/favicon.svg" type="image/x-icon">
</head>

<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <img src="/assets/images/logo.svg" alt="" srcset="">
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class='sidebar-title'>Main Menu</li>
                        @if(Auth::user()->hasRole('admin'))
                            <li class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                <a href="{{ route('dashboard') }}" class='sidebar-link'>
                                    <i data-feather="home" width="20"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class='sidebar-link'>
                                    <i data-feather="users" width="20"></i>
                                    <span>Daftar Kasir</span>
                                </a>
                            </li>
                            <li class="sidebar-item {{ request()->routeIs('*category*') ? 'active' : '' }}">
                                <a href="{{ route('category.list') }}" class='sidebar-link'>
                                    <i data-feather="home" width="20"></i>
                                    <span>Kategori</span>
                                </a>
                            </li>
                            <li class="sidebar-item  {{ request()->routeIs('*unit*') ? 'active' : '' }}">
                                <a href="{{ route('unit.list') }}" class='sidebar-link'>
                                    <i data-feather="home" width="20"></i>
                                    <span>Satuan</span>
                                </a>
                            </li>
                            <li class="sidebar-item  {{ request()->routeIs('*product*') ? 'active' : '' }}">
                                <a href="{{ route('product.list') }}" class='sidebar-link'>
                                    <i data-feather="archive" width="20"></i>
                                    <span>Produk</span>
                                </a>
                            </li>
                            <li class="sidebar-item  {{ request()->routeIs('*pembukuan*') ? 'active' : '' }}">
                                <a href="{{ route('pembukuan.list') }}" class='sidebar-link'>
                                    <i data-feather="book-open" width="20"></i>
                                    <span>Pembukuan</span>
                                </a>
                            </li>
                        @elseif(Auth::user()->hasRole('user'))
                            <li class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                <a href="{{ route('dashboard') }}" class='sidebar-link'>
                                    <i data-feather="dollar-sign" width="20"></i>
                                    <span>Kasir</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class='sidebar-link'>
                                    <i data-feather="list" width="20"></i>
                                    <span>Daftar Order</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                        <li class="dropdown">
                            <a href="#" data-bs-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="d-none d-md-block d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i data-feather="log-out"></i>
                                        Logout</a>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="main-content container-fluid">
                @if (session()->has('Message'))
                    <div class="alert alert-primary">{{ session()->get('Message') }}</div>
                @endif

                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            @yield('title')
                        </div>
                        <div class="col-12 col-md-6">
                            @yield('breadcrumb')
                        </div>
                    </div>
                </div>

                @yield('content')
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2022 &copy; Voler</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class='text-danger'><i data-feather="heart"></i></span> by <a
                                href="https://saugi.me">Saugi</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="/assets/js/feather-icons/feather.min.js"></script>
    <script src="/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    @yield('script')
</body>

</html>
