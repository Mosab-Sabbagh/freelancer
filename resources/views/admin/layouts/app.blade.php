<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - لوحة التحكم</title>
    
    <!-- Bootstrap RTL CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="{{asset('css/bootsrab/bootsrab.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootsrab/bootsrab.js')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Google Fonts - Cairo -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom Admin CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--Datatable -->
    <!-- CSS -->
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"> --}}

    <!-- JS -->
    {{-- jQuery  && Datatable --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> --}}

    
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="sidebar-header">
            <h3>لوحة التحكم</h3>
        </div>
        
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home ml-2"></i>
                    الرئيسية
                </a>
            </li>
            <li>
                <a href="{{ route('admin.user.index') }}" class="{{ request()->routeIs('admin.user.index') ? 'active' : '' }}">
                    <i class="fas fa-users ml-2"></i>
                    المستخدمين
                </a>
            </li>
            <li>
                <a href="#" class="">
                    <i class="fas fa-briefcase ml-2"></i>
                    الوظائف
                </a>
            </li>
            <li>
                <a href="{{ route('admin.skill.index') }}" class="{{ request()->routeIs('admin.skill.index') ? 'active' : '' }}">
                    <i class="fas fa-list ml-2"></i>
                    المهارات
                </a>
            </li>
            <li>
                <a href="{{ route('admin.service.index') }}" class="{{ request()->routeIs('admin.service.index') ? 'active' : '' }}">
                    <i class="fas fa-handshake ml-2"></i>
                    الخدمات
                </a>
            </li>
            <li>
                <a href="{{ route('admin.workspace.index') }}" class="{{ request()->routeIs('admin.workspace.index') ? 'active' : '' }}">
                    <i class="fas fa-laptop ml-2"></i>
                    مساحات العمل
                </a>
            </li>
            <li>
                <a href="{{ route('admin.campaign.index') }}" class="{{ request()->routeIs('admin.campaign.index') ? 'active' : '' }}">
                    <i class="fas fa-hand-holding-heart ml-2"></i>
                    المبادرات 
                </a>
            </li>
            <li>
                <a href="#" class="">
                    <i class="fas fa-cog ml-2"></i>
                    الإعدادات
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="admin-main">
        <!-- Navbar -->
        <nav class="admin-navbar">
            <div class="navbar-brand">
                <button class="btn d-md-none" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <span class="d-none d-md-inline">@yield('title')</span>
            </div>
            
            <div class="navbar-nav">
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                        <i class="fas fa-user ml-2"></i>
                        @auth
                        {{ Auth::user()->name }}
                        @endauth
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user-edit ml-2"></i>
                                تعديل الملف الشخصي
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt ml-2"></i>
                                    تسجيل الخروج
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="container-fluid py-4">
            
            @yield('content')
        </div>
    </main>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom Admin JS -->
    <script>
        // Sidebar Toggle for Mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.admin-sidebar').classList.toggle('active');
            document.querySelector('.admin-main').classList.toggle('sidebar-active');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.admin-sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            
            if (window.innerWidth < 768 && 
                !sidebar.contains(event.target) && 
                !sidebarToggle.contains(event.target) &&
                sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
                document.querySelector('.admin-main').classList.remove('sidebar-active');
            }
        });
    </script>

        @include('alert')
        @yield('script')
    @stack('scripts')
</body>
</html> 