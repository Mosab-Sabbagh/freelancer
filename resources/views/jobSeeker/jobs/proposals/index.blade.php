@extends('jobSeeker.layouts.app')
@section('title','عروضي')

@section('content')

<div class="container main-container">
    <div class="row">
        <div class="col-lg-3 ">
            <div class="filter-section">
                <div class="md-4 mb-4">
                    <p>الحالة</p>
                </div>
                <div class="mb-4">
                    <form id="filterForm">
                        @csrf
                        <div class="form-check mb-2">
                            <input type="checkbox" name="execution_status[]" class="form-check-input p-2 service-filter" 
                                id="pending" value="pending">
                            <label class="form-check-label" for="pending">
                                بانتظار الموافقة
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input type="checkbox" name="execution_status[]" class="form-check-input p-2 service-filter" 
                                id="accepted" value="accepted">
                            <label class="form-check-label" for="accepted">
                                مقبول
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input type="checkbox" name="execution_status[]" class="form-check-input p-2 service-filter" 
                                id="rejected" value="rejected">
                            <label class="form-check-label" for="rejected">
                                مستبعد
                            </label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-9" id="proposalsContainer">
            @include('jobSeeker.jobs.proposals.proposals_list', ['proposals' => $proposals])
        
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
{{-- filter js --}}
    <script>
        $(document).ready(function() {
            $('.service-filter').change(function() {
                filterProposals();
            });

            function filterProposals() {
                let selectedStatuses = [];
                $('.service-filter:checked').each(function() {
                    selectedStatuses.push($(this).val());
                });

                $.ajax({
                    url: "{{ route('jobseeker.proposals.jobs') }}",
                    type: "GET",
                    data: {
                        execution_status: selectedStatuses
                    },
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(response) {
                        $('#proposalsContainer').html(response);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    </script>

{{-- Loading --}}
    <script>
        $(document).ready(function() {
            $('.service-filter').on('change', filterProposals);

            function filterProposals() {
                const loaderContainer = $('#loaderContainer');
                const proposalsContainer = $('#proposalsContainer');

                loaderContainer.removeClass('d-none');
                proposalsContainer.css('opacity', '0.6');

                const selectedStatuses = $('.service-filter:checked').map(function() {
                    return $(this).val();
                }).get();

                $.ajax({
                    url: "{{ route('jobseeker.proposals.jobs') }}",
                    type: "GET",
                    data: { execution_status: selectedStatuses },
                    headers: { 'X-Requested-With': 'XMLHttpRequest' },
                    success: function(response) {
                        proposalsContainer.html(response);
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
                        toastr.error('حدث خطأ أثناء جلب البيانات');
                    },
                    complete: function() {
                        loaderContainer.addClass('d-none');
                        proposalsContainer.css('opacity', '1');
                    }
                });
            }
        });
    </script>
@endsection