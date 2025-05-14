@extends('guest.layouts.app')

@section('title')
    إعادة تعيين كلمة المرور
@endsection


@section('content')
    <div class="main-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card">
                        <div class="text-center mb-4">
                            <i class="fas fa-user-circle fa-3x text-primary mb-3"></i>
                            <h2 class="fw-bold">إعادة تعيين كلمة المرور</h2>
                        </div>

                        <form method="POST" action="{{ route('password.store') }}">
                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="email" name="email" value="{{old('email', $request->email)}}"
                                    class="form-control" id="email" placeholder="البريد الإلكتروني" autofocus
                                    autocomplete="username">
                                <label for="email">البريد الإلكتروني</label>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" name="password" value="{{old('password')}}" class="form-control"
                                    id="password" placeholder="كلمة المرور">
                                <label for="password">كلمة المرور</label>
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" name="password_confirmation" value="{{old('password_confirmation')}}"
                                    class="form-control" id="password" placeholder="كلمة المرور">
                                <label for="password_confirmation">تأكيد كلمة المرور</label>
                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>


                            <button type="submit" class="btn btn-primary w-100 mb-3">
                                <i class="fas fa-refresh me-2"></i> إعادة تعيين
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection