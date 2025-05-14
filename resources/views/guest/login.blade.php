@extends('guest.layouts.app')

@section('title')
    تسجيل الدخول
@endsection

@section('content')
    <div class="main-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card">
                        <div class="text-center mb-4">
                            <i class="fas fa-user-circle fa-3x text-primary mb-3"></i>
                            <h2 class="fw-bold">تسجيل الدخول</h2>
                            <p class="text-muted">مرحباً بعودتك! قم بتسجيل الدخول للوصول إلى حسابك</p>
                        </div>
                        
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email" placeholder="البريد الإلكتروني">
                                <label for="email">البريد الإلكتروني</label>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input type="password" name="password" value="{{old('email')}}" class="form-control" id="password" placeholder="كلمة المرور">
                                <label for="password">كلمة المرور</label>
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"  name="remember" id="remember">
                                    <label class="form-check-label" for="remember">تذكرني</label>
                                </div>
                                <a href="{{route('password.request')}}" class="text-decoration-none">نسيت كلمة المرور؟</a>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100 mb-3">
                                <i class="fas fa-sign-in-alt me-2"></i>تسجيل الدخول
                            </button>
                            
                            <div class="text-center">
                                <p class="mb-0">ليس لديك حساب؟ <a href="{{route('register')}}" class="text-decoration-none">إنشاء حساب جديد</a></p>
                            </div>
                        </form>
                        
                        <div class="social-login">
                            <p>أو سجل الدخول باستخدام</p>
                            <div class="social-buttons">
                                <a href="#" class="btn-social btn-google">
                                    <i class="fab fa-google"></i>
                                </a>
                                <a href="#" class="btn-social btn-facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="btn-social btn-twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection