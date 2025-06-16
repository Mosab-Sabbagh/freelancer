@extends('jobSeeker.layouts.app')

@section('title', 'تفاصيل الوظيفة')
@section('content')
    <div class="container main-container">
        <div class="row">
            <div class="col-lg-8">
                <div class="project-card mb-4 p-4 border rounded-3 shadow-sm bg-white">
                    <h4 class="project-title fw-bold mb-3">تفاصيل الوظيفة</h4>
                    <p class="project-description mb-4" style="white-space: pre-line;">
                        {{ $job->description }}
                    </p>
                </div>
                @if ($isApplied)
                    <div class="alert alert-info" role="alert">
                        <i class="fas fa-info-circle me-2"></i> لقد قمت بتقديم عرض لهذه الوظيفة بالفعل.
                    </div>
                @else    
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="apply-form-card p-4 border rounded-3 shadow-sm bg-white">
                                <h4 class="fw-bold mb-4">تقديم عرض للوظيفة</h4>
                                <form action="{{route('job.application.store',$job->id)}}" method="post">
                                    @csrf
                                    <input type="hidden" name="company_id" value="{{$job->company_id}}">
                                    <div class="mb-3">
                                        <label for="offerDetails" class="form-label">تفاصيل عرضك <span style="color: red">*</span></label>
                                        <textarea class="form-control" name="notes" id="offerDetails" rows="5" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-apply">
                                        <i class="fas fa-paper-plane me-1"></i> تقديم طلب
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
    
            <div class="col-lg-4">
                <div class="project-card-sidebar mb-4 p-4 border rounded-3 shadow-sm bg-white">
                    <h5 class="fw-bold mb-3">بطاقة الوظيفة</h5>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted small">حالة الوظيفة</span>
                        <span class="badge bg-success">مفتوح</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted small">تاريخ النشر</span>
                        <span class="small">{{ $job->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted small">نوع الوظيفة</span>
                        <span class="small text-success fw-bold">
                            @if ($job->job_type == 'full_time')
                                دوام كلي
                            @else
                                دوام جزئي -ساعات-    
                            @endif
                        </span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted small">الراتب</span>
                        <span class="small text-success fw-bold">{{ $job->salary_amount }} $</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="text-muted small">موعد انتهاء التقديم </span>
                        <span class="small">
                            {{$job->deadline}} 
                        </span>
                    </div>
    
                    <h5 class="fw-bold mb-3"> مجال الوظيفة</h5>
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <span class="badge bg-light text-dark border">{{ $job->service->name }}</span>
                    </div>
    
                    <h5 class="fw-bold mb-3">الشركة ناشرة الوظيفة</h5>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="small"><i class="fas fa-user-circle me-1"></i>{{ $job->company->name}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
