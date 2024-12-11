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
                <li class="breadcrumb-item active" aria-current="page">Create Role</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->
    <div class="row">
        <div class="col-md-10 m-auto">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Create Role Form</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">{{ session('message') }}</p>
                    <form class="form-horizontal" action="{{ route('role.store') }}" enctype="multipart/form-data"
                        method="POST">
                        @csrf
                        <div class="row mb-4">
                            <label for="role_name" class="col-2 form-label">Role Name</label>
                            <div class="col-10">
                                <input class="form-control" name="name" id="role_name" placeholder="Role Name"
                                    type="text">
                                <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="role_description" class="col-2 form-label">Role Description</label>
                            <div class="col-10">
                                <textarea class="form-control" name="description" id="role_description" placeholder="Role Description"></textarea>
                                <span
                                    class="text-danger">{{ $errors->has('description') ? $errors->first('description') : '' }}</span>
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
                                @foreach ($routeList as $key => $item)
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
                                                id="route{{ $key }}" type="checkbox">{{ $item->getName() }}</label>
                                    @endif
                                @endforeach

                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Create New Role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
