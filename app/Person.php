<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
	protected $table = 'person';
	protected $primaryKey = 'id_person';
	public $timestamps = false;
	
	protected $fillable = [
			'id',
			'name',
			'sex',
			'age',
	];
}
