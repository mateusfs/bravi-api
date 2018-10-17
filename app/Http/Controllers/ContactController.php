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
     * Get Contact | Exemplo: api/v1/public/contact/id
     * 
     * @param number $id
     */
	public function get($id)
	{
		if($id){
            return Contact::where('id', $id)->firstOrFail();
        }else{
            return response()->json(['errors' => 'Contact id is required.'], 403);
        }
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
	    
	    $contact = new Contact($request->all());
		$contact->save();
		
		$contact = new Contact($request->all());
		
		$contactDB = Contact::where('id', $request->id)->firstOrFail();

		if($contactDB){
			Contact::update($contact);
		}else{
			Contact::create($contact);
		}
	    
	    return response()->json(['id' => $contact->id]);
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
			foreach ($request->contacts as $contact) {
                $contactDB = Contact::where('id', $contact->id)->firstOrFail();
                if($contactDB){
                    Contact::update($contactDB);
                }else{
                    Contact::save($contact);
                }
			}
		}else{
            return response()->json(['errors' => 'Contact Sync Fail'], 403);
        }

        return response()->json(['Contact Sync' => 'OK']);
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
        $contact = Contact::where('id', $id)->firstOrFail();
        if($contact){
	        Contact::delete($contact);
        }else{
            return response()->json(['errors' => 'Contact not exist'], 403);
        }

        return response()->json(['Contact ID' => id]);
	}
}
