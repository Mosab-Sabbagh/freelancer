<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="dashbord.html">
            <i class="fas fa-chart-line"></i> وظيفة
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="add-project.html"><i class="fas fa-add"></i> أضف مشروع</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="browse-projects.html"><i class="fas fa-file-alt"></i> تصفح المشاريع</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="my-proposals.html"><i class="fas fa-tags"></i> عروضي</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="my-projects.html"><i class="fas fa-briefcase"></i> أعمالي</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="portfolio.html"><i class="fas fa-images"></i> معرضي</a>
                </li>
            </ul>

            <ul class="navbar-nav">
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        <span class="badge bg-danger">5</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">اشعار 1</a></li>
                        <li><a class="dropdown-item" href="#">اشعار 2</a></li>
                        <li><a class="dropdown-item" href="#">اشعار 3</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink2" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-envelope"></i>
                        <span class="badge bg-danger">3</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink2">
                        <li><a class="dropdown-item" href="#">رسالة 1</a></li>
                        <li><a class="dropdown-item" href="#">رسالة 2</a></li>
                        <li><a class="dropdown-item" href="#">رسالة 3</a></li>
                    </ul>
                </li> --}}
                
                <li class="nav-item">
                    <div class="user-info">
                        <i class="fas fa-user-circle user-icon"></i>
                        <span>مرحباً، {{Auth::user()->name}}</span>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</nav>