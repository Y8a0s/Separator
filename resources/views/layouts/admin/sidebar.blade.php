@section('script')
    <script>
        //for logout
        document.addEventListener('refresh_page', () => {
            window.location.reload();
        })
    </script>
@endsection

<aside class="shadow-lg" style="z-index:1">
    <div class="container-fluid h-100">
        <div class="row flex-nowrap h-100">
            <div class="px-sm-2 px-0 bg-dark rounded-start h-100">
                <div class="px-3 pt-3 text-white" style="position: -webkit-sticky; position:sticky; top: 0">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <div class="dropdown">
                            <a href="#" class="d-flex flex-wrap-reverse justify-content-center flex-wrap align-items-center text-white text-decoration-none" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false" dir="ltr">
                                <span class="d-none d-sm-inline ms-1" style="min-width: max-content">
                                    @superuser
                                        <i class="text-primary bi bi-patch-check-fill"></i>
                                    @endsuperuser
                                    {{ auth()->user()->name }}
                                </span>
                                <img src="{{ is_null(auth()->user()->image) ? Storage::url('images/users/default-users-image.png') : Storage::url(auth()->user()->image) }}" alt="hugenerd" width="35" height="35" class="rounded-circle ms-2 border border-2 border-success">
                            </a>
                            <ul class="dropdown-menu text-small shadow text-center ">
                                <li><a class="dropdown-item" href="{{ route('home') }}">حالت کاربر</a></li>
                                {{-- <li><a class="dropdown-item" href="#">تنظیمات</a></li> --}}
                                <li><a class="dropdown-item" href="{{ route('profile') }}">پروفایل</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                @livewire('auth.logout')
                            </ul>
                        </div>
                        <div class="vr ms-1"></div>
                        <span class="d-none d-sm-inline">مدیریت</span>
                    </div>

                    <hr class="d-block w-100">

                    <ul class="nav nav-pills nav-sidebar mb-sm-auto mb-0 align-items-center align-items-sm-start w-100 p-0" id="menu">

                        <li class="nav-item mb-1">
                            <a href="{{ route('admin.') }}" class="nav-link align-middle {{ isActive('admin.') }}">
                                <i class="fs-4 bi-house ms-1"></i>
                                <span class="d-none d-sm-inline">صفحه اصلی</span>
                            </a>
                        </li>

                        @superuser
                            <li class="nav-item mb-1">
                                <a href="#submenu3" data-bs-toggle="collapse" class="nav-link align-middle {{ isActive(['admin.presidency.admins.all', 'admin.presidency.admins.permissions', 'admin.presidency.permissions.all', 'admin.presidency.permissions.create', 'admin.presidency.permissions.edit']) }}">
                                    <i class="fs-4 bi bi-award"></i>
                                    <span class="d-none d-sm-inline ms-1">ریاست سایت</span>
                                </a>
                                <ul class="collapse nav flex-column p-0 my-1 py-1 pe-1 border-end {{ isActive(['admin.presidency.admins.all', 'admin.presidency.admins.permissions', 'admin.presidency.permissions.all', 'admin.presidency.permissions.create', 'admin.presidency.permissions.edit'], 'show') }}" id="submenu3" data-bs-parent="#menu">
                                    <li class="nav-item mb-1">
                                        <a href="{{ route('admin.presidency.admins.all') }}" class="nav-link {{ isActive('admin.presidency.admins.all', 'bg-white text-black') }}">
                                            <i class="bi bi-headset"></i>
                                            <span class="d-none d-sm-inline">مدیران سایت</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.presidency.permissions.all') }}" class="nav-link {{ isActive('admin.presidency.permissions.all', 'bg-white text-black') }}">
                                            <i class="bi bi-key" style="position:relative; top:3px;"></i>
                                            <span class="d-none d-sm-inline">دسترسی ها</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endsuperuser

                        @canany(['view-users', 'create-users', 'edit-users', 'delete-users'])
                            <li class="nav-item mb-1">
                                <a href="#submenu1" data-bs-toggle="collapse" class="nav-link align-middle {{ isActive(['admin.users.all', 'admin.users.create', 'admin.users.edit']) }}">
                                    <i class="fs-4 bi-people ms-1"></i>
                                    <span class="d-none d-sm-inline">کاربران</span>
                                </a>
                                <ul class="collapse nav flex-column p-0 my-1 py-1 pe-1 border-end {{ isActive(['admin.users.all', 'admin.users.create', 'admin.users.edit'], 'show') }}" id="submenu1" data-bs-parent="#menu">
                                    <li class="nav-item mb-1">
                                        <a href="{{ route('admin.users.all') }}" class="nav-link {{ isActive('admin.users.all', 'bg-white text-black') }}">
                                            <i class="bi bi-person-lines-fill"></i>
                                            <span class="d-none d-sm-inline">لیست کاربران</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link text-nowrap">
                                            <i class="bi bi-person-fill-slash"></i>
                                            <span class="d-none d-sm-inline">مسدود شده ها</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcanany

                        @canany(['view-products', 'create-products', 'edit-products', 'delete-products'])
                            <li class="nav-item mb-1">
                                <a href="#submenu2" data-bs-toggle="collapse" class="nav-link align-middle {{ isActive(['admin.products.all', 'admin.products.create', 'admin.products.edit', 'admin.products.single']) }}">
                                    <i class="fs-4 bi bi-cart3 ms-1"></i>
                                    <span class="d-none d-sm-inline">محصولات</span>
                                </a>
                                <ul class="collapse nav flex-column p-0 my-1 py-1 pe-1 border-end {{ isActive(['admin.products.all', 'admin.products.create', 'admin.products.edit', 'admin.products.single'], 'show') }}" id="submenu2" data-bs-parent="#menu">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.products.all') }}" class="nav-link {{ isActive('admin.products.all', 'bg-white text-black') }}">
                                            <i class="bi bi bi-gear-wide-connected"></i>
                                            <span class="d-none d-sm-inline">ماشین آلات</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcanany

                        <li class="nav-item mb-1">
                            <a href="#submenu4" data-bs-toggle="collapse" class="nav-link align-middle">
                                <i class="fs-5 bi bi-messenger ms-1"></i>
                                <span class="d-none d-sm-inline">سیستم اطلاع رسانی</span>
                            </a>
                            <ul class="collapse nav flex-column p-0 my-1 py-1 pe-1 border-end" id="submenu4" data-bs-parent="#menu">
                                <li class="nav-item  mb-1">
                                    <a href="#" class="nav-link">
                                        <i class="bi bi-send-fill"></i>
                                        <span class="d-none d-sm-inline">ارسال پیام به کاربران</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <span class="d-none d-sm-inline">تنظیمات کد پیامکی</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item mb-1">
                            <a href="#submenu5" data-bs-toggle="collapse" class="nav-link align-middle {{ isActive(['admin.comments.all', 'admin.comments.admins-replys']) }}">
                                <i class="fs-5 bi bi-chat-square-dots ms-1"></i>
                                <span class="d-none d-sm-inline">نظرات سایت</span>
                            </a>
                            <ul class="collapse nav flex-column p-0 my-1 py-1 pe-1 border-end {{ isActive(['admin.comments.all', 'admin.comments.admins-replys'] , 'show') }}" id="submenu5" data-bs-parent="#menu">
                                <li class="nav-item mb-1">
                                    <a href="{{ route('admin.comments.all') }}" class="nav-link {{ isActive('admin.comments.all', 'bg-white text-black') }}">
                                        <i class="bi bi-wechat"></i>
                                        <span class="d-none d-sm-inline">نظرات کاربران</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.comments.admins-replys') }}" class="nav-link {{ isActive('admin.comments.admins-replys', 'bg-white text-black') }}">
                                        <i class="bi bi-reply-all"></i>
                                        <span class="d-none d-sm-inline">پاسخ مدیران</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</aside>
