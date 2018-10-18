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
     * Get Contact | Exemplo: api/v1/contact/id
     * 
     * @param number $id
     */
	public function get($id)
	{
		if(!$id){
            return response()->json(['errors' => 'Contact id is required.'], 403);
		}
		
		$contact = Contact::find($id);
	
		if(!$contact){
            return response()->json(['errors' => 'Contact not found.'], 403);
		}

		return $contact;
	}
	
	/**
	 * Save Contact
	 *
	 * Save Contact | Exemplo: api/v1/contact/save
	 *
	 * @return void
	 */
	public function saveContact(Request $request)
	{
	    $request->validate([
	        'id' => 'required',
	        'person' => 'required',
	        'email' => 'required'
	    ]);
	    
	    $contact = Contact::find($request->id);
	    if(!$contact){
	        $contact = new Contact();
	        $contact->id_contact = $request->id;
	        $contact->id = $request->id;
	    }
	    $contact->person = $request->person;
	    $contact->email = $request->email;
	    $contact->phone = $request->phone;
	    $contact->cellphone = $request->cellphone;
	    $contact->save();
	    
	    return response()->json(['id' => $request->id]);
	}

	/**
	 * Save Contacts
	 *
	 * Save Contacts | Exemplo: api/v1/contact/saveContacts
	 *
	 * @return void
	 */
	public function saveContacts(Request $request)
	{
		if($request->contacts){
			foreach ($request->contacts as $responseContact) {
				$contact = Contact::find($request->id);
				if(!$contact){
				    $contact = new Contact();
				    $contact->id_contact = $responseContact['id'];
				    $contact->id = $responseContact['id'];
				}
				$contact->person = $responseContact['person'];
				$contact->email = $responseContact['email'];
				$contact->phone = $responseContact['phone'];
				$contact->cellphone = $responseContact['cellphone'];
				$contact->save();
			}
		}else{
            return response()->json(['errors' => 'Contact Sync Fail'], 403);
        }

        return response()->json(['Contact Sync' => 'OK']);
	}
	
	
	/**
	 * Destroy Contact
	 *
	 * Destroy Contact | Exemplo: api/v1/contact/delete/1
	 *
	 * @param number $id
	 * 
	 * @return int
	 */
	public function delete($id)
	{
		if(!$id){
			return response()->json(['errors' => 'Contact id is required.'], 403);
		}

		$contact = Contact::find($id);

		if($contact){
		    Contact::destroy($id);
        }else{
            return response()->json(['errors' => 'Contact not exist'], 403);
        }

        return response()->json(['Contact ID' => $id]);
	}
	
	/**
	 * Retive Contacts
	 *
	 * Retive Contacts | Exemplo: api/v1/contact/all
	 *
	 *
	 * @return Contacts
	 */
	public function retriveContacts(){
	    return Contact::all();
	}
}
