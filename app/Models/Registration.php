<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    protected $fillable = ['event_id', 'user_name','user_surname','user_email','user_phone','user_message','status'];
//    public function events()
//    {
////        return $this->belongsTo(EventModel::class, 'event_models_id');
//        return $this->belongsTo(EventModel::class, 'event_models_id');
////    }
//    public function eventsAdd()
//    {
//        return $this->belongsTo(EventModel::class);
//    }
}


