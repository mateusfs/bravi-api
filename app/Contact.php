<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $table = 'contact';
	protected $primaryKey = 'id_contact';
	public $timestamps = false;

	protected $fillable = [
			'id',
			'person',
			'email',
			'phone',
			'cellphone'
	];
}


