@extends('guest.layouts.app')

@section('title')
    استعادة كلمة المرور
@endsection

@section('content')
    <div class="main-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card">

                        <div class="text-center mb-4">
                            <i class="fas fa-user-circle fa-3x text-primary mb-3"></i>
                            <h4 class="fw-bold"> استعادة كلمة المرور</h4>
                        </div>

                        <div>
                            @if (session()->has('status'))
                                @if (session('status'))
                                    <div class="alert alert-success text-center ">انظر للبريد</div>
                                @endif
                            @endif
                        </div>

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <!-- Email Address -->
                            <div class="form-floating mb-3">
                                <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email"
                                    placeholder="البريد الإلكتروني" required autofocus>
                                <label for="email">البريد الإلكتروني</label>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mb-3">
                                <i class="fas fa-refresh me-2"></i> إعادة تعيين كلمة المرور عبر البريد الالكتروني
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection