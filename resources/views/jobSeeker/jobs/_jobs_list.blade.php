@php
use App\Services\Jobs\JobApplicationService; // تأكد من المسار الصحيح
@endphp
@if (filled($jobs))
    @foreach ($jobs as $job)
    <div class="project-card mb-4 p-4 border rounded-3 shadow-sm bg-white">
        <!-- العنوان وبيانات الناشر -->
        <div class="d-flex justify-content-between align-items-start mb-2">
            <a href="{{route('job.details',$job->id)}}" class="text-decoration-none text-dark">
                <h4 class="project-title fw-bold mb-0">{{ $job->title }}</h4>
            </a>
            <span class="project-category">{{ $job->service->name }}</span>
        </div>
        
        <!-- معلومات الناشر والوقت -->
        <div class="d-flex align-items-center text-muted small mb-3">
            <span class="me-2"><i class="fas fa-user-circle me-1"></i>{{ $job->company->name }}</span>
            <span class="me-2"><i class="far fa-clock me-1"></i> منذ {{ $job->created_at->diffForHumans() }}</span>
            <span><i class="fas fa-paper-plane me-1"></i> {{  $job->applications_count }} عروض</span>
        </div>
        
        <!-- وصف المشروع -->
        <p class="project-description mb-4 clamp-2-lines" style="white-space: pre-line;">
            {{ Str::limit($job->description, 150, '') }} ..... 
        </p>
        
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <a href="{{route('job.details',$job->id)}}" class="btn btn-primary btn-apply">
                    <i class="fas fa-paper-plane me-1"></i>تقديم طلب
                </a>
            </div>
        </div>
    </div>
    @endforeach
@else
<div class="d-flex justify-content-center ">
    <h3 >لا يوجد وظائف لهذا القسم منشورة لحتى الآن  </h3>
</div>
@endif

{{ $jobs->links() }}
