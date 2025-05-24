@extends('jobPoster.layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom-0 py-4">
                    <h3 class="mb-0 text-center" style="color: #3498db">
                        <i class="fas fa-user-edit icon"></i>تعديل البيانات الشخصية    
                    </h3>
                </div>
                <div class="px-4 py-3">
                    <form action="{{ route('jobposter.update', Auth::user()->jobPoster->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row align-items-start">
                            <!-- صورة الملف الشخصي -->
                            <div class="col-md-4 text-center">
                                <div class="profile-image-container mb-3">
                                    @if($jobPoster->profile_image)
                                        <img src="{{ asset('storage/' . $jobPoster->profile_image) }}" 
                                            class="profile-image" 
                                            alt="الصورة الشخصية"
                                            style="width: 200px; height: 200px; border-radius: 50%;">
                                    @else
                                        <div class="default-image">
                                            <i class="fas fa-user fa-4x"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="profile_image" class="btn btn-outline-primary btn-sm mt-2">
                                        <i class="fas fa-camera mr-1"></i> تغيير الصورة
                                    </label>
                                    <input type="file" class="form-control-file d-none" id="profile_image" 
                                            name="profile_image" accept="image/jpeg,image/png,image/jpg">
                                    <small class="text-muted d-block mt-2">JPEG, PNG, JPG - الحد الأقصى 2MB</small>
                                </div>
                            </div>
                
                            <!-- البيانات الشخصية -->
                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label for="phone">رقم الجوال:</label>
                                    <input type="text" class="form-control" name="phone" id="phone" value="{{ $jobPoster->phone }}">
                                </div>
                
                                <div class="form-group mb-3">
                                    <label for="bio">نبذة تعريفية:</label>
                                    <textarea class="form-control" name="bio" id="bio" rows="5">{{ $jobPoster->bio }}</textarea>
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
