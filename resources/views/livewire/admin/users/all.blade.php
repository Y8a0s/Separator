@section('title', 'کاربران')

@section('script')
    <script>
        document.addEventListener('livewire:load', function() {
            $(document).on("click", ".delete-user", function() {
                var userId = $(this).val();
                $("#modal-ok-buttom").attr("wire:click", `deleteUser(${userId})`);
                $("#modal .modal-title").html(`حذف حساب کاربر ${userId}`);
                $("#modal .modal-body").html('<p>آیا از <span class="text-danger">حذف</span> این کاربر اطمینان دارید؟</p>');
            });

            $(document).on("click", ".set-admin", function() {
                var userId = $(this).val();
                $("#modal-ok-buttom").attr("wire:click", `setAdmin(${userId})`);
                $("#modal .modal-title").html(`ارتقای کاربر ${userId} به مدیر`);
                $("#modal .modal-body").html('<p>آیا از <span class="text-warning">ارتقای<i class="bi bi-caret-up-fill"></i></span> این کاربر اطمینان دارید؟</p>');
            });

            // $(document).on("click", "#copyToClipboard", function() {
            //     $('#copyToClipboard').select();
            //     document.execCommand('copy');
            //     Livewire.emit('simpleToast', 'success', '', 'کپی شد:(');
            // });
        });
    </script>
@endsection

<div class="card h-100 shadow-sm">

    @include('layouts.admin.modal')
    <!-- /.modal -->

    <div class="card-header">
        <h3 class="card-title">کاربران</h3>
        <div class="card-tools d-flex justify-content-between mb-3">
            <form wire:submit.prevent="searchUsers" class="d-flex ms-2">
                <div class="input-group ms-2" dir="ltr">
                    <button class="btn btn-primary border border-secondary" id="search-button" type="submit"><i class="bi bi-search btn-sm"></i></button>
                    <input type="text" wire:model.defer="search" class="form-control" placeholder="جست و جو..." dir="rtl">
                </div>
                <select wire:model="filterBy" wire:click="searchUsers()" class="form-select form-select-sm h-100 text-start" style="width: 95px" dir="ltr">
                    <option class="text-center" value="all" selected>همه</option>
                    <option class="text-center" value="actives">فعال</option>
                    <option class="text-center" value="inactives">غیرفعال</option>
                </select>
            </form>

            @can('create-users')
                <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary text-white">
                    <i class="bi bi-person-fill-add fs-5 align-middle"></i>
                    <span class="d-none d-lg-inline">کاربر جدید</span>
                </a>
            @endcan
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
            <tbody wire:init="loadUsersData">
                @if (!empty($users->items()))
                    @if ($readyToLoad)
                        @foreach ($users as $user)
                            <tr style="height: 4rem">
                                <td class="text-center align-middle px-0"><span class="badge fw-normal  @if ($user->verified) user-id-success @else user-id-danger @endif">{{ $user->id }}</span></td>
                                <td class="text-center align-middle px-0 ps-1">{{ $user->name }}</td>
                                <td class="text-center align-middle px-0 ps-1 d-sm-table-cell d-none h-100">{{ Illuminate\Support\Str::limit($user->last_name, 20, '..') }}</td>
                                <td class="text-center align-middle px-0"><button class="border-0 rounded" id="copyToClipboard">{{ $user->phone }}</button></td>
                                @if ($user->verified)
                                    <td class="text-center align-middle px-0 d-sm-table-cell d-none h-100"><span class="badge bg-success fw-normal">فعال</span></td>
                                @else
                                    <td class="text-center align-middle px-0 d-sm-table-cell d-none h-100"><span class="badge bg-danger fw-normal">غیرفعال</span></td>
                                @endif
                                <td class="text-center align-middle text-nowrap">
                                    <div class="d-none d-sm-block">
                                        @can('delete-users')
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#modal" value="{{ $user->id }}" class="delete-user btn btn-sm btn-danger"><i class="bi bi-trash-fill"></i></button>
                                        @endcan
                                        @can('edit-users')
                                            <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil-fill"></i></a>
                                        @endcan
                                        {{-- @superuser --}}
                                            <button data-bs-toggle="modal" data-bs-target="#modal" value="{{ $user->id }}" class="set-admin btn btn-sm btn-warning"><i class="text-white bi bi-person-fill-up"></i></button>
                                        {{-- @endsuperuser --}}
                                    </div>

                                    <div class="d-block d-sm-none btn-group">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle align-middle" type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                        <ul class="dropdown-menu text-center">
                                            @can('edit-users')
                                                <li><a href="{{ route('admin.users.edit', ['user' => $user->id]) }}" class="dropdown-item text-decoration-none text-primary"><i class="bi bi-pencil-fill ms-1"></i>ویرایش</a></li>
                                            @endcan
                                            @can('delete-users')
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li data-bs-toggle="modal" data-bs-target="#modal" value="{{ $user->id }}" class="delete-user dropdown-item text-decoration-none text-danger"><i class="bi bi-trash-fill ms-1"></i>حذف</li>
                                            @endcan
                                            @superuser
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li data-bs-toggle="modal" data-bs-target="#modal" value="{{ $user->id }}" class="set-admin dropdown-item text-decoration-none text-warning"><i class="bi bi-person-fill-up ms-1"></i>ارتقا به مدیر</li>
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
        {{-- {{ $users->appends(['search' => request('search')])->render() }} --}}
        {{ $users->links() }}
    </div>
</div>
<!-- /.card -->
