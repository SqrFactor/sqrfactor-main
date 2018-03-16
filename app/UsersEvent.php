<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class UsersEvent extends Model
{

    protected $table = "users_event";

    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at','desc');
    }

    public function eventsImage()
    {
       return $this->hasMany('App\EventsImage','users_event_id');
    }
}
