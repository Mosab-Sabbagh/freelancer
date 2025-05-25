
@if (filled($projects))
    @foreach ($projects as $project)
    <div class="project-card mb-4 p-4 border rounded-3 shadow-sm bg-white">
        <!-- العنوان وبيانات الناشر -->
        <div class="d-flex justify-content-between align-items-start mb-2">
            <a href="{{route('project.details',$project->id)}}" class="text-decoration-none text-dark">
                <h4 class="project-title fw-bold mb-0">{{ $project->title }}</h4>
            </a>
            <span class="project-category">{{ $project->service->name }}</span>
        </div>
        
        <!-- معلومات الناشر والوقت -->
        <div class="d-flex align-items-center text-muted small mb-3">
            
            <span class="me-2"><i class="fas fa-user-circle me-1"></i>{{ $project->jobPoster->company?->name ??$project->jobPoster->user->name }}</span>
            <span class="me-2"><i class="far fa-clock me-1"></i> منذ {{ $project->created_at->diffForHumans() }}</span>
            <span><i class="fas fa-paper-plane me-1"></i> 12 عروض</span>
        </div>
        
        <!-- وصف المشروع -->
        <p class="project-description mb-4 clamp-2-lines" style="white-space: pre-line;">
            {{ Str::limit($project->description, 150, '') }} ..... 
        </p>
        
        <!-- الميزانية وزر الإجراءات -->
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <a href="{{route('project.details',$project->id)}}" class="btn btn-primary btn-apply">
                    <i class="fas fa-paper-plane me-1"></i>تقديم عرض
                </a>
            </div>
        </div>
    </div>
    @endforeach
@else
<div class="d-flex justify-content-center ">
    <h3 >لا يوجد أعمال لهذا القسم منشورة لحتى الآن  </h3>
</div>
@endif

{{ $projects->links() }}
