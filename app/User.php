<?php
 
namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\MyResetPassword;
use App\Portfolio;
use Auth;
use Illuminate\Support\Facades\Storage;


class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'user_name',
        'name',
        'first_name',
        'last_name',
        'email',
        'password',
        'type',
        'user_type',
        'terms_and_conditions',
        'password',
        'active',
        'profile',
        'mobile_number',
        'gender',
        'describe_yourself',
        'course',
        'college_university',
        'year_of_admission',
        'year_of_graduation',
        'salary_stripend',
        'coa_registration',
        'years_in_service',
        'award',
        'award_name',
        'project_name',
        'see_buildtrail',
        'bsiness_description',
        'year_in_service',
        'firm_size',
        'asset_served',
        'city_served',
        'services_offered',
        'webside',
        'years_since_service',
        'mobile_verify'
    ];

    protected $appends = ['profile_url'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getRouteKeyName()
    {
        return "user_name";
    }

    public function social()
    {
        return $this->hasMany(UserSocial::class);
    }

    public function userSocial() {
        return $this->hasOne(UserSocial::class,'user_id')->withDefault();
    }

    public function hasSocialLinked($service)
    {
        return (bool)$this->social->where('service', $service)->count();
    }

    public function userDetail()
    {
        return $this->hasOne(UserDetail::class)->withDefault();
    }

    public function activationToken()
    {
        return $this->hasOne(ActivationToken::class);
    }

    public static function byEmail($email)
    {
        return static::where('email', $email);
    }

    public function employeeDetail()
    {
        return $this->hasMany(UserEmployee::class);
    }

    public function posts()
    {
        return $this->hasMany(UsersPost::class, 'user_id')
            ->orderBy('created_at', 'desc');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MyResetPassword($token));
    }

    public function userType($id)
    {
        $user = User::findORFail($id);

        if ('hire_individual' == $user->user_type) {
            return "Individual Consumers";
        } elseif ('real_estate_firm_companies' == $user->user_type) {
            return "Real Estate Firm/Companies";
        } elseif ('hire_organization' == $user->user_type) {
            return "Government Organizations";
        } elseif ('work_individual' == $user->user_type) {
            return "Individual";
        } elseif ('work_architecture_firm_companies' == $user->user_type) {
            return "Architecture Firm/Companies";
        } elseif ('work_architecture_organizations' == $user->user_type) {
            return "Architecture Organizations";
        } elseif ('work_architecture_college' == $user->user_type) {
            return "Architecture College";
        }
    }

    public function fullName()
    {
        if($this->first_name != null && $this->last_name != null)
        {
            $fullName = ucfirst($this->first_name) ." ". ucfirst($this->last_name);
        }
        elseif($this->name != null)
        {
            $fullName = ucfirst($this->name);
        }
        else
        {
            $fullName = null;
        }

        return $fullName;

    }



    /*work other detail*/
    public function usersDetail()
    {
        return $this->hasMany(UsersOtherDetail::class, 'user_id');
    }
    /*work other detail*/


    /*users professional details*/
    public function usersProfessionalDetail()
    {
        return $this->hasMany(UsersProfessionalDetail::class,'user_id');
    }

    /*users professional details*/

    public function usersEducationDetails()
    {
        return $this->hasMany(UsersEducationDetail::class, 'user_id');
    }

    /*follow*/



    public function following()
    {
        return $this->hasMany(FollowUser::class,'from_user');
    }

    public function follower()
    {
        return $this->hasMany(FollowUser::class,'to_user');
    }


    public function followingUser($viewUserId)
    {
        return FollowUser::where('from_user',Auth::id())->Where('to_user',$viewUserId)->first();


    }

    public function fullAddress()
    {
        if($this->userDetail->country_id != null && $this->userDetail->state_id != null && $this->userDetail->city_id != null )
        {
            return $this->userDetail->city->name .' , '.$this->userDetail->state->name .' , '. $this->userDetail->country->name;
        }
    }

    public function portfolio(){
        return $this->hasMany(Portfolio::class,'user_id');
    }

    public function portfolioCount(){
        return Portfolio::where("user_id",$this->id)->count();
    }

    public function blueprintCount(){
        return UsersPost::where("user_id",$this->id)->count();
    }

    public function verifyOtp()
    {
        return $this->hasOne(VerifyOtp::class,'user_id');
    }
    public function portfolioPost(){
        return $this->belongsToMany(UsersPost::class,"portfolio");
    }

    public function friendsOfMine(){
        return $this->belongsToMany('App\User','chat_friends','user_from','user_to');
    }

    public function friendOf(){
        return $this->belongsToMany('App\User','chat_friends','user_to','user_from');
    }

    public function friends(){
        return $this->friendsOfMine->merge($this->friendOf);
    }
    public function searchableAs()
    {
        return 'users_index';
    }

    public function getProfileUrlAttribute(){
        return  Storage::url($this->profile);
    }
}
