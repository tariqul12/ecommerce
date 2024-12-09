@extends('admin.master')
@section('title', 'Website Company')
@section('body')

    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Company Module</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Company</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage Company</li>
            </ol>
        </div>
    </div>

    <!-- PAGE-HEADER END -->
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Company Form</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">{{ session('message') }}</p>
                    <form class="form-horizontal" action="{{ route('company.update', ['id' => $company->id]) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-4">
                            <label for="name" class="col-md-3 form-label">Company Name</label>
                            <div class="col-md-9">
                                <input class="form-control" value="{{ $company->company_name }}" name="company_name"
                                    id="name" placeholder="Company Name" type="text" />
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="companySlogan" class="col-md-3 form-label">Company Slogan</label>
                            <div class="col-md-9">
                                <input class="form-control" value="{{ $company->slogan }}" name="slogan" id="companySlogan"
                                    placeholder="Company slogan" type="text" />
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="companyTitle" class="col-md-3 form-label">Company Title</label>
                            <div class="col-md-9">
                                <input class="form-control" value="{{ $company->title }}" name="title" id="companyTitle"
                                    placeholder="Company Title" type="text" />
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="contact_phone" class="col-md-3 form-label">Contact Phone</label>
                            <div class="col-md-9">
                                <input class="form-control" value="{{ $company->contact_phone }}" name="contact_phone"
                                    id="contact_phone" placeholder="Company contact_phone" type="number" />

                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="support_phone" class="col-md-3 form-label">Support Phone</label>
                            <div class="col-md-9">
                                <input class="form-control" value="{{ $company->support_phone }}" name="support_phone"
                                    id="support_phone" placeholder="Company support_phone" type="number" />

                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="contact_email" class="col-md-3 form-label">Contact Email</label>
                            <div class="col-md-9">
                                <input class="form-control" value="{{ $company->contact_email }}" name="contact_email"
                                    id="contact_email" placeholder="Company contact_email" type="email" />

                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="support_email" class="col-md-3 form-label">Support Email</label>
                            <div class="col-md-9">
                                <input class="form-control" value="{{ $company->support_email }}" name="support_email"
                                    id="support_email" placeholder="Company support_email" type="email" />

                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="office_hour" class="col-md-3 form-label">Office Hour </label>
                            <div class="col-md-9">
                                <input class="form-control" value="{{ $company->office_hour }}" name="office_hour"
                                    id="office_hour" placeholder="Company office_hour" type="text" />
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="facebook_link" class="col-md-3 form-label">Facebook Link</label>
                            <div class="col-md-9">
                                <input class="form-control" value="{{ $company->facebook_link }}" name="facebook_link"
                                    id="facebook_link" placeholder="Company facebook_link" type="text" />

                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="twitter_link" class="col-md-3 form-label">Twitter Link</label>
                            <div class="col-md-9">
                                <input class="form-control" value="{{ $company->twitter_link }}" name="twitter_link"
                                    id="twitter_link" placeholder="Company twitter_link" type="text" />

                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="linkedin_link" class="col-md-3 form-label">LinkedIn Link</label>
                            <div class="col-md-9">
                                <input class="form-control" value="{{ $company->linkedin_link }}" name="linkedin_link"
                                    id="linkedin_link" placeholder="Company linkedin_link" type="text" />
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="youtube_link" class="col-md-3 form-label">Youtube Link</label>
                            <div class="col-md-9">
                                <input class="form-control" value="{{ $company->youtube_link }}" name="youtube_link"
                                    id="youtube_link" placeholder="Company youtube_link" type="text" />

                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="instagram_link" class="col-md-3 form-label">Instagram Link</label>
                            <div class="col-md-9">
                                <input class="form-control" value="{{ $company->instagram_link }}" name="instagram_link"
                                    id="instagram_link" placeholder="Company Instagram link" type="text" />
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="google_map_api_link" class="col-md-3 form-label">Google Map Api Link</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="google_map_api_link" placeholder="Google Map Api Link" type="text">{{ $company->google_map_api_link }}</textarea>

                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="companyAddress" class="col-md-3 form-label">Company Address</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="company_address" id="companyAddress" placeholder="Company Address">{{ $company->company_address }}</textarea>
                            </div>
                        </div>


                        <div class="row mb-4">
                            <label for="logo_jpg" class="col-md-3 form-label">Logo Jpg </label>
                            <div class="col-md-9">
                                <input type="file" class="dropify" id="logo_jpg" name="logo_jpg"
                                    data-height="200" />
                                <img src="{{ asset($company->logo_jpg) }}" alt="" height="150" />
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="logo_png" class="col-md-3 form-label">footer Logo </label>
                            <div class="col-md-9">
                                <input type="file" class="dropify" id="logo_png" name="logo_png"
                                    data-height="200" />
                                <img src="{{ asset($company->logo_png) }}" alt="" height="150" />
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="favicon" class="col-md-3 form-label">Logo Favicon </label>
                            <div class="col-md-9">
                                <input type="file" class="dropify" id="favicon" name="favicon"
                                    data-height="200" />
                                <img src="{{ asset($company->favicon) }}" alt="" height="150" />
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="payment_method_image" class="col-md-3 form-label">Payment Method Image</label>
                            <div class="col-md-9">
                                <input type="file" class="dropify" id="payment_method_image"
                                    name="payment_method_image" data-height="200" />
                                <img src="{{ asset($company->payment_method_image) }}" alt="" height="150" />
                            </div>
                        </div>

                        <button class="btn btn-primary rounded-0 float-end" type="submit">Update Information</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
