<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class UsersPost extends Model
{
    use SoftDeletes; 
    protected $table = "users_post";

    protected $guarded = ['id'];

//    Protected $fillable = [
//        "slug",
//        "user_id",
//        "type",
//        "description",
//        "slug",
//        "slug",
//        "image",
//        "title",
//        "banner_image",
//        "short_description"
//    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeLatestFirst()
    {
        return $this->orderBy('created_at','desc');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    /*
     * Relation to get design detail
     * */
    public function designDetail(){
        //only build relation when its type is design
        if ($this->type == "design"){
            return $this->hasOne(UsersPostDesign::class,"user_post_id");
        }else{
            return null;
        }
    }


    public function likes()
    {
        return $this->morphMany(Like::class,'likeable');
    }

    public function portfolio()
    {
        return $this->hasOne(Portfolio::class,'users_post_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class,'commentable' , 'commentable_type','commentable_id',"shared_id")->orderBy('created_at','desc');
    }

    public function commentsLimited()
    {
        return $this->morphMany(Comment::class,'commentable')->orderBy('created_at','desc')->limit(2);
    }

    public function commentCount(){
        return $this->morphMany(Comment::class,'commentable')->selectRaw('count(id) as count');
    }

    public function isThisLike($likeable_id)
    {

       return Like::where('user_id',Auth::id())->where('likeable_id',$likeable_id)->first();
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

    public function usersPostShare()
    {
        return $this->hasOne(UsersPostShare::class,'users_post_id')->where('user_id',Auth::id())->where('is_shared','y');
    }

    public function usersPostShareMany()
    {
        return $this->hasMany(UsersPostShare::class,'users_post_id');
    }
}
