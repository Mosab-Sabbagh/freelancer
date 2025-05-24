@extends('jobPoster.layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom-0 py-4">
                    <h3 class="mb-0 text-center" style="color: #3498db">
                        <i class="fas fa-user-edit icon"></i>تعديل البيانات الخاصة بالشركة    
                    </h3>
                </div>
                <div class="px-4 py-3">
                    <form action="{{ route('company.update', Auth::user()->jobPoster->company->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row align-items-start">
                            <!--  شعار  الشركة -->
                            <div class="col-md-4 text-center">
                                <div class="profile-image-container mb-3">
                                    @if($jobPoster->company->logo)
                                        <img src="{{ asset('storage/' . $jobPoster->company->logo) }}" 
                                            class="profile-image" 
                                            alt="شعار الشركة"
                                            style="width: 200px; height: 200px; border-radius: 50%;">
                                    @else
                                        <div class="default-image">
                                            <i class="fas fa-user fa-4x"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="logo" class="btn btn-outline-primary btn-sm mt-2">
                                        <i class="fas fa-camera mr-1"></i> تغيير الشعار
                                    </label>
                                    <input type="file" class="form-control-file d-none" id="logo" 
                                            name="logo" accept="image/jpeg,image/png,image/jpg">
                                    <small class="text-muted d-block mt-2">JPEG, PNG, JPG - الحد الأقصى 2MB</small>
                                </div>
                            </div>
                
                            <!-- البيانات الأساسية -->
                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label for="name">اسم الشركة</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ $jobPoster->company->name }}">
                                </div>
                
                                <div class="form-group mb-3">
                                    <label for="description">نبذة تعريفية:</label>
                                    <textarea class="form-control" name="description"
                                        id="description" placeholder="الخدمات التي تقدمها الشركة مع وصف كل خدمة..." rows="5">{{ $jobPoster->company->description }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label for="email">البريد الالكتروني الخاص بالشركة</label>
                                    <input type="text" class="form-control" name="email" id="email" value="{{ $jobPoster->company->email }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="phone">رقم الجوال:</label>
                                    <input type="text" class="form-control" name="phone" id="phone" value="{{ $jobPoster->company->phone }}">
                                </div>
                            </div>
                            
                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label for="website">الموقع الالكتروني (رابط)</label>
                                    <input type="text" class="form-control" name="website" id="website" value="{{ $jobPoster->company->website }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="address">عنوان الشركة</label>
                                    <input type="text" class="form-control" name="address" id="address" value="{{ $jobPoster->company->address }}">
                                </div>
                            </div>

                        </div>
                
                        <!-- زر الحفظ -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary px-5">حفظ التعديلات</button>
                            <a href="{{ route('jobPoster.dash') }}" class="btn btn-outline-secondary px-4">
                                <i class="fas fa-times mr-1"></i> إلغاء
                            </a>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection
