@extends('admin.layouts.app')
@section('title', 'تعديل مباردة ')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"> تعديل مباردة  </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.campaign.update',$campaign->id ) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">اسم المبادرة</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $campaign->name }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="goal_amount" class="form-label">المبلغ المستهدف</label>
                            <input type="number" class="form-control" id="goal_amount" name="goal_amount" value="{{ $campaign->goal_amount }}"  required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="raised_amount" class="form-label">المبلغ الذي تم جمعه</label>
                            <input type="number" class="form-control" id="raised_amount" name="raised_amount" value="{{ $campaign->raised_amount }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status" class="form-label">الحالة</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="active" {{ $campaign->status == 'active' ? 'selected' : '' }}>نشط</option>
                                <option value="cancelled" {{ $campaign->status == 'cancelled' ? 'selected' : '' }}>غير نشط</option>
                                <option value="completed" {{ $campaign->status == 'completed' ? 'selected' : '' }}>مكتمل</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="description" class="form-label">وصف المبادرة</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required> {{ $campaign->description }}</textarea>
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
