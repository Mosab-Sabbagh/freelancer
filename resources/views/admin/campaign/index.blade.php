@extends('admin.layouts.app')

@section('title', 'المبادرات')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>المبادرات</h2>
        <a href="{{ route('admin.campaign.create') }}" class="btn btn-primary">
            <i class="fas fa-plus ml-1"></i>
            إضافة مبادرة جديدة
        </a>
    </div>
</div>
<div class="container">
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>اسم المبادرة</th>
                            <th>المبلغ المستهدف</th>
                            <th>المبلغ الذي تم جمعه</th>
                            <th>الحالة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($campaigns as $campaign)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $campaign->name }}</td>
                                <td>{{ $campaign->goal_amount }}</td>
                                <td>{{ $campaign->raised_amount }}</td>
                                <td>
                                    @if($campaign->status == 'active')
                                        <span class="badge bg-success">نشط</span>
                                    @elseif($campaign->status == 'cancelled') 
                                        <span class="badge bg-danger">غير نشط</span>
                                    @else
                                        <span class="badge bg-info">مكتمل</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{route('admin.campaign.edit',$campaign->id)}}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{route('admin.campaign.destroy',$campaign->id)}}" method="post" class="d-inline delete-form" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">لا توجد مبادرات</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection