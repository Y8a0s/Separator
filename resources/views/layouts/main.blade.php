@if (Illuminate\Support\Str::startsWith(Illuminate\Support\Facades\Route::currentRouteName() , 'admin'))
    {{-- include admins app.blade.php --}}
    @include('layouts.admin.app') 
@else
    {{-- include frontend.blade.php --}}
    @include('layouts.frontend.app')
@endif