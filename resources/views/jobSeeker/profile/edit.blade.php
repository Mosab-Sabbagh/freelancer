@extends('jobSeeker.layouts.app')
@section('title')
    {{ Auth::user()->name }} - تعديل البيانات الشخصية
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">تعديل البيانات الشخصية</h4>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('jobSeeker.profile.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <!-- الصورة الشخصية -->
                            <div class="col-md-4 mb-4">
                                <div class="text-center">
                                    @if(Auth::user()->profile_picture)
                                        <img src="{{ asset('storage/public/' . Auth::user()->profile_picture) }}" 
                                             class="img-thumbnail mb-3" 
                                             style="width: 200px; height: 200px; object-fit: cover;" 
                                             alt="الصورة الشخصية">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center bg-light mb-3" 
                                             style="width: 200px; height: 200px; margin: 0 auto;">
                                            <span class="text-muted">لا توجد صورة</span>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <input type="file" class="form-control-file" id="profile_picture" name="profile_picture">
                                        <small class="form-text text-muted">الصور المسموح بها: jpeg, png, jpg</small>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- البيانات الأساسية -->
                            <div class="col-md-8">
                                <div class="form-row">
                                    <!-- النبذة -->
                                    <div class="form-group col-md-12">
                                        <label for="bio" class="font-weight-bold">نبذة عنك</label>
                                        <textarea class="form-control @error('bio') is-invalid @enderror" 
                                                  id="bio" name="bio" rows="3" 
                                                  required>{{ old('bio', Auth::user()->bio) }}</textarea>
                                        @error('bio')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <!-- تاريخ الميلاد -->
                                    <div class="form-group col-md-6">
                                        <label for="birth_date" class="font-weight-bold">تاريخ الميلاد</label>
                                        <input type="date" class="form-control @error('birth_date') is-invalid @enderror" 
                                               id="birth_date" name="birth_date" 
                                               value="{{ old('birth_date', Auth::user()->birth_date) }}" required>
                                        @error('birth_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <!-- التخصص -->
                                    <div class="form-group col-md-6">
                                        <label for="specialization" class="font-weight-bold">التخصص</label>
                                        <input type="text" class="form-control @error('specialization') is-invalid @enderror" 
                                               id="specialization" name="specialization" 
                                               value="{{ old('specialization', Auth::user()->specialization) }}" required>
                                        @error('specialization')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr class="my-4">
                        
                        <div class="row">
                            <!-- المهارات -->
                            <div class="form-group col-md-6">
                                <label for="skills" class="font-weight-bold">المهارات</label>
                                @php
                                    $allSkills = ['برمجة', 'تصميم', 'إدارة مشاريع', 'تسويق', 'كتابة', 'تحليل بيانات'];
                                    $userSkills = explode(',', Auth::user()->skills);
                                @endphp
                                <select class="form-control select2-multiple @error('skills') is-invalid @enderror" 
                                        id="skills" name="skills[]" multiple required>
                                    @foreach($allSkills as $skill)
                                        <option value="{{ $skill }}" {{ in_array($skill, $userSkills) ? 'selected' : '' }}>{{ $skill }}</option>
                                    @endforeach
                                </select>
                                @error('skills')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <!-- المجال -->
                            <div class="form-group col-md-6">
                                <label for="field" class="font-weight-bold">المجال</label>
                                <input type="text" class="form-control @error('field') is-invalid @enderror" 
                                       id="field" name="field" 
                                       value="{{ old('field', Auth::user()->field) }}" required>
                                @error('field')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <!-- مستوى الخبرة -->
                            <div class="form-group col-md-4">
                                <label for="experience_level" class="font-weight-bold">مستوى الخبرة</label>
                                <select class="form-control @error('experience_level') is-invalid @enderror" 
                                        id="experience_level" name="experience_level" required>
                                    @php
                                        $levels = ['مبتدئ', 'متوسط', 'محترف'];
                                    @endphp
                                    @foreach($levels as $level)
                                        <option value="{{ $level }}" {{ old('experience_level', Auth::user()->experience_level) == $level ? 'selected' : '' }}>{{ $level }}</option>
                                    @endforeach
                                </select>
                                @error('experience_level')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <!-- التقييم -->
                            <div class="form-group col-md-4">
                                <label for="rating" class="font-weight-bold">التقييم (من 5)</label>
                                <input type="number" class="form-control @error('rating') is-invalid @enderror" 
                                       id="rating" name="rating" min="0" max="5" step="0.1" 
                                       value="{{ old('rating', Auth::user()->rating) }}" required>
                                @error('rating')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <!-- الأجر بالساعة -->
                            <div class="form-group col-md-4">
                                <label for="hourly_rate" class="font-weight-bold">الأجر بالساعة ($)</label>
                                <input type="number" class="form-control @error('hourly_rate') is-invalid @enderror" 
                                       id="hourly_rate" name="hourly_rate" min="0" 
                                       value="{{ old('hourly_rate', Auth::user()->hourly_rate) }}" required>
                                @error('hourly_rate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <!-- الحالة -->
                            <div class="form-group col-md-12">
                                <label for="available" class="font-weight-bold">الحالة</label>
                                <select class="form-control @error('available') is-invalid @enderror" 
                                        id="available" name="available" required>
                                    <option value="1" {{ old('available', Auth::user()->available) ? 'selected' : '' }}>متاح للعمل</option>
                                    <option value="0" {{ !old('available', Auth::user()->available) ? 'selected' : '' }}>غير متاح للعمل</option>
                                </select>
                                @error('available')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary px-4 py-2">
                                <i class="fas fa-save ml-2"></i> حفظ التعديلات
                            </button>
                            <a href="{{ route('jobSeeker.dash') }}" class="btn btn-outline-secondary px-4 py-2">
                                <i class="fas fa-times ml-2"></i> إلغاء
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        border: none;
        border-radius: 10px;
    }
    
    .card-header {
        border-radius: 10px 10px 0 0 !important;
        padding: 1.25rem 1.5rem;
    }
    
    .form-control {
        border-radius: 5px;
        padding: 0.75rem 1rem;
    }
    
    .select2-multiple {
        width: 100% !important;
    }
    
    .btn {
        border-radius: 5px;
        font-weight: 600;
    }
    
    hr {
        border-top: 1px solid #eee;
    }
    
    .invalid-feedback {
        font-size: 0.85rem;
    }
</style>
@endsection

@section('scripts')
@if(config('app.locale') == 'ar')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2-multiple').select2({
                placeholder: "اختر المهارات",
                allowClear: true
            });
        });
    </script>
@endif
@endsection