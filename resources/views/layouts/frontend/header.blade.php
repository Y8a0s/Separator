<header class="bg-white">
    <nav class="p-2 border-bottom shadow-sm sticky-top">
        <div class="container p-0">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="{{ route('home') }}" class="d-flex align-items-center text-dark text-decoration-none">
                    <img width="90" height="90" src="{{ Storage::url('images/logos/site_logo.png') }}" title="سپاراتور صنعت علی محمدی" alt="SSA">
                </a>

                <ul class="nav d-flex justify-content-center col-12 col-md-auto ms-lg-auto mb-2 mb-lg-0 px-2 px-lg-4">

                    <li>
                        <a href="{{ route('home') }}" class="nav-link px-2 @if (inRoute('home')) text-bg-primary rounded shadow-sm @endif">صفحه اصلی</a>
                    </li>
                    <li>
                        <a href="{{ route('machineries') }}" class="nav-link px-2 @if (inRoute(['machineries' , 'machinery.details'])) text-bg-primary rounded shadow-sm @endif">ماشین آلات</a>
                    </li>
                    <li>
                        <a href="@if(inRoute('home')) #about-us @else {{ route('home') }}/#about-us @endif" class="nav-link px-2">درباره ما</a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}#contact-us" class="nav-link px-2">ارتباط با ما</a>
                    </li>

                </ul>

                {{-- <form class="col-8 col-lg-auto mb-2 mb-lg-0 ms-lg-3" role="search">
                    <input type="search" class="form-control" placeholder="جست و جو..." aria-label="Search" disabled>
                </form> --}}

                <div class="me-3 d-flex">
                    @guest
                        <a href="#" class="d-block link-dark text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false" title="عضویت | ورود">
                            <i class="bi bi-person-circle fs-2 text-primary"></i>
                        </a>
                        <ul class="dropdown-menu text-small text-center bg-light">
                            <li><a class="dropdown-item" href="{{ route('auth.login') }}">ورود</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('auth.register') }}">عضویت</a></li>
                        </ul>
                    @else
                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu text-small text-center bg-light">
                            @admin
                                <li><a class="dropdown-item" href="{{ route('admin.') }}">پنل ادمین</a></li>
                            @endadmin
                            <li><a class="dropdown-item" href="{{ route('profile') }}">پروفایل</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                @livewire('auth.logout')
                            </li>
                        </ul>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    @if (Route::is('home'))
        <div id="carouselExampleDark" class="carousel carousel-fade slide shadow" data-bs-ride="carousel" dir="ltr">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img data-aos="zoom-in" src="{{ Storage::url('images/header/header-2.jpg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="fs-2">سپاراتور صنعت علی محمدی</h1>
                        <p>تولید و تامین انواع قطعات و لوازم یدکی با بهترین کیفیت</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img data-aos="zoom-in" src="{{ Storage::url('images/header/header-1.jpg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h2>خرید و فروش</h2>
                        <p>انواع دستگاه های جداکننده و ماشین آلات مربوطه صنف لبنی</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img data-aos="zoom-in" src="{{ Storage::url('images/header/header-3.jpg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h2>تعمیر ، سرویس و راه اندازی</h2>
                        <p>انواع دستگاه های خامه گیر و کلاریفایر در ظرفیت های مختلف</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    @endif
</header>
