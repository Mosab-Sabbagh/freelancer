@extends('admin.layouts.app')
@section('title', 'إضافة مباردة جديدة')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">إضافة مبادرة جديدة</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.campaign.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">اسم المبادرة</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="goal_amount" class="form-label">المبلغ المستهدف</label>
                            <input type="number" class="form-control" id="goal_amount" name="goal_amount" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="raised_amount" class="form-label">المبلغ الذي تم جمعه</label>
                            <input type="number" class="form-control" id="raised_amount" name="raised_amount" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status" class="form-label">الحالة</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="active">نشط</option>
                                <option value="cancelled">غير نشط</option>
                                <option value="completed">مكتمل</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="description" class="form-label">وصف المبادرة</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                        </div>
                    </div>
                </div>

                <div class="text-start mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save ml-1"></i>
                        حفظ
                    </button>
                    <a href="{{ route('admin.campaign.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times ml-1"></i>
                        إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
