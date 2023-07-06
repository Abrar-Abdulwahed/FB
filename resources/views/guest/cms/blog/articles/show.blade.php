@extends('layouts.blog')

@section('title', 'عرض مقالة')
@section('content')
    @if (session()->has('success'))
        <p class="alert alert-success" role="alert">{{ session('success') }}</p>
    @endif
    @if (session()->has('error'))
        <p class="alert alert-danger" role="alert">{{ session('error') }}</p>
    @endif
    <div class="bg-body-secondary">
        <section id="sec-9" class="mb-5">
            <div class="container">
                <div class="row">
                    <div class="d-flex justify-content-center bg-white">
                        <figure class="col-xs-12">
                            <div class="caption mx-3 my-3">
                                <span> {{ $article->created_at->format('d M Y') }} </span>
                            </div>
                            <h3 class="text-center">{{ $article->title }}</h3>
                            <img src="{{ asset('storage/articles/' . $article->image) }}" alt="">

                            <h4>
                                <p> <span class="bold"> {{ $article->description }}</span>
                            </h4>
                            <p class="cont-1">{!! $article->content !!}</p>
                        </figure>
                    </div>
                    <div class="col-sm-12 my-4 bg-white">
                        <div class="row py-4">
                            <div class="col-sm-10">
                                <h4>{{ $article->user->name }}</h4>
                                <p class="text-end"> </p>
                            </div>
                            <div class="col-sm-2">
                                <img src="{{ asset('storage/avatars/' . $article->user->avatar) }}"
                                    class="w-75 rounded circle"><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @auth
            <section id="sec-8" class="my-4">
                <div class="container">
                    <h5 class="text-end">إترك تعليق</h5>

                    <form class="bg-white py-3 px" action="{{ Route('guest.articles.comments') }}" method="post">
                        @csrf

                        <div class="comment row m-4">

                            <div class="comm-area col-lg-12 col-md-12">
                                <label class="area-content" for="area">التعليق </label><br>
                                <input type="hidden" name="article_id" value="{{ $article->id }}">
                                <textarea class="box my-4" name="comment" id="area" cols="105" rows="6"></textarea>
                                @error('comment')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <button class="btn btn-primary" type="submit">إرسال التعليق</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>

        @endauth


        <section id="sec-10" class="my-4 p-4 bg-white">
            <div class="row"><h3>التعليقات</h3></div>
            @foreach ($article->comments as $comment)
                <div class="row">
                
                <div class="col-md-8">
                    <div class="card-body">
                    <p class="card-text">{!! $comment->comment !!}</p>
                    <p class="card-text"><small class="text-muted">{{ $comment->created_at->format('d M Y') }}</small></p>
                    </div>
                </div>
                <div class="col-md-1">
                    <img src="{{ asset('storage/avatars/' . $comment->user->avatar) }}" style="width:50px; height:50px"
                                class="rounded circle">
                    <p class="card-text">{{ $comment->user->name }}</p>
                </div>
                </div>
            @endforeach
        </section>
    </div>


    {{-- <!-- Start Section-2 -->
    <section id="sec-2">
        <div class="container">
            <div class="row">
                <div class="d-flex justify-content-center bg-white">
                    <figure class="col-xs-12">
                        <div class="caption mx-3 my-3">
                            <span> منذ 7 أشهر</span>
                            <a href="#"> قصص نجاح</a>
                        </div>
                        <h3 class=" text-center">Lorem ipsum dolor sit</h3>
                        <img src="Images/team-01.png" alt="">
                        <figcaption>
                            <p> <span class="bold">منصة فان</span>
                                منصة رقمية تقدم مجموعة متنوعة من الخدمات التسويقية بهدف دعم التجار ومقدمي الخدمات السعوديين
                                في التحول الرقمي وإنشاء متاجرهم الإلكترونية. تتنوع الخدمات ابتداءً من إنشاء المتاجر
                                الإلكترونية على منصات سلة وزد، مرورًا بخدمات السيو وتحليل المواقع وليس انتهاءً بخدمات إدارة
                                حسابات شبكات التواصل الاجتماعي، ويقع اعتماد المنصة في تقديم هذه الخدمات على توظيف العديد من
                                المستقلين المحترفين من مستقل.
                        </figcaption>
                        <p class="cont-1">أنشأ فهد السويلم منصة فان بعد أن توسعت خبرته في العمل في مجال التسويق وإدارة
                            المحتوى الرقمي لسنوات طويلة، إذ درس فهد الإعلام الرقمي وحصل على دبلوم تقنية المعلومات والدعم
                            الفني، ويعمل حاليًا مديرًا لإحدى المشروعات الحكومية ومديرًا لمحتوى التواصل الرقمي فيها. وبجانب
                            عمله الحكومي، بدأ فهد العمل في مجال التجارة الإلكترونية في عام 2016، ليقرر بعد ذلك إنشاء منصة
                            تمكّنه من تقديم المساعدة لعملائه من أصحاب المتاجر الإلكترونية.</p>

                        <p class="cont-1">ويجد فهد في الخصائص التي يتميز بها سوق التجارة الإلكتروني السعودي فرصة كبيرة لكي
                            يقدم عصارة خبرته في التسويق والمحتوى لمساعدة التجار في التحول الرقمي اهتداءً برؤية 2030 للمملكة
                            العربية السعودية. هذه الخبرة التي تتمثل في إنشاء مواقع ومتاجر إلكترونية، وعمل التحليلات التقنية
                            لها، وإدارة الميزانيات التسويقية لأصحاب الأعمال. يسطر فهد القيمة والجمهور الذي يستهدفه بقوله:
                            «أبحث عن أصحاب الأعمال الذين كانوا يعتمدون على التسويق التقليدي لمساعدتهم في بناء الهوية الرقمية
                            والتسويق لهذه المشروعات عبر الإنترنت».</p>

                        <p class="cont-1"> وعن شعار المنصة؛ نجاحك يبدأ من المحتوى، يحدثنا فهد عن قيمة المحتوى في التسويق إذ
                            يقول: «أكبر صعوبة في عملي تكمن في اختيار الكلمات التي تبين المنتج وتظهر قيمته الفعلية، خصوصًا
                            وأن الويب العربي يفتقر إلى مزيد من المحتوى العربي الجيد، وأنا أعتمد في شغلي على السيو لإظهار
                            قيمة المنتج وتحسين ظهوره عند البحث في مشاريع قد تتشابه وتتكرر».</p>

                        <h4>كيف تعرف فهد إلى مستقل؟</h4>
                        <p class="cont-1">لأن الإنسان سيصل في مرحلة ما من حياته ومن إدارة مشروعه التجاري يدرك فيها أن
                            التفويض خير من القيام بكل الأعمال صغيرها وكبيرها، يحكي فهد عن قصة تعرفه بمستقل فيقول: «جاءني أحد
                            الشباب وقالي أنت جالس تشتغل أشياء بسيطة جدًا وأنت عقلك أكبر من هذه الأشياء وتدير حسابات كبيرة،
                            فليش ما تجرب المنصات اللي توظفلك أحد بالساعة، فكان أول مشروع على مستقل تصميم كتاب تفاعلي لأحد
                            البرامج عندنا، وأُعجبت تمامًا بالعمل الذي قام به المستقل، وكذلك أُعجبت بالمنصة وسهولتها».</p>

                        <p class="cont-1">وبعد أن عمل فهد على مستقل، لم يتوقف عن استخدامه لإدارة أعماله على منصة فان: «بعد
                            أن تعرفت على مستقل ومن وقتها وأصبحت قادرًا على تسيير أعمالي بسهولة، وصارت الناس تطلب مني أعمال
                            بشكلٍ خاص. وقد جربت منصات أخرى، لكن ما وصلت لجودة مستقل صراحةً، في مستقل لقيت ناس تفهم شو
                            المطلوب بالضبط، فهم يفهمون السوق العربي ومعتادين على مشاريع مماثلة».</p>
                        <p class="cont-1"> ومن بدايات المشاريع التي عمل عليها استعانة بالمستقلين؛ تأسيس موقع
                            <span><a href="#">صندوق سمكتي</a></span>
                            المتخصص في بيع الأسماك، يخبرنا فهد عن هذه التجربة: «وظفت أحد المستقلين وكان محترفا جدًا، أسس لي
                            الموقع وعمل على ربط الخدمات من سلة وزد وأعطيته توجيهات بشأن تهيئة الموقع للسيو، وبعد أن اشتهر
                            الموقع، اشتراه مني أحد المشاهير، ومجال الأسماك هذا فتح لي الباب واسعًا للعمل في مجالات عدّة
                            منها: البروتينات ونكهة الحجاز والمواقع عقارية، وبدأت أشتغل لهذه المواقع عن طريق منصة فان
                        </p>
                        <p class="cont-2">وتعتمد طريقة استخدام فهد لموقع مستقل على تفويض المستقلين للعمل على الأعمال
                            المتكررة مثل كتابة النبذة التعريفية للمواقع، أو عمل التصاميم لها إلى جانب خدمات الكتابة. ولا
                            يتوقف استخدامه لمستقل على إضافة المشروعات بل يتجه مباشرةً إلى خانة
                            <span><a href="#">البحث عن المستقلين</a></span>
                            إذ يقول: «أنا وصلت لمرحلة في مستقل، إني صرت أبحث عن المستقلين وأشوف تخصصاتهم وأقيّم تقييماتهم،
                            فمثلًا أبحث عن مصمم مميز وأنظر في ملفات الأعمال الخاصة بهم وإن وجدت من يعجبني أبني الخدمة عليه
                        </p>
                        <p class="cont-1">إن كنت صاحب مشروع على مستقل، وترغب في أن تشاركنا قصة نجاحك، فنرحب بتواصلك معنا عبر
                            البريد

                            تم النشر في:
                            <span><a href="#">قصص نجاح أصحاب المشاريع</a></span>
                        </p>
                    </figure>
                </div>
                <div class="col-sm-12 my-4 bg-white">
                    <div class="row py-4">
                        <div class="col-sm-10">
                            <h4>Lorem ipsum</h4>
                            <p class="text-end">مختص التسويق الرقمي، أساعد الشركات على تحقيق أهدافهم البيعية من خلال خبرة
                                تمتد لأكثر من 5 سنوات في التسويق بالمحتوى</p>
                        </div>
                        <div class="col-sm-2">
                            <img class="w-75" src="Images/team-02.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section-2 -->

    <!-- Start Section-3-->
    <section id="sec-3">
        <div class="container my-4">
            <h2 class="text-end fw-bold fs-2">مقالات ذات صلة</h2>
            <div class="info">

                <div class="home">
                    <a href="#"><img src="Images/team-01.png" alt=""></a>
                    <figcaption>
                        <div class="caption">
                            <span>منذ 3 أيام</span>
                            <a href="#">ترجمة</a>
                        </div>
                        <p> <span class="bold">دليلك الشامل إلى التسويق عبر مواقع التواصل الاجتماعي</span>
                            يحمل التسويق عبر مواقع التواصل الاجتماعي المفتاح لإطلاق العنان لنجاحك الاستثنائي في عالم
                            الأعمال، إذ يساعدك على إلهام جمهورك المستهدف..
                        </p>
                    </figcaption>
                </div>
                <div class="home">
                    <a href="#"><img src="Images/team-02.png" alt=""></a>
                    <figcaption>
                        <div class="caption">
                            <span>منذ 3 أيام</span>
                            <a href="#">ترجمة</a>
                        </div>
                        <p> <span class="bold">دليلك الشامل إلى التسويق عبر مواقع التواصل الاجتماعي</span>
                            يحمل التسويق عبر مواقع التواصل الاجتماعي المفتاح لإطلاق العنان لنجاحك الاستثنائي في عالم
                            الأعمال، إذ يساعدك على إلهام جمهورك المستهدف..
                        </p>
                    </figcaption>
                </div>
                <div class="home">
                    <a href="#"><img src="Images/team-03.png" alt=""></a>
                    <figcaption>
                        <div class="caption">
                            <span>منذ 3 أيام</span>
                            <a href="#">ترجمة</a>
                        </div>
                        <p> <span class="bold">دليلك الشامل إلى التسويق عبر مواقع التواصل الاجتماعي</span>
                            يحمل التسويق عبر مواقع التواصل الاجتماعي المفتاح لإطلاق العنان لنجاحك الاستثنائي في عالم
                            الأعمال، إذ يساعدك على إلهام جمهورك المستهدف..
                        </p>
                    </figcaption>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section-3 -->

    <!-- Start Section-4 -->
    <section id="sec-4" class="my-4">
        <div class="container">
            <h5 class="text-end">إترك تعليق</h5>
            <form class="bg-white py-3 px-4" action="" method="">
                <div class="comment row">
                    <div class=" f-1 row d-lg-flex">
                        <div class="col-lg-3 col-md-12">
                            <label class="in-1" for="in-1">الاسم </label> <br>
                            <input class="inp-1" type="text" name="" id="in-1">
                        </div>
                        <div class="col-lg-3 col-md-12">
                            <label class="in-1 my-2" for="in-2">البريد الالكترونى </label> <br>
                            <input class="inp-1" type="email" name="" id="in-2">
                        </div>
                        <div class="col-lg-3 col-md-12">
                            <label class="in-1 my-2" for="in-3">الموقع الالكترونى </label> <br>
                            <input class="inp-1" type="text" name="" id="in-3">
                        </div>
                    </div>
                    <div class="comm-area col-lg-12 col-md-12">
                        <label class="area-content" for="area">التعليق <br>
                            <textarea class="box" name="" id="area" cols="105" rows="6"></textarea>
                        </label>
                    </div>

                    <!-- <div class="comm-area col-md-12">
                        <label class="area-content" for="area">التعليق <br> <textarea class="box" name="" id="area" cols="105" rows="6"></textarea></label>
                    </div> -->

                    <div>
                        <button class="btn btn-primary" type="button">إرسال التعليق</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- End Section-4 --> --}}

@endsection
