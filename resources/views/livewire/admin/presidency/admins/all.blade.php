@section('title', 'مدیران سایت')

@section('script')
    <script>
        document.addEventListener('livewire:load', function() {
            $(document).on("click", ".delete-admin", function() {
                var adminId = $(this).val();
                $("#modal-ok-buttom").attr("wire:click", `deleteAdmin(${adminId})`);
                $("#modal .modal-title").html(`حذف حساب مدیر ${adminId}`);
                $("#modal .modal-body").html('<p>آیا از <span class="text-danger">حذف</span> این مدیر اطمینان دارید؟</p>');
            });

            $(document).on("click", ".dismiss-admin", function() {
                var adminId = $(this).val();
                $("#modal-ok-buttom").attr("wire:click", `dismissAdmin(${adminId})`);
                $("#modal .modal-title").html(`عزل مدیر ${adminId}`);
                $("#modal .modal-body").html('<p>آیا از <span class="text-danger">عزل<i class="bi bi-caret-down-fill"></i></span> این مدیر اطمینان دارید؟</p>');
            });
        })
    </script>
@endsection

<div class="card h-100 shadow-sm" style="color: ">

    @include('layouts.admin.modal')
    <!-- /.modal -->

    <div class="card-header">
        <h3 class="card-title">کاربران مدیر
            <svg style="color: blue" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="30" width="30">
                <path d="M12,1L3,5v6c0,5.55,3.84,10.74,9,12c5.16-1.26,9-6.45,9-12V5L12,1z M14.5,12.59l0.9,3.88L12,14.42l-3.4,2.05l0.9-3.87 l-3-2.59l3.96-0.34L12,6.02l1.54,3.64L17.5,10L14.5,12.59z" fill="blue"></path>
            </svg>
        </h3>

        <div class="card-tools d-flex mb-3">
            <form wire:submit.prevent="searchAdmins" class="d-flex ms-2">
                <div class="input-group ms-2" dir="ltr">
                    <button class="btn btn-primary border border-secondary" id="search-button" type="submit"><i class="bi bi-search btn-sm"></i></button>
                    <input type="text" wire:model.defer="search" class="form-control" placeholder="جست و جو..." dir="rtl">
                </div>
                <select wire:model="filterBy" wire:click="searchAdmins()" class="form-select form-select-sm h-100 text-start" style="width: 95px" dir="ltr">
                    <option class="text-center" value="all" selected>همه</option>
                    <option class="text-center" value="actives">فعال</option>
                    <option class="text-center" value="inactives">غیرفعال</option>
                </select>
            </form>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0 align-middle">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="text-center align-middle">آیدی</th>
                    <th class="text-center align-middle">نام کاربر</th>
                    <th class="text-center align-middle d-sm-table-cell d-none h-100">نام خانوادگی</th>
                    <th class="text-center align-middle">شماره موبایل</th>
                    <th class="text-center align-middle d-sm-table-cell d-none h-100">وضعیت</th>
                    <th class="text-center align-middle">اقدامات</th>
                </tr>
            </thead>

            <tbody wire:init="loadAdminsData">
                @if (!empty($admins->items()))
                    @if ($readyToLoad)
                        @foreach ($admins as $admin)
                            <tr style="height: 4rem">
                                <td class="text-center align-middle px-0"><span class="badge fw-normal @if ($admin->verified) user-id-success @else user-id-danger @endif">{{ $admin->id }}</span></td>
                                <td class="text-center align-middle px-0 ps-1">{{ $admin->name }}</td>
                                <td class="text-center align-middle px-0 ps-1 d-sm-table-cell d-none h-100">{{ Illuminate\Support\Str::limit($admin->last_name, 20, '..') }}</td>
                                <td class="text-center align-middle px-0">{{ $admin->phone }}</td>
                                @if ($admin->verified)
                                    <td class="text-center align-middle px-0 d-sm-table-cell d-none h-100"><span class="badge bg-success fw-normal">فعال</span></td>
                                @else
                                    <td class="text-center align-middle px-0 d-sm-table-cell d-none h-100"><span class="badge bg-danger fw-normal">غیرفعال</span></td>
                                @endif
                                <td class="text-center align-middle text-nowrap">
                                    <div class="d-none d-sm-block">
                                        <button data-bs-toggle="modal" data-bs-target="#modal" value="{{ $admin->id }}" class="delete-admin btn btn-sm btn-danger ms-1"><i class="bi bi-trash-fill"></i></button>
                                        <a href="{{ route('admin.users.edit', ['user' => $admin->id]) }}" class="btn btn-sm btn-primary ms-1"><i class="bi bi-pencil-fill"></i></a>
                                        <a href="{{ route('admin.presidency.admins.permissions', ['admin' => $admin->id]) }}" class="btn btn-sm btn-info text-white ms-1"><i class="bi bi-key-fill align-middle"></i></a>
                                        <button data-bs-toggle="modal" data-bs-target="#modal" value="{{ $admin->id }}" class="dismiss-admin btn btn-sm btn-warning"><i class="text-white bi bi-person-fill-down"></i></button>
                                    </div>

                                    <div class="d-block d-sm-none btn-group">
                                        <button class="btn btn-primary btn-sm dropdown-toggle align-middle" type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                        <ul class="dropdown-menu text-center">
                                            <li><a href="{{ route('admin.presidency.admins.permissions', ['admin' => $admin->id]) }}" class="dropdown-item text-decoration-none text-info ms-1"><i class="bi bi-key-fill ms-1"></i>دسترسی ها</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a href="{{ route('admin.users.edit', ['user' => $admin->id]) }}" class="dropdown-item text-decoration-none text-primary"><i class="bi bi-pencil-fill ms-1"></i>ویرایش</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li data-bs-toggle="modal" data-bs-target="#modal" value="{{ $admin->id }}" class="delete-admin dropdown-item text-decoration-none text-danger"><i class="bi bi-trash-fill ms-1"></i>حذف</li>
                                            @superuser
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li data-bs-toggle="modal" data-bs-target="#modal" value="{{ $admin->id }}" class="dismiss-admin dropdown-item text-decoration-none text-warning"><i class="bi bi-person-fill-up ms-1"></i>عزل مدیر</li>
                                            @endsuperuser
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <div class="lds-ellipsis">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </tr>
                    @endif
                @else
                    <tr>
                        <div class="d-sm-inline-block d-md-none text-muted fs-4 fw-bold" style="position: absolute; top:50%; right:25%">نتیجه ای یافت نشد :(</div>
                        <div class="d-none d-md-inline-block d-lg-none text-muted fs-4 fw-bold" style="position: absolute; top:50%; right:38%">نتیجه ای یافت نشد :(</div>
                        <div class="d-none d-lg-inline-block text-muted fs-4 fw-bold" style="position: absolute; top:50%; right:43%">نتیجه ای یافت نشد :(</div>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer d-flex justify-content-center">
        {{-- {{ $admins->appends(['search' => request('search')])->render() }} --}}
        {{ $admins->links() }}
    </div>
</div>
<!-- /.card -->
