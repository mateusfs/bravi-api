<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Person;


/**
 * @resource Person
 *
 */

class PersonController extends Controller
{
    /**
     * Buscar Person
     *
     * Buscar Person | Exemplo: api/v1/person/id
     * 
     * @param number $id
     * 
     * @return Person
     */
	public function get($id)
	{
		if($id){
            return Person::where('id', $id)->firstOrFail();
        }else{
            return response()->json(['errors' => 'Person id is required.'], 403);
        }
	}
	
	
	/**
	 * Save Person
	 *
	 * Save Person | Exemplo: api/v1/person/save
	 * 
	 * @return void
	 */
	public function savePerson(Request $request)
	{
	    $request->validate([
	        'id' => 'required',
	        'name' => 'required',
	        'sex' => 'required',
	        'age' => 'required'
		]);
		
		$person = new Person($request->all());

		$personDB = Person::where('id', $request->id)->get();

		if($personDB){
			Person::update($person);
		}else{
			Person::create($person);
		}
	    
	    return response()->json(['id' => $person->id]);
	}
	
	/**
	 * Save Persons
	 *
	 * Save Persons | Exemplo: api/v1/person/savePersons
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
                    Person::create($person);
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
	 * Remover Person | Exemplo: api/v1/person/delete/1
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
