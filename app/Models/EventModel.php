<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventModel extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = ['name','place','organizer','phone','description','starts','ends','logo','user_id'];
}
