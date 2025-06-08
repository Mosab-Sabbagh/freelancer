{{-- < ?php dd(Auth::user()->jobSeeker->unreadNotifications)  ?> --}}

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
                    <a class="nav-link" href="{{route('jobseeker.projects.index')}}"><i class="fas fa-file-alt"></i> تصفح المشاريع</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('jobseeker.proposals')}}"><i class="fas fa-tags"></i> عروضي</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('worksample.index',Auth::user()->id)}}"><i class="fas fa-briefcase"></i> أعمالي</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('workspace.showForSeeker')}}"><i class="fas fa-layer-group"></i> مساحات العمل</a>
                </li>
                
            </ul>
            @php
                $unreadCount = Auth::user()->jobSeeker->unreadNotifications->count();
            @endphp
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link " href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        @if($unreadCount > 0)
                            <span class="badge bg-danger">
                                <span >{{ $unreadCount }}</span>
                            </span>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        @forelse (Auth::user()->jobSeeker->unreadNotifications as $notification)
                            <li>
                                <a class="dropdown-item" href="{{ route('notifications.read', $notification->id) }}">
                                    <strong>{{ $notification->data['title'] ?? 'بدون عنوان' }}</strong><br>
                                    <small>{{ $notification->data['body'] ?? '' }}</small>
                                </a>
                            </li>
                        @empty
                            @forelse (Auth::user()->jobSeeker->readNotifications as $notification)
                                <li>
                                    <a class="dropdown-item" href="{{$notification->data['url'] ?? '/'}}">
                                        <strong>{{ $notification->data['title'] ?? 'بدون عنوان' }}</strong><br>
                                        <small>{{ $notification->data['body'] ?? '' }}</small>
                                    </a>
                                </li>    

                            @empty
                                <li><a class="dropdown-item" href="javascript:;">لا توجد إشعارات جديدة</a></li>
                            @endforelse
                        @endforelse
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
                        <li><a class="dropdown-item mt-2" href="{{route('chat.index')}}"><i class="fas fa-envelope"></i>جميع المراسلات  </a></li>

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