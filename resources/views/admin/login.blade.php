<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login | {{ \App\Helpers\CompanyHelper::getName() }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ \App\Helpers\CompanyHelper::getLogo() }}" type="image/x-icon">
    
    <!-- [Font] Family -->
    <link rel="stylesheet" href="{{ asset('admin-assets/fonts/inter/inter.css') }}" id="main-font-link" />
    <!-- [Tabler Icons] -->
    <link rel="stylesheet" href="{{ asset('admin-assets/fonts/tabler-icons.min.css') }}">
    <!-- [Feather Icons] -->
    <link rel="stylesheet" href="{{ asset('admin-assets/fonts/feather.css') }}">
    <!-- [Font Awesome Icons] -->
    <link rel="stylesheet" href="{{ asset('admin-assets/fonts/fontawesome.css') }}">
    <!-- [Material Icons] -->
    <link rel="stylesheet" href="{{ asset('admin-assets/fonts/material.css') }}">
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/style.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/style-preset.css') }}">
</head>

<body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-layout="vertical" data-pc-direction="ltr" data-pc-theme_contrast="" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <div class="auth-main">
        <div class="auth-wrapper v1">
            <div class="auth-form">
                <div class="card my-5">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="text-center">
                            <a href="#">
                                <img src="{{ \App\Helpers\CompanyHelper::getLogo() }}" 
                                     alt="{{ \App\Helpers\CompanyHelper::getName() }}" 
                                     style="max-height: 80px; max-width: 200px; object-fit: contain;">
                            </a>
                            <h5 class="mt-3 mb-0">{{ \App\Helpers\CompanyHelper::getName() }}</h5>
                            <p class="text-muted">Admin Panel</p>
                        </div>
                        
                        <!-- Alert Messages -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        
                        <!-- Separator -->
                        <div class="saprator my-3">
                            <span>LOGIN</span>
                        </div>
                        
                        <!-- Title -->
                        <h4 class="text-center f-w-500 mb-3">Login with your account</h4>
                        
                        <!-- Login Form -->
                        <form action="{{ route('admin.login.submit') }}" method="POST">
                            @csrf
                            
                            <!-- Username -->
                            <div class="form-group mb-3">
                                <input type="text" 
                                       class="form-control @error('username') is-invalid @enderror" 
                                       id="username" 
                                       name="username" 
                                       value="{{ old('username') }}"
                                       placeholder="Username"
                                       autofocus
                                       required>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Password -->
                            <div class="form-group mb-3">
                                <input type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password" 
                                       placeholder="Password"
                                       required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Remember Me & Forgot Password -->
                            <div class="d-flex mt-1 justify-content-between align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input input-primary" 
                                           type="checkbox" 
                                           id="remember" 
                                           name="remember">
                                    <label class="form-check-label text-muted" for="remember">Remember me?</label>
                                </div>
                                <h6 class="text-secondary f-w-400 mb-0">
                                    <a href="#" class="text-secondary">Forgot Password?</a>
                                </h6>
                            </div>
                            
                            <!-- Login Button -->
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Required Js -->
    <script src="{{ asset('admin-assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('admin-assets/js/script.js') }}"></script>
    <script src="{{ asset('admin-assets/js/theme.js') }}"></script>
    <script src="{{ asset('admin-assets/js/plugins/feather.min.js') }}"></script>
</body>
</html>
