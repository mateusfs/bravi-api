<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $table = 'contact';
	protected $primaryKey = 'idContact';
	
	protected $fillable = [
			'idContact',
			'idPerson',
			'email',
			'phone',
			'cellphone'
	];
}


