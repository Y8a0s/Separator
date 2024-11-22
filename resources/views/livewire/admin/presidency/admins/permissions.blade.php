@section('title', 'دسترسی های مدیر')

@section('script')
    <script>
        document.addEventListener('livewire:load', function() {
            $("#selectbox").select2();
            $('#selectbox').on('change', function (e) {  //for send data (select2 in livewire)
            var data = $('#selectbox').select2("val");
            @this.set('permissions' , data);
           });
        });
    </script>
@endsection

<div class="d-flex justify-content-center row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">دسترسی های مدیر</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form wire:submit.prevent="setPermissions" class="form-horizontal">
                <div class="card-body">

                    <div wire:ignore class="form-group mb-3">
                        <label for="inputEmail3" class="control-label mb-2">لیست دسترسی ها</label>
                        <select name="permissions[]" id="selectbox" wire:model="permissions" class="form-select @error('permissions') is-invalid @enderror" multiple>
                            <option class="mt-2 mb-3 fs-5" disabled>لطفا انتخاب کنید</option>
                            @foreach (App\Models\Permission::all() as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>

                        @error('permissions')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">اعمال دسترسی ها</button>
                    <a href="{{ route('admin.presidency.admins.all') }}" class="btn btn-danger float-left">لغو</a>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div>
</div>
