@section('title', 'صفحه اصلی')

<div>
    <h1 class="text-center">صفحه اصلی</h1>

    <div class="container" dir="ltr">
        <div class="row">
            <div class="col-md-3">
                <div class="card-counter d-flex align-items-center pt-5 primary">
                    <i class="bi bi-people-fill"></i>
                    <span class="ms-2" style="font-size: 4rem">{{ App\Models\User::where('isSuperUser', 0)->where('isAdmin', 0)->get()->count() }}</span>
                    <span class="count-name">Flowz</span>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card-counter d-flex align-items-center pt-5 success">
                    <i class="bi bi-shield-shaded"></i>
                    <span class="ms-2" style="font-size: 4rem">{{ App\Models\User::where('isSuperUser', 1)->orWhere('isAdmin', 1)->get()->count() }}</span>
                    <span class="count-name">Data</span>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card-counter d-flex align-items-center pt-5 danger">
                    <i class="bi bi-layers-fill"></i>
                    <span class="ms-2" style="font-size: 4rem">{{ App\Models\Product::all()->count() }}</span>
                    <span class="count-name">Instances</span>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card-counter d-flex align-items-center pt-5" style="background-color: yellow; overflow: hidden !important">
                    <i class="bi bi-wechat" style="color: rgb(201, 201, 0)"></i>
                    <span class="ms-2" style="font-size: 4rem">{{ App\Models\Comment::all()->count() }}</span>
                    <span class="count-name">Users</span>
                </div>
            </div>
        </div>
    </div>

</div>
