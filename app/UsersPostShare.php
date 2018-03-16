<?php
 
namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class UsersPostShare extends Model
{
    use SoftDeletes;
    protected $table = "users_post_share";

    protected $fillable = [
        'users_post_id',
        'user_id',
        'message',
        'is_shared'
    ];

    public function usersPost()
    {
        return $this->belongsTo(UsersPost::class,'users_post_id');
    }
    public function likes()
    {
        return $this->hasMany(Like::class,'likeable_id','shared_id')->where('likeable_type','=',"App\UsersPostShare");
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'commentable_id')->where('commentable_type','App\UsersPostShare')->orderBy('created_at','desc');
    }
    public function commentCount(){
        return $this->hasMany(Comment::class,'commentable_id','shared_id')->where('commentable_type','App\UsersPostShare')->selectRaw('count(id) as count');
    }
    public function commentsLimited()
    {
        return $this->hasMany(Comment::class,'commentable_id','shared_id')->where('commentable_type','App\UsersPostShare')->orderBy('created_at','desc');
    }

    public function sharedUser()
    {
        return $this->belongsTo(User::class,'shared_user');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    //Method to find that this is features or not
    public function isFeatured($post_id){
        $count = Portfolio::where("users_post_id",$post_id)
            ->where("user_id",Auth::id())
            ->count();

        if ($count > 0){
            return true;
        }else{
            return false;
        }
    }

    


}
