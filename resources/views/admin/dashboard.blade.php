@extends('admin.layouts.app')

@section('title', 'لوحة التحكم')

@section('content')
<div class="row">
    <!-- إحصائيات سريعة -->
    <div class="col-md-3 mb-4">
        <div class="admin-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-2">إجمالي المستخدمين</h6>
                    <h3 class="mb-0">{{ $totalUsers }}</h3>
                </div>
                <div class="bg-primary bg-opacity-10 p-3 rounded">
                    <i class="fas fa-users text-primary fa-2x"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="admin-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-2">الوظائف النشطة</h6>
                    <h3 class="mb-0">5</h3>
                </div>
                <div class="bg-success bg-opacity-10 p-3 rounded">
                    <i class="fas fa-briefcase text-success fa-2x"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="admin-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-2">طلبات التوظيف</h6>
                    <h3 class="mb-0">5</h3>
                </div>
                <div class="bg-info bg-opacity-10 p-3 rounded">
                    <i class="fas fa-file-alt text-info fa-2x"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="admin-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-2">الشركات المسجلة</h6>
                    <h3 class="mb-0">{{$totalCompanies}}</h3>
                </div>
                <div class="bg-warning bg-opacity-10 p-3 rounded">
                    <i class="fas fa-building text-warning fa-2x"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- آخر المستخدمين المسجلين -->
    <div class="col-md-6 mb-4">
        <div class="admin-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">آخر المستخدمين المسجلين</h5>
                <a href="{{ route('admin.user.index') }}" class="btn btn-sm btn-primary">عرض الكل</a>
            </div>
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>البريد الإلكتروني</th>
                            <th>تاريخ التسجيل</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latestUsers as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- آخر الوظائف المضافة -->
    <div class="col-md-6 mb-4">
        <div class="admin-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">آخر الوظائف المضافة</h5>
                {{-- <a href="{{ route('admin.jobs.index') }}" class="btn btn-sm btn-primary">عرض الكل</a> --}}
                <a href="#" class="btn btn-sm btn-primary">عرض الكل</a>
            </div>
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>المسمى الوظيفي</th>
                            <th>الشركة</th>
                            <th>الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach($latestJobs as $job)
                        <tr>
                            <td>{{ $job->title }}</td>
                            <td>{{ $job->company->name }}</td>
                            <td>
                                <span class="badge bg-{{ $job->status === 'active' ? 'success' : 'warning' }}">
                                    {{ $job->status === 'active' ? 'نشط' : 'معلق' }}
                                </span>
                            </td>
                        </tr>
                        @endforeach --}}

                        <tr>
                            <td>عنوان الوظيفة</td>
                            <td>شركة العمل</td>
                            <td>
                                <span class="badge bg-success">
                                    نشط
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>عنوان الوظيفة</td>
                            <td>شركة العمل</td>
                            <td>
                                <span class="badge bg-success">
                                    معلق
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 