@section('title', 'دسترسی ها')

@section('script')
    <script>
        document.addEventListener('livewire:load', function() {
            $(document).on("click", ".delete-permission", function() {
                var permissionId = $(this).val();
                $("#modal-ok-buttom").attr("wire:click", `deletePermission(${permissionId})`);
                $("#modal .modal-title").html(`حذف دسترسی ${permissionId}`);
                $("#modal .modal-body").html('<p>آیا از <span class="text-danger">حذف</span> این دسترسی اطمینان دارید؟</p>');
            });
        })
    </script>
@endsection

<div class="card h-100 shadow-sm">

    @include('layouts.admin.modal')
    <!-- /.modal -->

    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">دسترسی ها</h3>

        <div class="card-tools">
            <div class="btn-group-sm">
                <a href="{{ route('admin.presidency.permissions.create') }}" class="btn btn-info">دسترسی جدید</a>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-2 align-middle" dir="ltr">
        <ol class="list-group list-group-numbered" wire:init="loadPermissionsData">
            @if ($readyToLoad)
                @foreach ($permissions as $permission)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <h5>{{ $permission->name }}</h5>
                            <span class="text-warning">{{ $permission->label }}</span>
                        </div>
                        <div class="d-flex flex-column" dir="rtl">
                            <div class="d-inline-flex mb-1" style="width: max-content">
                                <button data-bs-toggle="modal" data-bs-target="#modal" value="{{ $permission->id }}" class="delete-permission btn btn-sm btn-danger align-middle ms-1"><i class="d-flex align-items-center bi bi-x-lg"></i></button>
                                <a href="{{ route('admin.presidency.permissions.edit', ['permission' => $permission->id]) }}" class="btn btn-sm btn-primary ms-1"><i class="bi bi-pencil-fill"></i></a>
                            </div>
                            @if ($permission->users()->count())
                                <span class="badge bg-secondary text-wrap fw-normal">{{ $permission->users()->count() }} مدیر</span>
                            @endif
                        </div>
                    </li>
                @endforeach
            @else
                <div class="lds-ellipsis">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            @endif
        </ol>
    </div>
    <!-- /.card-body -->
    <div class="card-footer d-flex justify-content-center">

    </div>
</div>
<!-- /.card -->
