<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{route('jobSeeker.dash')}}">
            <i class="fas fa-chart-line"></i> وظيفة
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('worksample.add')}}"><i class="fas fa-add"></i> أضف مشروع</a>
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
                    <a class="nav-link" href="{{route('worksample.index')}}"><i class="fas fa-images"></i> معرضي</a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    {{-- this class use in <a> dropdown-toggle  for show (>)  --}}
                    <a class="nav-link " href="#" id="navbarDropdownMenuLink" role="button"
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
                    <a class="nav-link " href="#" id="navbarDropdownMenuLink2" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-envelope"></i>
                        <span class="badge bg-danger">3</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink2">
                        <li><a class="dropdown-item" href="#">رسالة 1</a></li>
                        <li><a class="dropdown-item" href="#">رسالة 2</a></li>
                        <li><a class="dropdown-item" href="#">رسالة 3</a></li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="#" id="navbarDropdownMenuLink2" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{-- show user image profile --}}
                            @if(Auth()->user()->jobSeeker->profile_picture)
                                <img src="{{ asset('storage/' . Auth()->user()->jobSeeker->profile_picture) }}" class="rounded-circle" style="width: 30px; height: 30px;" alt="">
                            @else
                                <i class="fas fa-user-circle user-icon"></i>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink2">
                            <li><a class="dropdown-item" href="{{route('profile.show',Auth()->user()->id)}}"> الملف الشخصي</a></li>
                            
                            <li><a class="dropdown-item" href="{{route('profile.update-password')}}"> تغيير كلمة المرور</a></li>
                            
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item"  type="submit">تسجيل خروج</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </li>

            </ul>
        </div>
    </div>
</nav>