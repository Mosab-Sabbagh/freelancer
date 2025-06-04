@extends('jobSeeker.layouts.app')
@section('title','مساحات العمل')

@section('content')
<div class="container main-container">
    <div class="row">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white" >
                        <h5 class="mb-0" style="color: #000">قائمة مساحات العمل</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم المساحة</th>
                                        <th>المحافظة</th>
                                        <th>العنوان</th>
                                        <th>رقم الجوال</th>
                                        <th>الوقت المتاح</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($workspaces as $workspace)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $workspace->owner_name }}</td>
                                            <td>{{ $workspace->governorate }}</td>
                                            <td>{{ $workspace->address }}</td>
                                            <td>{{ $workspace->phone_number }}</td>
                                            <td>{{ $workspace->available_time }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center text-muted">لا يوجد مساحات مضافة حتى الان</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $workspaces->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection