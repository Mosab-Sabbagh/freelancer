@extends('guest.layouts.app')

@section('title')
    وظيفة - منصة العمل الحر     
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">

@endsection

@section('content')
    <!-- Hero Section -->
    <section class="hero-section" style="
            background: url('{{ asset('images/header-bg-0.jpg') }}') center/cover no-repeat;
            min-height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            color: white;
        ">
        <div class="overlay" style="
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.6);
            "></div>
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-12 mb-4 mb-lg-0">
                    <h1 class="display-3 fw-bold mb-4 text-center" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                        مرحباً بك في منصة وظيفة
                    </h1>
                    <p class="lead mb-4 text-center" style="font-size: 1.25rem; text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">
                        منصتك الأولى للعثور على أفضل المستقلين أو تقديم خدماتك في كافة المجالات. ابدأ رحلتك في العمل الحر
                        الآن وحقق طموحاتك المهنية بسهولة وأمان.
                    </p>
                    <div class="d-flex gap-3 justify-content-center">
                        <a href="{{route('register')}}" class="btn btn-primary btn-lg px-5 py-3">
                            <i class="fas fa-user-plus me-2"></i>انضم الآن مجاناً
                        </a>
                        <a href="#services" class="btn btn-outline-light btn-lg px-5 py-3">
                            <i class="fas fa-search me-2"></i>تصفح المشاريع
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Slider Section -->
    <section class="py-5 mt-4" id="services">
        <div class="container">
            <h2 class="fw-bold text-center mb-4 color-title" >اعثر على مستقلين محترفين في كافة المجالات</h2>
            <div id="fieldsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-12 col-md-4 mb-3 mb-md-0 text-center">
                                <i class="fas fa-paint-brush fa-3x text-primary mb-2"></i>
                                <h5 class="fw-bold">تصميم جرافيك</h5>
                                <p class="text-muted">شعارات، هويات بصرية، واجهات تطبيقات</p>
                            </div>
                            <div class="col-12 col-md-4 mb-3 mb-md-0 text-center">
                                <i class="fas fa-code fa-3x text-primary mb-2"></i>
                                <h5 class="fw-bold">برمجة وتطوير</h5>
                                <p class="text-muted">مواقع، تطبيقات، حلول برمجية</p>
                            </div>
                            <div class="col-12 col-md-4 text-center">
                                <i class="fas fa-pen-nib fa-3x text-primary mb-2"></i>
                                <h5 class="fw-bold">كتابة وتحرير</h5>
                                <p class="text-muted">محتوى، مقالات، تدقيق لغوي</p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-12 col-md-4 mb-3 mb-md-0 text-center">
                                <i class="fas fa-bullhorn fa-3x text-primary mb-2"></i>
                                <h5 class="fw-bold">تسويق رقمي</h5>
                                <p class="text-muted">إعلانات، إدارة حملات، سوشيال ميديا</p>
                            </div>
                            <div class="col-12 col-md-4 mb-3 mb-md-0 text-center">
                                <i class="fas fa-language fa-3x text-primary mb-2"></i>
                                <h5 class="fw-bold">ترجمة</h5>
                                <p class="text-muted">ترجمة احترافية، تدقيق لغوي، تعريب</p>
                            </div>
                            <div class="col-12 col-md-4 text-center">
                                <i class="fas fa-chart-line fa-3x text-primary mb-2"></i>
                                <h5 class="fw-bold">تحليل بيانات</h5>
                                <p class="text-muted">تقارير، إحصائيات، ذكاء أعمال</p>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#fieldsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: invert(27%) sepia(99%) saturate(7496%) hue-rotate(203deg) brightness(97%) contrast(101%);"></span>
                    <span class="visually-hidden">السابق</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#fieldsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true" style="filter: invert(27%) sepia(99%) saturate(7496%) hue-rotate(203deg) brightness(97%) contrast(101%);"></span>
                    <span class="visually-hidden">التالي</span>
                </button>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-5 bg-light" id="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-7 mb-4 mb-md-0">
                    <h3 class="fw-bold mb-3 color-title">عن منصة وظيفة</h3>
                    <p>منصة وظيفة تجمع بين أصحاب المشاريع والمستقلين في بيئة آمنة واحترافية. يمكنك بسهولة نشر مشروعك أو
                        تقديم خدماتك، التواصل مع العملاء أو المستقلين، إدارة المدفوعات، وضمان حقوق جميع الأطراف.</p>
                    <ul>
                        <li>سهولة البحث عن مستقلين أو مشاريع</li>
                        <li>نظام تقييمات وملفات شخصية موثوقة</li>
                        <li>دعم فني متواصل</li>
                        <li>ضمان الحقوق المالية للطرفين</li>
                    </ul>
                </div>
                <div class="col-md-5 text-center">
                    <img src="{{ asset('images/wazifaLogo-.png') }}" alt="وظيفة - منصة العمل الحر" class="img-fluid rounded "
                        style="max-width: 400px; height: auto;">
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials py-5" id="testimonials">
        <div class="container">
            <h2 class="text-center mb-5 color-title">ماذا قال عملاؤنا عنا</h2>
            <div class="row">
                <!-- Testimonial Card 1 -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body d-flex">
                            <img src="{{asset('images/person1.png')}}" alt="أحمد محمد" class="img-fluid rounded-circle me-3"
                                style="width: 80px; height: 80px;">
                            <div>
                                <h5 class="card-title">أحمد محمد</h5>
                                <h6 class="card-subtitle mb-2 text-muted">مدير تسويق</h6>
                            </div>
                        </div>
                        <p class="card-text px-3">"وظيفة منصة رائعة ساعدتني في العثور على مستقلين محترفين لإنجاز مشاريعي
                            بسرعة وكفاءة. أوصي بها بشدة!"</p>
                    </div>
                </div>
                <!-- Testimonial Card 2 -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body d-flex">
                            <img src="{{asset('images/person3.jpg')}}" alt="ليلى سمير" class="img-fluid rounded-circle me-3"
                                style="width: 80px; height: 80px;">
                            <div>
                                <h5 class="card-title">ليلى سمير</h5>
                                <h6 class="card-subtitle mb-2 text-muted">رئيسة قسم الموارد البشرية</h6>
                            </div>
                        </div>
                        <p class="card-text px-3">"بفضل وظيفة، تمكنت من توسيع فريقي بسرعة وسهولة. المنصة توفر مجموعة
                            كبيرة
                            من المواهب في مختلف المجالات."</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Testimonial Card 3 -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body d-flex">
                            <img src="{{asset('images/person2.png')}}" alt="خالد عبد الله" class="img-fluid rounded-circle me-3"
                                style="width: 80px; height: 80px;">
                            <div>
                                <h5 class="card-title">خالد عبد الله</h5>
                                <h6 class="card-subtitle mb-2 text-muted">مطور ويب</h6>
                            </div>
                        </div>
                        <p class="card-text px-3">"وظيفة غيرت طريقة عملي تمامًا. الآن يمكنني العثور على مشاريع مثيرة
                            والعمل بمرونة من أي مكان في العالم."</p>
                    </div>
                </div>
                <!-- Testimonial Card 4 -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body d-flex">
                            <img src="{{asset('images/person4.jpg')}}" alt="نورة علي" class="img-fluid rounded-circle me-3"
                                style="width: 80px; height: 80px;">
                            <div>
                                <h5 class="card-title">نورة علي</h5>
                                <h6 class="card-subtitle mb-2 text-muted">مصممة جرافيك</h6>
                            </div>
                        </div>
                        <p class="card-text px-3">"أنا ممتن لوظيفة لمساعدتي في بناء علامتي التجارية. لقد وجدت عملاء
                            رائعين
                            من خلال المنصة وأنا متحمس لمواصلة العمل معهم."</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq py-5" id="FAQ" style="margin-top: 30px; margin-bottom: 30px;">
        <div class="container">
            <h2 class="text-center mb-5 color-title">الأسئلة الشائعة</h2>
            <div class="accordion" id="faqAccordion">
                <!-- FAQ Item 1 -->
                <div class="accordion-item" style="margin-bottom: 15px;">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            ما هي وظيفة وكيف يمكن أن تساعدني؟
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body" style="padding: 15px;">
                            وظيفة هي منصة تجمع بين أصحاب المشاريع والمستقلين المحترفين. تساعدك في العثور على المواهب
                            المناسبة لإنجاز مشاريعك بكفاءة وفعالية من حيث التكلفة.
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="accordion-item" style="margin-bottom: 15px;">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            كيف يمكنني إضافة مشروع على وظيفة؟
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body" style="padding: 15px;">
                            لإضافة مشروع، قم بتسجيل الدخول إلى حسابك، ثم انقر على "أضف مشروع". املأ التفاصيل المطلوبة
                            بشكل كامل وواضح، وحدد المهارات المطلوبة والميزانية المناسبة.
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="accordion-item" style="margin-bottom: 15px;">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            ما هي طرق الدفع المتاحة على وظيفة؟
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body" style="padding: 15px;">
                            نحن ندعم مجموعة متنوعة من طرق الدفع الآمنة، بما في ذلك بطاقات الائتمان، التحويلات البنكية،
                            وخدمات الدفع الإلكتروني. يمكنك اختيار الطريقة التي تناسبك عند إتمام عملية الدفع.
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="accordion-item" style="margin-bottom: 15px;">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            كيف يمكنني التواصل مع المستقلين؟
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body" style="padding: 15px;">
                            يمكنك التواصل مع المستقلين عبر نظام الرسائل الخاص بالمنصة. هذا يتيح لك مناقشة تفاصيل
                            المشروع، وتبادل الملفات، والاتفاق على شروط العمل بسهولة وأمان.
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 5 -->
                <div class="accordion-item" style="margin-bottom: 15px;">
                    <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            ما هي سياسة استعادة الأموال في حالة عدم رضا العميل؟
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body" style="padding: 15px;">
                            نحن نسعى لضمان رضا عملائنا. في حالة عدم رضاك عن جودة العمل المقدم، يمكنك تقديم طلب استعادة
                            الأموال وفقًا لشروط الخدمة الخاصة بنا. سيقوم فريق الدعم لدينا بمراجعة الطلب والعمل على
                            إيجاد حل يرضي الطرفين.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection