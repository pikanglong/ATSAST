<?php

namespace App\Models\Eloquents;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $table = 'instructor';
    protected $primaryKey = 'iid';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User','uid','id');
    }
}