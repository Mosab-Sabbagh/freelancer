@extends('admin.layouts.app')
@section('title', ' إدارة المستخدمين')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>إدارة المستخدمين</h2>
        <a href="{{ route('admin.user.create') }}" class="btn btn-primary">
            <i class="fas fa-plus ml-1"></i>
            إضافة مستخدم جديد
        </a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>الاسم الأول</th>
                            <th>الاسم الثاني</th>
                            <th>البريد الإلكتروني</th>
                            <th>نوع المستخدم</th>
                            <th>الحالة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse($users   as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge bg-{{ $user->user_type === 'admin' ? 'danger' : 
                                    ($user->user_type === 'supporter' ? 'warning' :
                                    ($user->user_type === 'job_poster' ? 'info' : 'success')) }}">
                                    @if($user->user_type === 'admin')
                                        مشرف
                                    @elseif($user->user_type === 'job_seeker') 
                                        مستقل
                                    @elseif($user->user_type === 'job_poster') 
                                        ناشر عمل
                                    @elseif($user->user_type === 'supporter') 
                                        داعم
                                    @else
                                        {{ ucfirst(str_replace('_', ' ', $user->user_type)) }}
                                    @endif
                                </span>
                            </td>
                            <td>
                                @if($user->status === 'active')
                                    <span class="badge bg-success">مفعل</span>
                                @elseif($user->status === 'inactive')
                                    <span class="badge bg-danger">غير مفعل</span>
                                @else
                                    <span class="badge bg-warning">معلق</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="#" class="btn btn-sm btn-info" title="عرض">
                                        {{-- <a href="{{ route('admin.user.show', $user->id) }}" class="btn btn-sm btn-info" title="عرض"> --}}
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-warning toggle-status" 
                                            data-id="{{ $user->id }}" 
                                            data-status="{{ $user->status }}"
                                            title="{{ $user->status === 'active' ? 'تعطيل' : 'تفعيل' }}">
                                        <i class="fas fa-power-off"></i>
                                    </button>
                                    <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" class="delete-form" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger delete-user"
                                                data-id="{{ $user->id }}"
                                                title="حذف">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">لا يوجد مستخدمين</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $users->links() }}

            </div>
        </div>
    </div>
</div>
{{-- 
@push('scripts')
<script>
    // حذف المستخدم
    $('.delete-user').click(function() {
        const userId = $(this).data('id');
        
        Swal.fire({
            title: 'هل أنت متأكد؟',
            text: "لا يمكن التراجع عن هذا الإجراء!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'نعم، احذف!',
            cancelButtonText: 'إلغاء'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/user/delete/${userId}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        Swal.fire('تم الحذف!', 'تم حذف المستخدم بنجاح.', 'success');
                        location.reload();
                    }
                });
            }
        });
    });

    // تغيير حالة المستخدم
    $('.toggle-status').click(function() {
        const userId = $(this).data('id');
        const currentStatus = $(this).data('status');
        
        Swal.fire({
            title: 'هل أنت متأكد؟',
            text: `هل تريد ${currentStatus ? 'تعطيل' : 'تفعيل'} هذا المستخدم؟`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'نعم',
            cancelButtonText: 'إلغاء'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/user/toggle-status/${userId}`,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        Swal.fire('تم!', 'تم تغيير حالة المستخدم بنجاح.', 'success');
                        location.reload();
                    }
                });
            }
        });
    });
</script>
@endpush --}}
@endsection

