<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Employee Management')</title>
   
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        html, body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        footer {
            background-color: #f8f9fa;
            padding: 15px 0;
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Header / Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('employees.index') }}">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
                HRM System
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('employees.index') }}">Employees</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('employees.create') }}">Add Employee</a>
                    </li>
            
                    @auth
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link" style="display: inline; padding: 0; margin: 0; border: none;">
                                Logout
                            </button>
                        </form>
                    </li>
                    @endauth
                </ul>
            </div>
            
        </div>
    </nav>

    <div class="">
        <div class="row g-0 min-vh-100">
            <!-- Sidebar -->
            <nav class="col-md-2 col-lg-2 d-md-block bg-dark sidebar text-white shadow-sm p-3">
                <div class="sticky-top">
                    <h4 class="text-white mb-4">Admin Panel</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <a class="nav-link text-white {{ request()->routeIs('dashboard') ? 'fw-bold active' : '' }}" href="{{ route('dashboard') }}">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link text-white {{ request()->is('employees*') ? 'fw-bold active' : '' }}" href="{{ route('employees.index') }}">
                                <i class="bi bi-people"></i> Employees
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link text-white {{ request()->routeIs('alldepartment') ? 'fw-bold active' : '' }}" href="{{ route('alldepartment') }}">
                                <i class="bi bi-person"></i>All Departments
                            </a>
                        </li>

                        <li class="nav-item mb-2">
                            <a class="nav-link text-white {{ request()->routeIs('profile') ? 'fw-bold active' : '' }}" href="{{ route('profile') }}">
                                <i class="bi bi-person"></i> Profile
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link text-white {{ request()->routeIs('settings') ? 'fw-bold active' : '' }}" href="{{ route('settings') }}">
                                <i class="bi bi-gear"></i> Settings
                            </a>
                        </li>
                        @auth
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link" style="display: inline; padding: 0; margin: 0; border: none;">
                                    Logout
                                </button>
                            </form>
                        </li>
                        @endauth
                    </ul>
                    
                </div>
            </nav>
    
            <!-- Main Content -->
            <main class="col-md-10 col-lg-10 bg-light p-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} HRM System. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
