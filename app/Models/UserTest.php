<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTest extends Model
{
    use HasFactory;
    protected $table = 'user_test';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'user_id',
        'status',
        'position',        
    ];

}

