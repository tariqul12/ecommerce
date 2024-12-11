@extends('admin.master')
@section('body')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Category Module</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Category</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage Category</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- DataTable -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">All Category Info</h3>
                    <a class="btn btn-info ms-auto" data-bs-target="#modaldemo1" data-bs-toggle="modal" href="">Add
                        Category</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">SL NO</th>
                                    <th class="wd-15p border-bottom-0">Name</th>
                                    <th class="wd-20p border-bottom-0">Description</th>
                                    <th class="wd-15p border-bottom-0">Image</th>
                                    <th class="wd-10p border-bottom-0">Status</th>
                                    <th class="wd-25p border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->description }}</td>
                                        <td><img src="{{ asset($category->image) }}" alt="" height="50"></td>
                                        <td>{{ $category->status == 1 ? 'Published' : 'Unpublished' }}</td>
                                        <td>
                                            <a href="{{ route('category.edit', ['id' => $category->id]) }}"
                                                class="btn btn-success btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{ route('category.destroy', ['id' => $category->id]) }}"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure to delete this?')">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End DataTable -->

    <!-- BASIC MODAL -->
    <div class="modal fade" id="modaldemo1">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Message Preview</h6><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h3 class="card-title">Create Category Form</h3>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">{{ session('message') }}</p>
                            <form class="form-horizontal" action="{{ route('category.store') }}"
                                enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="row mb-4">
                                    <label for="categoryName" class="col-md-3 form-label">Category Name</label>
                                    <div class="col-md-9">
                                        <input class="form-control" name="name" id="categoryName"
                                            placeholder="Category Name" type="text">
                                        <span
                                            class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="categoryDescription" class="col-md-3 form-label">Category
                                        Description</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="description" id="categoryDescription" placeholder="Category Description"></textarea>
                                        <span
                                            class="text-danger">{{ $errors->has('description') ? $errors->first('description') : '' }}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="image" class="col-md-3 form-label">Category Image</label>
                                    <div class="col-md-9">
                                        <input class="dropify" data-height="200" name="image" id="image"
                                            type="file">
                                        <span
                                            class="text-danger">{{ $errors->has('image') ? $errors->first('image') : '' }}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Publication Status</label>
                                    <div class="col-md-9">
                                        <label><input name="status" type="radio" checked value="1">Published</label>
                                        <label><input name="status" type="radio" value="0">Unpublished</label>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Create New Category</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Save changes</button> <button class="btn btn-light"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
