<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LanguageController extends Controller
{

    protected $lang;
    public $user;

    public function __construct(Language $lang)
    {
        $this->lang     = $lang;
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }


    public function index()
    {
        if (is_null($this->user) || !$this->user->can('admin.blog-post.index')) {
            abort(403, 'Sorry !! You are Unauthorized.');
        }

        $data['title']  = 'Language List';
        $data['rows']   = Language::all();

        return view('admin.settings.Language.index', compact('data'));
    }
}
