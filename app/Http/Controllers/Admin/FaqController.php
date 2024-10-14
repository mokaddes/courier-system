<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;


class FaqController extends Controller
{
    protected $faq;
    public $user;

    public function __construct(Faq $faq)
    {
        $this->faq     = $faq;
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function index(Request $request)
    {

        if (is_null($this->user) || !$this->user->can('admin.faq.index')) {
            abort(403, 'Sorry !! You are Unauthorized.');
        }

        $data['title'] = 'FAQ List';
        $data['rows'] = Faq::get();
        return view('admin.faq.index', compact('data'));
    }

    public function create()
    {
        if (is_null($this->user) || !$this->user->can('admin.faq.create')) {
            abort(403, 'Sorry !! You are Unauthorized.');
        }

        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('admin.faq.store')) {
            abort(403, 'Sorry !! You are Unauthorized.');
        }

        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $faq                   = new Faq();
            $faq->title            = $request->title;
            $faq->body             = $request->body;
            $faq->is_active        = $request->is_active;
            $faq->order_id         = Faq::max('order_id') + 1;
            $faq->created_by       = Auth::user()->id;
            $faq->created_at       = date('Y-m-d H:i:s');
            $faq->save();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error(('Unable to create faq'), 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }
        DB::commit();
        Toastr::success(trans('Faq has been created successfully !'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.faq.index');
    }


    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('admin.faq.edit')) {
            abort(403, 'Sorry !! You are Unauthorized.');
        }


        $data['title'] = 'FAQ Edit';
        $data['row'] = Faq::find($id);
        return view('admin.faq.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->can('admin.faq.update')) {
            abort(403, 'Sorry !! You are Unauthorized.');
        }

        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $faq                   = Faq::findOrFail($id);
            $faq->title            = $request->title;
            $faq->body             = $request->body;
            $faq->is_active        = $request->is_active;
            $faq->order_id         = $request->order_id;
            $faq->updated_by       = Auth::user()->id;
            $faq->updated_at       = date('Y-m-d H:i:s');
            $faq->save();
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            Toastr::error(('Unable to update faq'), 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }
        DB::commit();
        Toastr::success(trans('Faq has been updated successfully !'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.faq.index');
    }


    public function view($id)
    {
        if (is_null($this->user) || !$this->user->can('admin.faq.view')) {
            abort(403, 'Sorry !! You are Unauthorized.');
        }

        $data['title'] = 'FAQ Edit';
        $data['row'] = Faq::find($id);

        return view('admin.faq.view', compact('data'));
    }



    public function delete($id)
    {

        if (is_null($this->user) || !$this->user->can('admin.faq.delete')) {
            abort(403, 'Sorry !! You are Unauthorized.');
        }

        $faq = Faq::findOrFail($id);
        $faq->delete();
        Toastr::success(trans('Successfully delete faq !'), 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
