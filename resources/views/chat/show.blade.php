@php
    $currentLayout = 'jobSeeker.layouts.app';
    $navPartial = 'jobSeeker.layouts.nav';

    if (Auth::check()) {
        if (Auth::user()->jobPoster) {
            $currentLayout = 'jobPoster.layouts.app';
        }
    }
@endphp


@extends($currentLayout)

@section('style')
    <style>
        body {
            font-family: 'Cairo', 'Inter', sans-serif;
            background-color: #f8f9fa; /* Bootstrap light gray */
        }

        /* تم الإبقاء على هذا لضمان أن يأخذ الصف الرئيسي ارتفاع الشاشة الكامل
           قد تحتاج إلى تعديل هذا بناءً على هيكل القالب الأب لديك */
        .main-chat-row {
            min-height: calc(100vh - 56px - 1rem - 1rem); /* اضبط 56px إذا كان ارتفاع الـ navbar مختلفًا, والـ 1rem للـ padding */
            /* أو استخدم vh-100 إذا كان المحتوى يملأ الصفحة مباشرة بدون navbar علوي ثابت */
        }

        .project-description-col {
            display: flex;
            flex-direction: column;
            max-height: calc(100vh - 56px - 2rem); /* نفس الاعتبار للـ navbar والـ padding */
            overflow-y: auto;
        }

        .chat-col {
            display: flex;
            flex-direction: column;
            /* max-height control is on chat-container now */
        }

        .chat-container {
            display: flex;
            flex-direction: column;
            height: 100%; /* يجعل حاوية الدردشة تملأ العمود */
            max-height: calc(100vh - 80px); /* اضبط 80px ليتناسب مع الهيدر والفوتر والـ navbar إذا لزم الأمر */
            /* Max height for the chat container, adjust as needed */
        }

        .messages-box {
            flex-grow: 1;
            overflow-y: auto;
            /* Padding is applied via Bootstrap class p-3 */
        }

        .messages-box::-webkit-scrollbar {
            width: 8px;
        }
        .messages-box::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .messages-box::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }
        .messages-box::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .message-bubble {
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            max-width: 75%;
            word-wrap: break-word;
            margin-bottom: 0.5rem;
        }
        .sent {
            background-color: #0d6efd; /* Bootstrap primary */
            color: white;
            margin-left: auto; /* Aligns to the right */
            border-bottom-right-radius: 0.25rem;
        }
        .received {
            background-color: #e9ecef; /* Bootstrap light gray */
            color: #212529; /* Bootstrap dark gray */
            margin-right: auto; /* Aligns to the left */
            border-bottom-left-radius: 0.25rem;
        }
        .message-sender {
            font-weight: bold;
            font-size: 0.875rem;
            display: block;
            margin-bottom: 0.25rem;
        }
        .message-text {
            font-size: 1rem;
        }
        .message-time {
            font-size: 0.75rem;
            display: block;
            margin-top: 0.25rem;
            color: #6c757d; /* Bootstrap secondary text color */
        }
        .sent .message-time {
            color: #f8f9fa; /* Light color for dark background */
            text-align: right;
        }
        .received .message-time {
            text-align: left;
        }

        /* Responsive adjustments for smaller screens */
        @media (max-width: 767.98px) { /* Bootstrap's md breakpoint is 768px */
            .main-chat-row {
                min-height: unset; /* Allow content to define height */
            }
            .project-description-col {
                max-height: 35vh; /* Limit height on small screens */
                margin-bottom: 1rem; /* Add space between description and chat */
            }
            .chat-container {
                 /* Adjust if description takes up space, or set fixed like 60vh */
                 height: auto; /* Let it grow based on content and available space */
                 max-height: 60vh; /* Example: ensure it does not take full screen leaving no space for description */
            }
        }
    </style>
@endsection

@section('title','محادثة')

@section('content')
<div class="container py-5 container-fluid mt-3 mb-3">
    <div class="row main-chat-row">
        <div class="col-md-4 project-description-col bg-white p-3 rounded shadow-sm border-end">
            <h4 class="h5 text-primary mb-3 border-bottom pb-2">وصف المشروع</h4>
            <div class="project-description-content small" style="background-color: #cccccc71;">
                @if($chat->project && $chat->project->description)
                    <p class="text-muted lh-base" style="white-space: pre-line; " >{{ $chat->project->description }}</p>
                @else
                    <p class="text-muted">لا يوجد وصف متاح لهذا المشروع.</p>
                @endif
            </div>
        </div>

        <div class="col-md-8 chat-col ps-md-2 pt-3 pt-md-0">
            <div class="chat-container bg-white rounded shadow-sm">
                <div class="p-3 chat-header border-bottom flex-shrink-0">
                    <h4 class="h5 mb-0 text-center fw-semibold text-secondary">
                        محادثة المشروع:
                        <span id="projectTitle">{{ $chat->project->title ?? 'محادثة بدون عنوان' }}</span>
                    </h4>
                </div>

                <div id="messagesBox" class="messages-box p-3">
                    @if($chat && $chat->messages)
                        @forelse ($chat->messages as $message)
                            @php
                                $userType = Auth::user()->jobPoster ? 'jobPoster':'jobSeeker' ;
                                $model = Auth::user()->jobPoster ? 'App\Models\JobPoster':'App\Models\JobSeeker' ;
                                $isSent = (Auth::user()->$userType->id == $message->sender_id && $model == $message->sender_type);
                            @endphp
                            <div class="d-flex flex-column {{ $isSent ? 'align-items-end' : 'align-items-start' }} mb-2">
                                <div class="message-bubble {{ $isSent ? 'sent' : 'received' }}">
                                    <strong class="message-sender">
                                        @if ($isSent)
                                            أنت:
                                        @else
                                            @php
                                                $senderName = 'مستخدم غير معروف';
                                                if ($message->sender_type === 'App\Models\JobPoster') {
                                                    $senderName = $message->sender->company->name ?? $message->sender->user->name;
                                                } elseif ($message->sender_type === 'App\Models\JobSeeker') {
                                                    $senderName = $message->sender->user->name;
                                                }
                                            @endphp
                                            {{ $senderName }}:
                                        @endif
                                    </strong>
                                    <p class="message-text mb-0">{{ $message->message }}</p>
                                    <small class="message-time">{{ $message->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-muted mt-3">لا توجد رسائل بعد. ابدأ المحادثة!</p>
                        @endforelse
                    @else
                        <p class="text-center text-muted mt-3">لا يمكن تحميل الرسائل.</p>
                    @endif
                </div>

                <div class="p-3 chat-footer border-top flex-shrink-0">
                    <form id="messageForm" action="{{ route('chat.send', $chat->id) }}" method="POST" class="d-flex align-items-center">
                        @csrf
                        <textarea id="messageInput" name="message" rows="2" class="form-control me-2 flex-grow-1" placeholder="اكتب رسالتك هنا..." required></textarea>
                        <button type="submit" class="btn btn-primary">إرسال</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const messagesBox = document.getElementById('messagesBox');
        if (messagesBox) {
            messagesBox.scrollTop = messagesBox.scrollHeight;
        }

        const messageInput = document.getElementById('messageInput');
        // if (messageInput) {
        //     messageInput.focus(); // Uncomment if you want autofocus
        // }
    });
    </script>

    <!-- JS Libraries -->
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.15.3/dist/echo.iife.js"></script> 

    <script>
        // إعداد Pusher
        Pusher.logToConsole = true;

        const echo = new Echo({
            broadcaster: 'pusher',
            key: '{{ env('PUSHER_APP_KEY') }}',
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
            forceTLS: true,
            authEndpoint: '/broadcasting/auth',
            auth: {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            }
        });

        // استماع للقناة الخاصة بالمحادثة الحالية
        const chatChannel = echo.private('chat.{{ $chat->id }}');
        
        chatChannel.listen('MessageSent', (e) => {
            console.log('📨 رسالة جديدة:', e);
            
            try {
                const messagesBox = document.getElementById('messagesBox');
                if (!messagesBox) {
                    console.error('لم يتم العثور على عنصر الرسائل');
                    return;
                }

                const isSent = false; // الرسالة الجديدة دائماً من الطرف الآخر
                
                const messageDiv = document.createElement('div');
                messageDiv.className = `d-flex flex-column ${isSent ? 'align-items-end' : 'align-items-start'} mb-2`;
                
                const bubbleDiv = document.createElement('div');
                bubbleDiv.className = `message-bubble ${isSent ? 'sent' : 'received'}`;
                
                const senderName = document.createElement('strong');
                senderName.className = 'message-sender';
                senderName.textContent = e.sender + ':';
                
                const messageText = document.createElement('p');
                messageText.className = 'message-text mb-0';
                messageText.textContent = e.message;
                
                const timeStamp = document.createElement('small');
                timeStamp.className = 'message-time';
                timeStamp.textContent = 'الآن';
                
                bubbleDiv.appendChild(senderName);
                bubbleDiv.appendChild(messageText);
                bubbleDiv.appendChild(timeStamp);
                messageDiv.appendChild(bubbleDiv);
                messagesBox.appendChild(messageDiv);
                
                // التمرير إلى أسفل
                messagesBox.scrollTop = messagesBox.scrollHeight;
            } catch (error) {
                console.error('خطأ في معالجة الرسالة الجديدة:', error);
            }
        });

        chatChannel.error((error) => {
            console.error('خطأ في الاتصال بالقناة:', error);
            if (error.status === 403) {
                console.error('خطأ في المصادقة. تأكد من تسجيل الدخول وأن لديك الصلاحيات المناسبة.');
            }
        });
    </script>

@endsection