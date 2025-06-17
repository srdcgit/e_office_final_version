<?php

namespace App\Models;

use App\Facades\UtilityFacades;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;


    public const STATUS_OFFLINE = "Offline";
    public const STATUS_ONLINE  = "Online";
    public const STATUS_BUSY = "Busy";
    public const STATUS_TEA_BREAK = "Tea Break";
    public const STATUS_LUNCH_BREAK = "Lunch Break";
    public const STATUS_MEETING = "Meeting";

    public const STATUSES = [
        self::STATUS_OFFLINE => "0",
        self::STATUS_ONLINE => "1",
        self::STATUS_BUSY => "2",
        self::STATUS_TEA_BREAK => "3",
        self::STATUS_LUNCH_BREAK => "4",
        self::STATUS_MEETING => "5",
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'type',
        'department_id',
        'section_id',
        'created_by',
        'avatar'
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
        'name' => 'string'
    ];

    public static function get_status($status_code)
    {
        return array_search($status_code, self::STATUSES, true) ?: 'Unknown';
    }
    public function creatorId()
    {
        if ($this->type == 'company' || $this->type == 'admin') {
            return $this->id;
        } else {
            return $this->created_by;
        }
    }

    public function currentLanguage()
    {
        return $this->lang;
    }

    public function loginSecurity()
    {
        return $this->hasOne('App\Models\LoginSecurity');
    }

    public function pnotes()
    {
        return $this->hasMany(PersonalNotes::class);
    }

    public function notices()
    {
        return $this->hasMany(Notice::class);
    }

    public function departments()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function sections()
    {
        return $this->belongsTo(Section::class,'section_id');
    }
}
