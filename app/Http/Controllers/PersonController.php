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
		if(!$id){
            return response()->json(['errors' => 'Person id is required.'], 403);
		}
		
		$person = Person::where('id', $id)->first();
	
		if(!$person){
            return response()->json(['errors' => 'Person not found.'], 403);
		}

		return $person;
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
		
		$person = Person::where('id', $request->id)->get();
		if(!$person){
			$person = new Person();
		}
		$person->id = $request->id;
		$person->name = $request->name;
		$person->sex = $request->sex;
		$person->age = $request->age;
		$person->save();
	    
	    return response()->json(['id' => $request->id]);
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
        if($request->persons){
            foreach ($request->persons as $responsePerson) {
                $person = new Person();
				$person->id =  $responsePerson->id;
				$person->name = $responsePerson->name;
				$person->sex = $responsePerson->sex;
				$person->age = $responsePerson->age;
				$person->save();
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
		if(!$id){
			return response()->json(['errors' => 'Person id is required.'], 403);
		}

		$person = Person::where('id', $id)->get();
		
        if(count($person) > 0){
            $person->destroy();
        }else{
            return response()->json(['errors' => 'Person not exist'], 403);
        }

        return response()->json(['Person ID' => $id]);
	}
}
