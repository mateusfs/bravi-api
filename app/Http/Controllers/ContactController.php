<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

/**
 * @resource Contact
 *
 */
class ContactController extends Controller
{
    /**
     * Get Contact
     *
     * Get Contact | Exemplo: api/v1/contact/1
     * 
     * @param number $id
     */
	public function get($id)
	{
		return Contact::where('pgm_id', $id)->firstOrFail();
	}
	
	/**
	 * Save Contact
	 *
	 * Save Contact | Exemplo: api/v1/contact/save
	 *
	 * @return void
	 */
	public function save(Request $request)
	{
	    $request->validate([
	        'id' => 'required',
	        'person' => 'required',
	        'email' => 'required'
	    ]);
	    
	    $contact = new Contact($request->all());
	    $contact->save();
	    
	    return response()->json(['id' => $contact->id]);
	}
	
	
	/**
	 * Save Contacts
	 *
	 * Save Contacts | Exemplo: api/v1/contact/criar
	 *
	 * @return void
	 */
	public function saveContacts(Request $request)
	{
		if($request){
			foreach ($request as $contact) {
			    return Contact::save($contact);		
			}
		}
	}
	
	
	/**
	 * Delete Contact
	 *
	 * Delete Contact | Exemplo: api/v1/contact/delete/1
	 *
	 * @param number $id
	 * 
	 * @return int
	 */
	public function delete($id)
	{
	    return Contact::destroy($id);
	}
}
