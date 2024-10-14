<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\RepoResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Seo extends Model
{
    use HasFactory, RepoResponse;

    protected $table = "seos";

    protected $fillable = [
        'page_slug',
        'title',
        'description',
        'image',
        'created_at',
        'updated_at',
    ];

    public function seoUpdate($request, $id)
    {
        DB::beginTransaction();
            try {
                if ($request->file('image')) {

                    $seos = Seo::findOrFail($id);

                    if (file_exists($seos->image)) {
                        unlink($seos->image);
                    }

                    $image_url = uploadImage($request->image, 'seos', 350, 200);

                }else {
                    $seos = Seo::findOrFail($id);
                    $image_url = $seos->image;
                }

                Seo::findOrFail($id)->update([
                    'title' => $request->title,
                    'description' => $request->description,
                    'image' => $image_url,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            } catch (\Throwable $th) {
                dd($th);

                DB::rollBack();

                return $this->formatResponse(false, 'Unable to update seo page', 'admin.seo.edit', $id);
            }
        DB::commit();
        return $this->formatResponse(true, 'Unable to update seo page', 'admin.seo.index');
    }
}
