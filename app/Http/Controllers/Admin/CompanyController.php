<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        $company = Company::latest()->first();
        return view('admin.company.index', compact('company'));
    }

    public function create()
    {
        return view('admin.company.create');
    }

    public function store(Request $request)
    {
        self::saveInfo(new Company(), $request);
        return back()->with('message', 'Company add successfully');
    }

    private static function saveInfo($company, $request)
    {
        $company->company_name        = $request->company_name;
        $company->title               = $request->title;
        $company->slogan              = $request->slogan;
        $company->contact_phone       = $request->contact_phone;
        $company->support_phone       = $request->support_phone;
        $company->contact_email       = $request->contact_email;
        $company->support_email       = $request->support_email;
        $company->office_hour         = $request->office_hour;
        $company->facebook_link       = $request->facebook_link;
        $company->twitter_link        = $request->twitter_link;
        $company->linkedin_link       = $request->linkedin_link;
        $company->youtube_link        = $request->youtube_link;
        $company->instagram_link      = $request->instagram_link;
        $company->google_map_api_link = $request->google_map_api_link;
        if ($request->file('android_app_image')) {
            self::deleteFolderImage($company->android_app_image);
            $company->android_app_image   = getFileUrl($request->file('android_app_image'), 'uploads/company-image/');
        }
        $company->android_app_url     = $request->android_app_url;
        if ($request->file('ios_app_image')) {
            self::deleteFolderImage($company->ios_app_image);
            $company->ios_app_image       = getFileUrl($request->file('ios_app_image'), 'uploads/company-image/');
        }
        $company->ios_app_url         = $request->ios_app_url;
        $company->company_address     = $request->company_address;
        if ($request->file('logo_jpg')) {
            self::deleteFolderImage($company->logo_jpg);
            $company->logo_jpg        = getFileUrl($request->file('logo_jpg'), 'uploads/company-image/');
        }
        if ($request->file('logo_png')) {
            self::deleteFolderImage($company->logo_png);
            $company->logo_png       = getFileUrl($request->file('logo_png'), 'uploads/company-image/');
        }
        if ($request->file('favicon')) {
            self::deleteFolderImage($company->favicon);
            $company->favicon        = getFileUrl($request->file('favicon'), 'uploads/company-image/');
        }
        if ($request->file('payment_method_image')) {
            self::deleteFolderImage($company->payment_method_image);
            $company->payment_method_image = getFileUrl($request->file('payment_method_image'), 'uploads/company-image/');
        }
        $company->save();
    }
    private static function deleteFolderImage($image)
    {
        if (file_exists($image)) {
            unlink($image);
        }
    }
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('admin.company.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $company = Company::find($id);
        self::saveInfo($company, $request);
        return redirect('company/index')->with('message', 'Company edit successfully');
    }
}
