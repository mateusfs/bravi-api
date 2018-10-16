<?php

namespace App\Http\Controllers;
use App\Person;
use Illuminate\Http\Request;

/**
 * @resource Person
 *
 */

class PersonController extends Controller
{
    /**
     * Buscar Person
     *
     * Buscar Person | Exemplo: api/v1/person/1
     * 
     * @param number $id
     * 
     * @return Person
     */
	public function get($id)
	{
		return Person::where('id', $id)->firstOrFail();
	}
	
	
	/**
	 * Save Person
	 *
	 * Save Person | Exemplo: api/v1/person/criar
	 * 
	 * @return void
	 */
	public function save(Request $request)
	{
	    return Person::create($request);
	}
	
	/**
	 * Save Persons
	 *
	 * Save Persons | Exemplo: api/v1/person/criar
	 *
	 * @return void
	 */
	public function savePersons(Request $request)
	{
		if($request){
			foreach ($request as $person) {
				return Person::updated($person);		
			}
		}
	}
	
	
	/**
	 * Remover Person
	 *
	 * Remover Person | Exemplo: api/v1/person/delete/1
	 * 
	 * @param number $id
	 * 
	 * @return int
	 */
	public function delete($id)
	{
	    return Person::destroy($id);
	}
}
