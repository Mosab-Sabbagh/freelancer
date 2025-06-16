            @if (filled($proposals))
                @foreach ($proposals as $proposal)
                    <div class="project-card mb-4 p-4 border rounded-3 shadow-sm bg-white">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <a href="{{route('project.details',$proposal->project->id)}}" class="text-decoration-none text-dark">
                                <h4 class="project-title fw-bold mb-0">{{ $proposal->project->title }}</h4>
                                    @if($proposal->execution_status === 'pending')
                                    <span class="badge bg-primary">بانتظار الموافقة</span>
                                    @elseif($proposal->execution_status === 'in_progress')
                                        <span class="badge bg-warning"> قيد التنفيذ</span>
                                    @elseif($proposal->execution_status === 'completed')
                                        <span class="badge bg-success"> مكتمل</span>
                                    @elseif($proposal->execution_status === 'rejected')
                                        <span class="badge bg-danger"> مستبعد</span>
                                    @else
                                        <span>{{$proposal->execution_status}}</span>
                                    @endif
                            </a>
                            <span class="project-category">{{ $proposal->project->service->name }}</span>
                        </div>
                        
                        <!-- معلومات الناشر والوقت -->
                        <div class="d-flex align-items-center text-muted small mb-3">
                            
                            <span class="me-2"><i class="fas fa-user-circle me-1"></i>{{ $proposal->project->jobPoster->company?->name ??$proposal->project->jobPoster->user->name }}</span>
                            <span class="me-2"><i class="far fa-clock me-1"></i> منذ {{ $proposal->project->created_at->diffForHumans() }}</span>
                            <span class="me-2"><i class="fa-solid fa-dollar-sign"></i>  {{ $proposal->proposed_price }}</span>
                            <span class="me-2"><i class="fa-solid fa-clock"></i> مدة التفيذ {{ $proposal->execution_days }}</span>
                        </div>
                        
                        <p class="project-description mb-4 clamp-2-lines" style="white-space: pre-line;">
                            {{$proposal->notes}}
                        </p>
                        @if($proposal->execution_status === 'in_progress')
                            <a href="{{ route('deliveries.create', $proposal->project) }}" class="btn btn-success">تسليم المشروع</a>
                        @endif
                    </div>
                @endforeach
            @else
                <div class="d-flex justify-content-center ">
                    <h3 class="project-card mb-4 p-4 border rounded-3 shadow-sm bg-white">لا يوجد أعمال لهذا القسم  </h3>
                </div>
            @endif