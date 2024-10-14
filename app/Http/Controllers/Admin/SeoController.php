<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    //
    public $seo;

    public function __construct(Seo $seo)
    {
        $this->seo = $seo;
    }

    public function index()
    {
        $seos = Seo::get();
        return view('admin.seo.index', compact('seos'));
    }

    public function edit($id)
    {
        $seo = Seo::FindOrFail($id);
        return view('admin.seo.edit', compact('seo'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $seo = $this->seo->seoUpdate($request, $id);

        if(!$seo->status) {
            Toastr::info($seo->msg, 'Info');
            return redirect()->route($seo->redirect_to, $seo->data);
        }

        Toastr::success($seo->msg, 'Success');
        return redirect()->route($seo->redirect_to);

    }
}
