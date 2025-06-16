@extends('jobSeeker.layouts.app')

@section('title', 'تصفح الوظائف')

@section('content')
<div class="container main-container">
    <div class="row">
        <!-- الفلاتر -->
        <div class="col-lg-3">
            <div class="filter-section">
                <div class="md-4 mb-4">
                    <input type="text" class="form-control" id="searchInput" placeholder="ابحث عن مشاريع...">
                </div>
                <div class="mb-4">
                    <form action="">
                        @foreach ($services as $service)
                            <div class="form-check mb-2"> <input type="checkbox" name="service_id[]" class="form-check-input p-2 service-filter" 
                                        id="service_{{ $service->id }}" value="{{ $service->id }}">
                                <label class="form-check-label" for="service_{{ $service->id }}">
                                    {{ $service->name }}
                                </label>
                            </div>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-9" id="projectsContainer">
            @include('jobSeeker.jobs._jobs_list', ['jobs' => $jobs])
            
            <!-- Loading Indicator -->
            <div class="loader-container d-none" id="loaderContainer">
                <div class="loader">
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
$(document).ready(function() {
    // فلترة حسب نوع الخدمة
    $('.service-filter').change(function() {
        filterProjects();
    });

    // فلترة حسب البحث
    $('#searchInput').keyup(function() {
        filterProjects();
    });

    function filterProjects() {
        let selectedServices = [];
        $('.service-filter:checked').each(function() {
            selectedServices.push($(this).val());
        });

        let searchQuery = $('#searchInput').val();

        $.ajax({
            url: "{{ route('jobseeker.jobs.index') }}",
            method: 'GET',
            data: {
                service_id: selectedServices,
                search: searchQuery
            },
            success: function(response) {
                $('#projectsContainer').html(response);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
});
</script>

{{-- lodder --}}
<script>
    $(document).ready(function() {
        $('.service-filter').on('change', filterProjectsWithLoader);

        function filterProjectsWithLoader() {
            const loaderContainer = $('#loaderContainer');
            const projectsContainer = $('#projectsContainer');

            loaderContainer.removeClass('d-none');
            projectsContainer.css('opacity', '0.8');

            const selectedServices = $('.service-filter:checked').map(function() {
                return $(this).val();
            }).get();

            const searchQuery = $('#searchInput').val();

            $.ajax({
                url: "{{ route('jobseeker.jobs.index') }}",
                type: "GET",
                data: { service_id: selectedServices, search: searchQuery },
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                success: function(response) {
                    projectsContainer.html(response);
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                    toastr && toastr.error('حدث خطأ أثناء جلب البيانات');
                },
                complete: function() {
                    loaderContainer.addClass('d-none');
                    projectsContainer.css('opacity', '1');
                }
            });
        }
    });
</script>
@endsection