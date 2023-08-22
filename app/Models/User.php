<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;
use DB;

class User extends Authenticatable
{
    use HasRoleAndPermission;
    use Notifiable;
    use SoftDeletes;

    const USER_ACCESS_LEVEL_BANNED = 'banned';
    const USER_ACCESS_LEVEL_PLAYER = 'player';
    const USER_ACCESS_LEVEL_QUALITY_ASSURANCE = 'quality_assurance';
    const USER_ACCESS_LEVEL_SENIOR_QUALITY_ASSURANCE = 'senior_quality_assurance';
    const USER_ACCESS_LEVEL_MODERATOR = 'moderator';
    const USER_ACCESS_LEVEL_COMMUNITY_MANAGER = 'community_manager';
    const USER_ACCESS_LEVEL_GAME_MASTER = 'game_master';
    const USER_ACCESS_LEVEL_SENIOR_GAME_MASTER = 'senior_game_master';
    const USER_ACCESS_LEVEL_HEAD_GAME_MASTER = 'head_game_master';
    const USER_ACCESS_LEVEL_DEVELOPER = 'developer';
    const USER_ACCESS_LEVEL_OWNER = 'owner';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'activated',
        'token',
        'signup_ip_address',
        'signup_confirmation_ip_address',
        'signup_sm_ip_address',
        'admin_ip_address',
        'updated_ip_address',
        'deleted_ip_address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'activated',
        'token',
    ];

    protected $dates = [
        'deleted_at',
    ];

    /**
     * Build Social Relationships.
     *
     * @var array
     */
    public function social()
    {
        return $this->hasMany('App\Models\Social');
    }

    /**
     * User Profile Relationships.
     *
     * @var array
     */
    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    // User Profile Setup - SHould move these to a trait or interface...

    public function profiles()
    {
        return $this->belongsToMany('App\Models\Profile')->withTimestamps();
    }

    public function hasProfile($name)
    {
        foreach ($this->profiles as $profile) {
            if ($profile->username == $name) {
                return true;
            }
        }

        return false;
    }

    public function assignProfile($profile)
    {
        return $this->profiles()->attach($profile);
    }

    public function removeProfile($profile)
    {
        return $this->profiles()->detach($profile);
    }

    public function canModerateUsers()
    {
        return in_array($this->access_level, [self::USER_ACCESS_LEVEL_DEVELOPER, self::USER_ACCESS_LEVEL_HEAD_GAME_MASTER, self::USER_ACCESS_LEVEL_OWNER]);
    }

    public function canModerateRealms()
    {
        return in_array($this->access_level, [self::USER_ACCESS_LEVEL_DEVELOPER, self::USER_ACCESS_LEVEL_HEAD_GAME_MASTER, self::USER_ACCESS_LEVEL_OWNER]);
    }

    public function canModerateItems()
    {
        return in_array($this->access_level, [self::USER_ACCESS_LEVEL_DEVELOPER, self::USER_ACCESS_LEVEL_HEAD_GAME_MASTER, self::USER_ACCESS_LEVEL_OWNER]);
    }

    public function canAddNews()
    {
        return in_array($this->access_level, [self::USER_ACCESS_LEVEL_QUALITY_ASSURANCE, self::USER_ACCESS_LEVEL_DEVELOPER, self::USER_ACCESS_LEVEL_HEAD_GAME_MASTER, self::USER_ACCESS_LEVEL_OWNER]);
    }

    public function canModerateNews()
    {
        return in_array($this->access_level, [self::USER_ACCESS_LEVEL_DEVELOPER, self::USER_ACCESS_LEVEL_HEAD_GAME_MASTER, self::USER_ACCESS_LEVEL_OWNER]);
    }

    public function canAddFaq()
    {
        return in_array($this->access_level, [self::USER_ACCESS_LEVEL_QUALITY_ASSURANCE, self::USER_ACCESS_LEVEL_DEVELOPER, self::USER_ACCESS_LEVEL_HEAD_GAME_MASTER, self::USER_ACCESS_LEVEL_OWNER]);
    }

    public function canModerateFaq()
    {
        return in_array($this->access_level, [self::USER_ACCESS_LEVEL_DEVELOPER, self::USER_ACCESS_LEVEL_HEAD_GAME_MASTER, self::USER_ACCESS_LEVEL_OWNER]);
    }

    public function canModerateChangelogs()
    {
        return in_array($this->access_level, [self::USER_ACCESS_LEVEL_DEVELOPER, self::USER_ACCESS_LEVEL_HEAD_GAME_MASTER, self::USER_ACCESS_LEVEL_OWNER]);
    }

    public function canModerateBugtrackers()
    {
        return in_array($this->access_level, [self::USER_ACCESS_LEVEL_DEVELOPER, self::USER_ACCESS_LEVEL_HEAD_GAME_MASTER, self::USER_ACCESS_LEVEL_OWNER]);
    }

    public function isStaff($userId)
    {
        $user_access_level = DB::select(DB::raw("SELECT access_level FROM users WHERE id=" . $userId))[0]->access_level;
        return in_array($user_access_level, [self::USER_ACCESS_LEVEL_DEVELOPER, self::USER_ACCESS_LEVEL_OWNER, self::USER_ACCESS_LEVEL_COMMUNITY_MANAGER, self::USER_ACCESS_LEVEL_MODERATOR, self::USER_ACCESS_LEVEL_QUALITY_ASSURANCE, self::USER_ACCESS_LEVEL_SENIOR_QUALITY_ASSURANCE ]);
    }

    public function isNotPlayer()
    {
        return !in_array($this->access_level, [ self::USER_ACCESS_LEVEL_BANNED, self::USER_ACCESS_LEVEL_PLAYER ]);
    }

    public function getAccessLevelString()
    {
        switch ($this->access_level) {
            case 'banned'                   :
                return 'Banned';
            case 'player'                   :
                return 'Player';
            case 'quality_assurance'        :
                return 'Quality Assurance';
            case 'senior_quality_assurance' :
                return 'Senior Quality Assurance';
            case 'moderator'                :
                return 'Moderator';
            case 'community_manager'        :
                return 'Community Manager';
            case 'game_master'              :
                return 'Game Master';
            case 'senior_game_master'       :
                return 'Senior Game Master';
            case 'head_game_master'         :
                return 'Head Game Master';
            case 'developer'                :
                return 'Developer';
            case 'owner'                    :
                return 'Owner';
        }
    }

    public static function getPossibleRoles()
    {
        $type = DB::select(DB::raw('SHOW COLUMNS FROM users WHERE Field = "access_level"'))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $values = array();
        foreach (explode(',', $matches[1]) as $value) {
            $values[trim($value, "'")] = self::getAccessLevelDisplayString(trim($value, "'"));
        }
        return $values;
    }

    public static function getAccessLevelDisplayString($role)
    {
        switch ($role) {
            case 'banned'                   :
                return 'Banned';
            case 'player'                   :
                return 'Player';
            case 'quality_assurance'        :
                return 'Quality Assurance';
            case 'senior_quality_assurance' :
                return 'Senior Quality Assurance';
            case 'moderator'                :
                return 'Moderator';
            case 'community_manager'        :
                return 'Community Manager';
            case 'game_master'              :
                return 'Game Master';
            case 'senior_game_master'       :
                return 'Senior Game Master';
            case 'head_game_master'         :
                return 'Head Game Master';
            case 'developer'                :
                return 'Developer';
            case 'owner'                    :
                return 'Owner';
        }
    }

}
