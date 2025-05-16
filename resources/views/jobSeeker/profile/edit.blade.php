@extends('jobSeeker.layouts.app')
@section('title')
    {{ Auth::user()->name }} - تعديل البيانات 
@endsection

@section('style')
<style>
    .profile-section {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 30px;
        border: 1px solid #eaeaea;
    }
    
    .section-title {
        color: #2c3e50;
        font-weight: 600;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f1f1f1;
    }
    
    .form-label {
        font-weight: 500;
        color: #495057;
        margin-bottom: 8px;
    }
    
    .form-control, .form-select {
        border-radius: 6px;
        padding: 10px 15px;
        border: 1px solid #ced4da;
        transition: all 0.3s;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    }
    
    .profile-image-container {
        width: 200px;
        height: 200px;
        margin: 0 auto 20px;
        border-radius: 50%;
        overflow: hidden;
        border: 4px solid #fff;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .profile-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .default-image {
        width: 100%;
        height: 100%;
        background-color: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
    }
    
    .skills-container, .services-container {
        max-height: 200px;
        overflow-y: auto;
        padding: 15px;
        background-color: #fff;
        border-radius: 8px;
        border: 1px solid #eaeaea;
    }
    
    .form-check {
        margin-bottom: 10px;
    }
    
    .form-check-input {
        margin-left: 5px;
    }
    
    .btn-primary {
        background-color: #3498db;
        border-color: #3498db;
        padding: 10px 25px;
        font-weight: 500;
    }
    
    .btn-outline-secondary {
        padding: 10px 25px;
        font-weight: 500;
    }
    
    .input-group-text {
        background-color: #f8f9fa;
    }
    
    .invalid-feedback {
        font-size: 0.85rem;
    }
    
    .icon {
        margin-left: 8px;
        color: #3498db;
    }
</style>
@endsection

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
                
                <div class="card-body px-4 py-3">
                    <form action="{{ route('jobSeeker.profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- قسم المعلومات الأساسية -->
                        <div class="profile-section">
                            <h5 class="section-title"><i class="fas fa-user-circle icon"></i>المعلومات الأساسية</h5>
                            
                            <div class="row">
                                <!-- الصورة الشخصية -->
                                <div class="col-md-4">
                                    <div class="text-center">
                                        <div class="profile-image-container">
                                            @if($user->jobSeeker->profile_picture)
                                                <img src="{{ asset('storage/' . $user->jobSeeker->profile_picture) }}" 
                                                    class="profile-image" 
                                                    alt="الصورة الشخصية">
                                            @else
                                                <div class="default-image">
                                                    <i class="fas fa-user fa-4x"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="profile_picture" class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-camera mr-1"></i> تغيير الصورة
                                            </label>
                                            <input type="file" class="form-control-file d-none" id="profile_picture" 
                                                   name="profile_picture" accept="image/jpeg,image/png,image/jpg">
                                            <small class="text-muted d-block mt-2">JPEG, PNG, JPG - الحد الأقصى 2MB</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- النبذة الشخصية -->
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="bio" class="form-label">نبذة عنك</label>
                                        <textarea class="form-control @error('bio') is-invalid @enderror" 
                                                id="bio" name="bio" rows="10" 
                                                placeholder="أخبرنا عن نفسك وخبراتك..."
                                                required>{{ old('bio', $user->jobSeeker->bio ?? '') }}</textarea>
                                        @error('bio')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- قسم المهارات والخدمات -->
                        <div class="profile-section">
                            <h5 class="section-title"><i class="fas fa-tools icon"></i>المهارات والخدمات</h5>
                            
                            <div class="row">
                                <!-- الخدمات -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">الخدمات</label>
                                        <div class="services-container">
                                            @foreach($services as $service)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" 
                                                        name="services[]" value="{{ $service->id }}"
                                                        id="service_{{ $service->id }}"
                                                        {{ in_array($service->id, old('services', $user->jobSeeker->services->pluck('id')->toArray())) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="service_{{ $service->id }}">
                                                        {{ $service->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('services')
                                            <span class="text-danger small d-block mt-1"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- المهارات -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">المهارات</label>
                                        <div class="skills-container">
                                            @foreach($skills as $skill)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" 
                                                        name="skills[]" value="{{ $skill->id }}"
                                                        id="skill_{{ $skill->id }}"
                                                        {{ in_array($skill->id, old('skills', $user->jobSeeker->skills->pluck('id')->toArray())) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="skill_{{ $skill->id }}">
                                                        {{ $skill->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('skills')
                                            <span class="text-danger small d-block mt-1"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                

                            </div>
                        </div>
                        
                        <!-- قسم المعلومات المهنية -->
                        <div class="profile-section">
                            <h5 class="section-title"><i class="fas fa-briefcase icon"></i>المعلومات المهنية</h5>
                            
                            <div class="row">
                                <!-- مستوى الخبرة -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="experience_level" class="form-label">مستوى الخبرة</label>
                                        <select class="form-select @error('experience_level') is-invalid @enderror" 
                                                id="experience_level" name="experience_level" required>
                                            <option value="beginner" {{ old('experience_level', $user->jobSeeker?->experience_level) == 'beginner' ? 'selected' : '' }}>مبتدئ</option>
                                            <option value="intermediate" {{ old('experience_level', $user->jobSeeker?->experience_level) == 'intermediate' ? 'selected' : '' }}>متوسط</option>
                                            <option value="expert" {{ old('experience_level', $user->jobSeeker?->experience_level) == 'expert' ? 'selected' : '' }}>خبير</option>
                                        </select>
                                        @error('experience_level')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- الأجر بالساعة -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="hourly_rate" class="form-label">الأجر بالساعة</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control @error('hourly_rate') is-invalid @enderror" 
                                                    id="hourly_rate" name="hourly_rate" min="0" step="0.01"
                                                    value="{{ old('hourly_rate', $user->jobSeeker?->hourly_rate) }}" required>
                                        </div>
                                        @error('hourly_rate')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- الحالة -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="is_available" class="form-label">الحالة</label>
                                        <select class="form-select @error('is_available') is-invalid @enderror" 
                                                id="is_available" name="is_available" required>
                                            <option value="1" {{ old('is_available', $user->jobSeeker?->is_available) ? 'selected' : '' }}>متاح للعمل</option>
                                            <option value="0" {{ !old('is_available', $user->jobSeeker?->is_available) ? 'selected' : '' }}>غير متاح للعمل</option>
                                        </select>
                                        @error('is_available')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- أزرار الحفظ والإلغاء -->
                        <div class="form-group mt-4 text-center">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save mr-1"></i> حفظ التعديلات
                            </button>
                            <a href="{{ route('jobSeeker.dash') }}" class="btn btn-outline-secondary px-4">
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

@section('scripts')
<script>
    $(document).ready(function() {
        // Preview image before upload
        $("#profile_picture").change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    if($('.profile-image').length) {
                        $('.profile-image').attr('src', e.target.result);
                    } else {
                        $('.default-image').replaceWith('<img src="' + e.target.result + '" class="profile-image">');
                    }
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>
@endsection