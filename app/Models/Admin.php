<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\AdminResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;
use App\Traits\RepoResponse;
use Illuminate\Support\Facades\Hash;

/**
 * @property mixed $status
 * @property mixed $fcm_token
 */
class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    use RepoResponse;

    protected $table = 'admins';
    protected $guard = 'admin';
    protected $appends = ['can_delete'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getPermissionGroup()
    {
        $permission_group = DB::table('permissions')
            ->select('group_name as name')
            ->groupBy('group_name')
            ->get();
        return $permission_group;
    }

    public static function getpermissionsByGroupName($group_name)
    {
        $permissions = DB::table('permissions')
            ->select('name', 'id')
            ->where('group_name', $group_name)
            ->get();
        return $permissions;
    }

    public static function roleHasPermission($role, $permissions)
    {
        $hasPermission = true;
        foreach ($permissions as $permission) {
            if (!$role->hasPermissionTo($permission->name)) {
                $hasPermission = false;
                return $hasPermission;
            }
        }
        return $hasPermission;
    }

    public function adminUpdate($request, $id)
    {
        // admin.profile
        DB::beginTransaction();
            try {

                $admin_info = Admin::findOrFail($id);

                if($request->file('image')) {

                    if(file_exists($admin_info->image)) {
                        unlink($admin_info->image);
                    }

                    $image_url = uploadImage($request->image, 'admin', 720, 480);

                }else {
                    $image_url = $admin_info->image;

                }

                Admin::findOrFail($id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'image' => $image_url,
                    'updated_at' => Carbon::now(),
                ]);

            } catch (\Throwable $th) {
                dd($th);
                DB::rollBack();
                return $this->formatResponse(false, 'Unable to update', 'admin.profile');
            }

        DB::commit();

        return $this->formatResponse(true, 'Admin successfully updated', 'admin.profile');
    }

    public function adminPasswordUpdate($request, $id)
    {
        DB::beginTransaction();

            try {

            $userData = Admin::findOrFail($id);
            $userData->password = Hash::make($request->password);
            $userData->save();

            } catch (\Throwable $th) {

                dd($th);

                DB::rollBack();

                return $this->formatResponse(false, 'Unable to update admin password', 'admin.profile');
            }

        DB::commit();

        return $this->formatResponse(true, 'Admin password successfully updated', 'admin.profile');
    }

    /**
     * @return false
     */
    public function getCanDeleteAttribute(): bool
    {
        $pickUpRequestCheck=PickupRequest::where('merchant_id','=',$this->id)->first();

        if (isset($pickUpRequestCheck)){
            return false;
        }else{
            return true;
        }
    }

    public function hasState():BelongsTo
    {
        return $this->belongsTo(Region::class,'state','id');

    }
    public function hasCity():BelongsTo
    {
        return $this->belongsTo(City::class,'city','id');

    }

    public function merchantPickupRequest(): HasMany
    {
        return $this->hasMany(PickupRequest::class, 'merchant_id', 'id');
    }
    public function deliveryPickupRequest(): HasMany
    {
        return $this->hasMany(PickupRequest::class, 'deliveryman_id', 'id');
    }



}
