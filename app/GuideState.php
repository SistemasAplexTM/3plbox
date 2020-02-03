<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuideState extends Model
{
    protected $fillable = ['observation', 'date', 'guide_id', 'state_id', 'user_id'];
}
