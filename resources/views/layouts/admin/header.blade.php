<header class="p-3 border-bottom rounded-bottom bg-light">
    <div class="container">
        {{-- <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                    <use xlink:href="#bootstrap"></use>
                </svg>
            </a> --}}

        <ul class="nav nav-tabs p-0 d-flex justify-content-center w-100">
            <li class="nav-item">
                <span class="nav-link pe-none {{ isActive('admin.') }}">صفحه اصلی</span>
            </li>

            @superuser
                <li class="nav-item">
                    <span class="nav-link pe-none {{ isActive(['admin.presidency.admins.all', 'admin.presidency.admins.permissions', 'admin.presidency.permissions.all', 'admin.presidency.permissions.create', 'admin.presidency.permissions.edit']) }}">ریاست سایت</span>
                </li>
            @endsuperuser

            @canany(['view-users', 'create-users', 'edit-users', 'delete-users'])
                <li class="nav-item">
                    <span class="nav-link pe-none {{ isActive(['admin.users.all', 'admin.users.create', 'admin.users.edit']) }}">کاربران</span>
                </li>
            @endcanany

            @canany(['view-products', 'create-products', 'edit-products', 'delete-products'])
                <li class="nav-item">
                    <span class="nav-link pe-none {{ isActive(['admin.products.all', 'admin.products.create', 'admin.products.edit', 'admin.products.single']) }}">محصولات</span>
                </li>
            @endcanany

            <li class="nav-item">
                <span class="nav-link pe-none">سیستم اطلاع رسانی</span>
            </li>

            <li class="nav-item">
                <span class="nav-link pe-none {{ isActive(['admin.comments.all', 'admin.comments.admins-replys']) }}">نظرات سایت</span>
            </li>
        </ul>

    </div>
</header>
