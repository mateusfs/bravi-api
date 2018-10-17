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
     * Buscar Person | Exemplo: api/v1/public/person/id
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
	 * Save Person | Exemplo: api/v1/public/person/save
	 * 
	 * @return void
	 */
	public function save(Request $request)
	{
	    
	    $request->validate([
	        'id' => 'required',
	        'name' => 'required',
	        'sex' => 'required',
	        'age' => 'required'
	    ]);
	    
	    $person = new Person($request->all());
	    $person->save();
	    
	    return response()->json(['id' => $person->id]);
	}
	
	/**
	 * Save Persons
	 *
	 * Save Persons | Exemplo: api/v1/public/person/savePersons
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

        if($request->persons){
            foreach ($request->persons as $person) {
                $personDB = Person::where('id', $person->id)->firstOrFail();
                if($personDB){
                    Person::update($personDB);
                }else{
                    Person::save($person);
                }
            }
        }else{
            return response()->json(['errors' => 'Person Sync Fail'], 403);
        }

        return response()->json(['Person Sync' => 'OK']);
	}
	
	
	/**
	 * Remover Person
	 *
	 * Remover Person | Exemplo: api/v1/public/person/delete/1
	 * 
	 * @param number $id
	 * 
	 * @return int
	 */
	public function delete($id)
	{
        $contact = Person::where('id', $id)->firstOrFail();
        if($contact){
            Person::delete($contact);
        }else{
            return response()->json(['errors' => 'Person not exist'], 403);
        }

        return response()->json(['Person ID' => id]);
	}
}
