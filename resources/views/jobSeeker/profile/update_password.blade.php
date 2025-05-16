@extends('jobSeeker.layouts.app')
@section('title')
    {{ Auth::user()->name }} - تعديل كلمة المرور
@endsection

@section('content')

    <div class="main-content container py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card">
                        <div class="text-center mb-4">
                            <i class="fas fa-user-circle fa-3x text-primary mb-3"></i>
                            <h2 class="fw-bold">تعديل  كلمة المرور</h2>
                        </div>

                        <form method="POST" action="{{ route('password.update') }}" class="p-2">
                            @csrf
                            @method('put')
                            @if (session(('error')))
                                <div class="alert alert-primary">
                                    {{session('error')}}
                                </div>
                            @endif
                            <div class="form-floating mb-3">
                                <input type="current_password" name="current_password"  class="form-control"
                                    id="current_password" placeholder="كلمة المرور الحالية" required>
                                <label for="password">كلمة المرور الحالية</label>

                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" name="password" value="{{old('password')}}"
                                    class="form-control" id="password" placeholder="كلمة المرور الجديدة" required>
                                <label for="password"> كلمة المرور الجديدة</label>

                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" name="password_confirmation" value="{{old('password_confirmation')}}"
                                    class="form-control" id="password_confirmation" placeholder=" تأكيد كلمة المرور الجديدة " required>
                                <label for="password_confirmation"> تأكيد كلمة المرور الجديدة</label>

                            </div>


                            <div class="text-start mt-3">
                                <button type="submit" class="btn btn-primary ">
                                    <i class="fas fa-refresh me-2"></i> إعادة تعيين
                                </button>
                                <a href="{{route('jobSeeker.dash')}}" class="btn btn-secondary p-2 ">
                                    <i class="fas fa-times ml-1"></i>
                                    إلغاء 
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection