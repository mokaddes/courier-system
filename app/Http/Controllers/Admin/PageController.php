<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index()
    {
        $data['title'] = 'Pages';
        $pageContent = PageContent::first();
        return view('admin.cms.pages', compact('data', 'pageContent'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'about_us' => 'required',
            'privacy_policy' => 'required',
            'terms_condition' => 'required',
        ]);


        try {
            DB::beginTransaction();

            $pageContent = PageContent::first();


            if (isset($pageContent)) {
                $pageContent->update([
                    'about_us' => $request->about_us,
                    'privacy_policy' => $request->privacy_policy,
                    'terms_condition' => $request->terms_condition,
                ]);
            } else {
                PageContent::create([
                    'about_us' => $request->about_us,
                    'privacy_policy' => $request->privacy_policy,
                    'terms_condition' => $request->terms_condition,
                ]);
            }




            DB::commit();
            Toastr::success('Page content are update');
            return redirect()->back();
        } catch (Exception $th) {
            DB::rollBack();
            Toastr::error('Something Wrong');
            return redirect()->back();
        }
    }
}
