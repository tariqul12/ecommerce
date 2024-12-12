@extends('admin.master')
@section('body')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Role Module</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Role</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Role</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->
    <div class="row">
        <div class="col-md-10 m-auto">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Edit Role Form</h3>
                    <a class="btn btn-info ms-auto" href="{{ route('role.index') }}">All
                        Role</a>
                </div>
                <div class="card-body">
                    <p class="text-muted">{{ session('message') }}</p>
                    <form class="form-horizontal" action="{{ route('role.update', ['id' => $role->id]) }}"
                        enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row mb-4">
                            <label for="roleName" class="col-md-2 form-label">Role Name</label>
                            <div class="col-md-10">
                                <input class="form-control" name="name" value="{{ $role->name }}" id="roleName"
                                    placeholder="Role Name" type="text">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="roleDescription" class="col-md-2 form-label">Role Description</label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="description" id="roleDescription" placeholder="Role Description">{{ $role->description }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="role_description" class="col-2 form-label">Route Select</label>
                            <div class="col-10">
                                <label for=""><input type="checkbox" name="" id="allroute">All Route
                                    Select</label>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="" class="col-2 form-label">Route Name</label>
                            <div class="col-10">
                                @foreach ($routeLists as $key => $item)
                                    @if (
                                        $item->getName() != 'livewire.update' &&
                                            $item->getName() != 'livewire.preview-file' &&
                                            $item->getName() != 'password.request' &&
                                            $item->getName() != 'password.reset' &&
                                            $item->getName() != 'password.email' &&
                                            $item->getName() != 'password.update' &&
                                            $item->getName() != 'password.confirm' &&
                                            $item->getName() != 'password.confirmation' &&
                                            $item->getName() != 'password.confirm.store' &&
                                            $item->getName() != 'two-factor.login' &&
                                            $item->getName() != 'two-factor.login.store' &&
                                            $item->getName() != 'two-factor.enable' &&
                                            $item->getName() != 'two-factor.confirm' &&
                                            $item->getName() != 'two-factor.disable' &&
                                            $item->getName() != 'two-factor.qr-code' &&
                                            $item->getName() != 'two-factor.secret-key' &&
                                            $item->getName() != 'two-factor.recovery-codes' &&
                                            $item->getName() != 'sanctum.csrf-cookie' &&
                                            $item->getName() != 'livewire.upload-file' &&
                                            $item->getName() != 'profile.show' &&
                                            $item->getName() != '')
                                        <label for="route{{ $key }}"><input name="route_name[]"
                                                value="{{ $item->getName() }}" class="route-checkbox"
                                                id="route{{ $key }}"
                                                @foreach ($role->roleRoutes as $route) {{ $route->route_name == $item->getName() ? 'checked' : '' }} @endforeach
                                                type="checkbox">{{ $item->getName() }}</label>
                                    @endif
                                @endforeach

                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Update Role Info</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
