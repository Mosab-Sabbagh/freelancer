<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{route('home')}}">
            <i class="fas fa-chart-line"></i> وظيفة
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#services"><i class="fas fa-search"></i> تصفح المشاريع</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about"><i class="fas fa-info-circle"></i> من نحن</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#testimonials"><i class="fas fa-comments"></i> آراء</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#FAQ"><i class="fas fa-blog"></i> الأسئلة الشائعة</a>
                </li>
            </ul>
            <div class="d-flex">
                <a href="{{route('login')}}" class="btn btn-outline-light me-2">
                    <i class="fas fa-sign-in-alt"></i> دخول
                </a>
                <a href="{{route('register')}}" class="btn btn-light">
                    <i class="fas fa-user-plus"></i> حساب جديد
                </a>
            </div>
        </div>
    </div>
</nav>