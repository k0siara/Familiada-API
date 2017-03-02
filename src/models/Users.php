<?php

use Illuminate\Database\Eloquent\Model as Model;

class Users extends Model {

	protected $table = 'users';

	public $timestamps = false;
	
	protected $casts = [
        'is_admin' => 'boolean',
        'voted' => 'boolean'
    ];

}