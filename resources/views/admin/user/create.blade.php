@extends('admin.layouts.app')
@section('title', 'إضافة مستخدم جديد')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">إضافة مستخدم جديد</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.user.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">الاسم الأول</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="last_name" class="form-label">الاسم الثاني</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">البريد الإلكتروني</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password" class="form-label">كلمة المرور</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="user_type" class="form-label" value="" disabled selected>نوع المستخدم</label>
                            <select class="form-select" id="user_type" name="user_type" required>
                                <option value="">اختر نوع المستخدم</option>
                                <option value="job_seeker">باحث عن عمل</option>
                                <option value="job_poster">صاحب عمل</option>
                                <option value="supporter">داعم</option>
                                <option value="admin">مشرف</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status" class="form-label">الحالة</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="active">مفعل</option>
                                <option value="inactive">غير مفعل</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="text-start mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save ml-1"></i>
                        حفظ
                    </button>
                    <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times ml-1"></i>
                        إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
