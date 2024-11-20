<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserValidationCode extends Model
{
    protected $fillable = ['user_id', 'code', 'expired_at'];

    protected $primaryKey = 'user_id';

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
