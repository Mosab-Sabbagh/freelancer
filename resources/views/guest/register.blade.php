@extends('guest.layouts.app')
@section('title')
    إنشاء حساب جديد
@endsection
@section('content')
    <div class="main-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card">
                        <div class="text-center mb-4">
                            <i class="fas fa-user-plus fa-3x text-primary mb-3"></i>
                            <h2 class="fw-bold">إنشاء حساب جديد</h2>
                            <p class="text-muted">انضم إلينا وابدأ رحلتك في عالم العمل الحر</p>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="name" value="{{old('name')}}" class="form-control"
                                            id="firstName" placeholder="الاسم الأول" required>
                                        <label for="firstName">الاسم الأول</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="last_name" value="{{old('last_name')}}"
                                            class="form-control" id="last_name" placeholder="الاسم الأخير">
                                        <label for="last_name">الاسم الأخير</label>
                                    </div>
                                    @error('last_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email"
                                    placeholder="البريد الإلكتروني" required>
                                <label for="email">البريد الإلكتروني</label>
                            </div>

                            <div class="form-floating mb-3">
                                <select class="form-select" name="user_type" id="accountType">
                                    <option value="" disabled selected> </option>
                                    <option value="job_seeker" {{ old('user_type') == 'job_seeker' ? 'selected' : '' }}>باحث
                                        عن عمل
                                        (مقدم خدمة)</option>
                                    <option value="job_poster" {{ old('user_type') == 'job_poster' ? 'selected' : '' }}>ناشر
                                        عمل
                                        (الحصول على خدمة)</option>
                                    <option value="supporter" {{ old('user_type') == 'supporter' ? 'selected' : '' }}>داعم
                                    </option>
                                </select>
                                <label for="accountType">نوع الحساب</label>
                                @error('user_type')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" name="password" value="{{old('password')}}" class="form-control"
                                    id="password" placeholder="كلمة المرور" required>
                                <label for="password">كلمة المرور</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" name="password_confirmation" value="{{old('password_confirmation')}}"
                                    class="form-control" id="confirmPassword" placeholder="تأكيد كلمة المرور" required>
                                <label for="confirmPassword">تأكيد كلمة المرور</label>
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    أوافق على <a href="#" class="text-decoration-none">الشروط والأحكام</a> و <a href="#"
                                        class="text-decoration-none">سياسة الخصوصية</a>
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mb-3">
                                <i class="fas fa-user-plus me-2"></i>إنشاء حساب
                            </button>
                        </form>

                        <div class="social-login">
                            <p>أو سجل باستخدام</p>
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

                        <div class="text-center mt-3">
                            <p class="mb-0">لديك حساب بالفعل؟ <a href="{{route('login')}}"
                                    class="text-decoration-none">تسجيل الدخول</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection