<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Conversation;
use App\Models\Reminder;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->contact = new Contact();
        $this->conversation = new Conversation();
        $this->reminder = new Reminder();
    }

    public function allContacts(){
        return view('contacts.index');
    }

    public function allLeads(){
        return view('contacts.index');
    }

    public function allDeals(){
        return view('contacts.index');
    }

    public function showAddNewContactForm(){
        return view('contacts.add-new-contact');
    }

    public function saveContact(Request $request){
        $this->validate($request,[
           'company_name'=>'required',
           'company_phone_no'=>'required',
           'company_email'=>'required',
           //'website'=>'required',
           'address'=>'required',
           'first_name'=>'required',
           'phone_no'=>'required',
           'last_name'=>'required',
           'email'=>'required',
           //'position'=>'required',
        ],[
            'company_name.required'=>'Enter company name',
            'company_phone_no.required'=>'Enter company phone number',
            'company_email.required'=>'Enter a valid company email address',
            'address.required'=>'Enter the company office address',
            'first_name.required'=>'Enter contact person first name',
            'phone_no.required'=>'Enter contact person phone number',
            'last_name.required'=>'Enter contact person last name',
            'email.required'=>'Enter a valid email address for the contact person'
        ]);
        $this->contact->setNewContact($request);
        session()->flash("success", "Your new contact was registered successfully.");
        return back();
    }


    public function viewContact(Request $request){
        $contact = $this->contact->getContactBySlug($request->slug);
        if(!empty($contact)){
            return view('contacts.view',['contact'=>$contact]);
        }else{
            session()->flash("error", "Whoops! Record not found");
            return back();
        }
    }


    public function showEditContactForm(Request $request){
        $contact = $this->contact->getContactBySlug($request->slug);
        if(!empty($contact)){
            return view('contacts.edit-contact',['contact'=>$contact]);
        }else{
            session()->flash("error", "No record found.");
            return back();
        }
    }

    public function editContact(Request $request){
        $this->validate($request,[
            'company_name'=>'required',
            'company_phone_no'=>'required',
            'company_email'=>'required',
            'address'=>'required',
            'first_name'=>'required',
            'phone_no'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'contact'=>'required'
        ],[
            'company_name.required'=>'Enter company name',
            'company_phone_no.required'=>'Enter company phone number',
            'company_email.required'=>'Enter a valid company email address',
            'address.required'=>'Enter the company office address',
            'first_name.required'=>'Enter contact person first name',
            'phone_no.required'=>'Enter contact person phone number',
            'last_name.required'=>'Enter contact person last name',
            'email.required'=>'Enter a valid email address for the contact person'
        ]);
        $this->contact->updateContact($request);
        session()->flash("success", "Your changes were saved successfully.");
        return back();
    }

    public function newConversation(Request $request){
        $this->validate($request,[
            'subject'=>'required',
            'conversation'=>'required',
            'contact_id'=>'required',
            //'remind_at'=>'required|date'
        ],[
            'subject.required'=>'Enter a subject for this conversation',
            'conversation.required'=>'What was the conversation about?',
            //'remind_at.required'=>"This field is required"
        ]);
        $this->conversation->setNewConversation($request);
        #Set reminder
        if(!empty($request->remind_at)){
            $color = $this->reminder->generateRandomColorString();
            $this->reminder->setNewReminder($request->subject, $request->conversation, $request->remind_at, $color, 2);
        }
        #Upgrade contact to lead
            $contact = $this->contact->getContactById($request->contact_id);
        if(!empty($contact)){
            if($contact->contact_type == 0){
                $contact->contact_type = 1; //i.e lead
                $contact->save();
            }
        }
        session()->flash("success", "Your conversation was recorded.");
        return back();
    }
}
