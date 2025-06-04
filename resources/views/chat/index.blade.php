@php
    $currentLayout = 'jobSeeker.layouts.app';
    if (Auth::check()) {
        if (Auth::user()->jobPoster) {
            $currentLayout = 'jobPoster.layouts.app';
        }
    }
@endphp

@extends($currentLayout)
@section('title', 'المراسلات')

@section('style')
<style>
    .chat-list-item .chat-avatar {
        width: 60px;
        height: 60px;
        object-fit: cover;
    }
    .chat-list-item .chat-project-title {
        font-weight: 600;
        color: #265073; /* Example color, adjust as needed */
    }
    .chat-list-item .chat-meta,
    .chat-list-item .chat-last-message {
        font-size: 0.875rem; /* 14px */
    }
    .list-group-item-action:hover .chat-project-title {
        text-decoration: underline;
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <h2 class="mb-4 text-center">المراسلات</h2>
            @if($chats->count() > 0)
                <div class="list-group shadow-sm">
                    @foreach ($chats as $chat)
                        @php
                            $otherPartyName = 'مستخدم غير معروف';
                            $otherPartyAvatar = asset('images/default-avatar.jpg');

                            if (Auth::user()->jobPoster) {
                                // المستخدم الحالي هو صاحب عمل، الطرف الآخر هو باحث عن عمل
                                if ($chat->seeker && $chat->seeker->user) {
                                    $otherPartyName = $chat->seeker->user->name;
                                    if ($chat->seeker->profile_picture) {
                                        $otherPartyAvatar = Storage::url($chat->seeker->profile_picture);
                                    }
                                }
                            } else {
                                // المستخدم الحالي هو باحث عن عمل، الطرف الآخر هو صاحب عمل
                                if ($chat->poster) {
                                    if ($chat->poster->company && $chat->poster->company->name) {
                                        $otherPartyName = $chat->poster->company->name;
                                        // افتراض أن الشعار قد يكون في $chat->poster->company->logo
                                        // أو صورة المستخدم في $chat->poster->user->profile_picture
                                        if ($chat->poster->company->logo) {
                                            $otherPartyAvatar = Storage::url($chat->poster->company->logo);
                                        } elseif ($chat->poster->user && $chat->poster->profile_image) {
                                            
                                            $otherPartyAvatar = Storage::url($chat->poster->profile_image);
                                        }
                                    } elseif ($chat->poster->user) {
                                        $otherPartyName = $chat->poster->user->name;
                                        if ($chat->poster->profile_image) {
                                            $otherPartyAvatar = Storage::url($chat->poster->profile_image);
                                        }
                                    }
                                }
                            }

                            // آخر رسالة والطابع الزمني
                            $latestMessage = $chat->messages->sortByDesc('created_at')->first();
                            $latestMessageText = $latestMessage ? Str::limit($latestMessage->message, 75) : 'لا توجد رسائل بعد، ابدأ المحادثة!';
                            // استخدام وقت آخر رسالة إن وجدت، وإلا وقت آخر تحديث للمحادثة
                            $chatTimestamp = $latestMessage ? $latestMessage->created_at->locale('ar')->diffForHumans() : $chat->updated_at->locale('ar')->diffForHumans();
                        @endphp

                        <a href="{{ route('chat.show', $chat->id) }}" class="list-group-item list-group-item-action py-3 chat-list-item">
                            <div class="d-flex w-100">
                                <div class="flex-grow-1 pe-3">
                                    <h5 class="mb-1 chat-project-title">
                                        {{-- إذا كان عنوان المشروع طويلاً جدًا، يمكنك استخدام Str::limit --}}
                                        {{ $chat->project->title ?? 'محادثة حول مشروع غير محدد' }}
                                    </h5>
                                    <div class="d-flex align-items-center text-muted chat-meta mb-1">
                                        <i class="fa-solid fa-user"></i>
                                        <span>{{ $otherPartyName }}</span>
                                        <span class="mx-2">&bull;</span>
                                        <i class="fa-regular fa-clock"></i>
                                        <span>{{ $chatTimestamp }}</span>
                                    </div>
                                    <p class="mb-0 text-muted chat-last-message">
                                        {{ $latestMessageText }}
                                    </p>
                                </div>
                                <div class="flex-shrink-0">
                                    <img src="{{ $otherPartyAvatar }}" alt="الصورة الرمزية لـ {{ $otherPartyName }}" class="rounded-circle chat-avatar">
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="card">
                    <div class="card-body text-center">
                        <i class="bi bi-envelope-open fs-1 text-muted mb-3"></i>
                        <p class="text-muted">لا توجد لديك أي مراسلات حتى الآن.</p>
                        {{-- يمكنك إضافة زر هنا لبدء محادثة أو العودة للصفحة الرئيسية --}}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection