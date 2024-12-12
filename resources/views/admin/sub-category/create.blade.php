@extends('admin.master')
@section('body')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Sub Category Module</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Sub Category</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Sub Category</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->
    <div class="row">
        <div class="col-md-6 m-auto">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Create Sub Category Form</h3>
                    <a class="btn btn-info ms-auto" href="{{ route('sub-category.create') }}">add
                        Sub Category</a>
                </div>
                <div class="card-body">
                    <p class="text-muted">{{ session('message') }}</p>
                    <form class="form-horizontal" action="{{ route('sub-category.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-4">
                            <label for="" class="col-md-3 form-label">Category Name</label>
                            <div class="col-md-9">
                                <select class="form-control" name="category_id">
                                    <option value="">-- Select Category Name --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <span
                                    class="text-danger">{{ $errors->has('category_id') ? $errors->first('category_id') : '' }}</span>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="subcategoryName" class="col-md-3 form-label">Sub Category Name</label>
                            <div class="col-md-9">
                                <input class="form-control" name="name" id="subcategoryName"
                                    placeholder="Sub Category Name" type="text">
                                <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="categoryDescription" class="col-md-3 form-label">Sub Category Description</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="description" id="categoryDescription" placeholder="Sub Category Description"></textarea>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="image" class="col-md-3 form-label">Sub Category Image</label>
                            <div class="col-md-9">
                                <input class="dropify" data-height="200" name="image" id="image" type="file">
                                <span class="text-danger">{{ $errors->has('image') ? $errors->first('image') : '' }}</span>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="publication" class="col-md-3 form-label">Publication Status</label>
                            <div class="col-md-9">
                                <label><input name="status" id="publication" type="radio" checked
                                        value="1">Published</label>
                                <label><input name="status" id="publication" type="radio"
                                        value="0">Unpublished</label>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Create New Sub Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
