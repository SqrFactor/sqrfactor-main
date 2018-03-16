<?php
 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $table = "portfolio";


 public function usersPostShare()
    {
        return $this->belongsTo(UsersPostShare::class,'users_post_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    
}

  



