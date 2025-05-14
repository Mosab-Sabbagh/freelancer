@extends('jobSeeker.layouts.app')
@section('title')
    {{Auth::user()->name}} لوحة تحكم
@endsection

@section('content')
    <div class="container main-container">
        <div class="row">

            <!-- الجزء الجانبي -->
            <div class="col-lg-4 ">
                <div class="card">
                    <img src="/images/IMG-20230619-WA0046.jpg" class="card-img-top rounded-circle" alt="صورة المستخدم"
                        style="width: 150px; height: 150px; object-fit: cover; margin: 0 auto;">

                    <div class="card-body text-center">
                        <h5 class="card-title">{{Auth::user()->name}}</h5>
                        <a href="{{route('jobSeeker.profile.edit')}}" class="btn btn-primary btn-sm">تعديل الملف الشخصي</a>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">تسجيل خروج</button>
                    </form>
                </div>
                <div class="steps-container">
                    <h3 class="section-title">
                        <i class="fas fa-tasks"></i> إعداد اكمال التصاريح
                    </h3>
                    <p class="text-muted mb-4">اتبع هذه الخطوات لإكمال عملية التصريح</p>

                    <div class="step">
                        <div class="step-number">1</div>
                        <div class="step-text">تأكيد رقم الجوال</div>
                    </div>


                    <div class="step">
                        <div class="step-number">2</div>
                        <div class="step-text">التحقق والترتيبات</div>
                    </div>

                    <div class="step">
                        <div class="step-number">3</div>
                        <div class="step-text">رفع المستندات</div>
                    </div>

                    <button class="btn btn-primary w-100 mt-3">
                        <i class="fas fa-play"></i> بدء العملية
                    </button>
                </div>
            </div>

            <!-- البطاقات المالية -->
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-money-bill-wave"></i> الرصد القابل للسحب
                            </div>
                            <div class="card-body">
                                <div class="amount">$0.00</div>
                                <small class="text-muted">المبلغ المتاح للسحب الفوري</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-chart-pie"></i> الرصد الكلي
                            </div>
                            <div class="card-body">
                                <div class="amount">$0.00</div>
                                <small class="text-muted">إجمالي الرصيد بما فيه المحجوز</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-4"></div>
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-building"></i> آخر المشاريع
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <h5>تعديل على برنامج قائم أودو 17</h5>
                                    <small class="text-muted">صاحب المشروع: [اسم صاحب المشروع]</small>
                                </div>
                                <div class="col-12 mb-3">
                                    <h5>مشروع آخر هنا</h5>
                                    <small class="text-muted">صاحب المشروع: [اسم صاحب المشروع]</small>
                                </div>
                                <!-- يمكنك إضافة المزيد من المشاريع هنا -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection