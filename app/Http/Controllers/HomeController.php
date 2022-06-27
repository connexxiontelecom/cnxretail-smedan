<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Grant;
use App\Models\Survey;
use App\Models\SurveyResponse;
use App\Models\Training;
use App\Models\TrainingCategory;
use App\Models\TrainingFeedback;
use App\Models\TrainingFeedbackReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendSurveyMail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->training = new Training();
        $this->grant = new Grant();
        $this->trainingfeedback = new TrainingFeedback();
        $this->trainingfeedbackreply = new TrainingFeedbackReply();
        $this->trainingcategory = new TrainingCategory();
        $this->survey = new Survey();
        $this->surveyresponse = new SurveyResponse();
        $this->contact = new Contact();
    }

    public function viewTraining($slug){
        $training = $this->training->getTrainingBySlug($slug);
        if(!empty($training)){
            return view('sme.training-details',['training'=>$training]);
        }else{
            session()->flash("error", "No record found.");
            return back();
        }
    }

    public function listGrants(){
        return view('sme.grants',['grants'=>$this->grant->getAllGrants()]);
    }

    public function listSurveys(){
        return view('sme.surveys',['surveys'=>$this->survey->getAllActiveSurveys()]);
    }
    public function surveyDetails($slug){
        $survey = $this->survey->getSurveyBySlug($slug);
        if(!empty($survey)){
            return view('sme.survey-details',
                [
                    'survey'=>$survey,
                    'contacts'=>$this->contact->getTenantContacts(Auth::user()->tenant_id)
                ]);
        }else{
            session()->flash("error", "No record found.");
            return back();
        }
    }
    public function viewGrant($slug){
        $grant = $this->grant->getGrantBySlug($slug);
        if(!empty($grant)){
            return view('sme.grant-details',['grant'=>$grant]);
        }else{
            session()->flash("error", "No record found.");
            return back();
        }
    }
    public function listTrainings(){
        return view('sme.trainings',['trainings'=>$this->training->getAllTrainings()]);
    }

    public function leaveCommentOnTraining(Request $request){
        $this->validate($request,[
            'comment'=>'required',
            'userLevel'=>'required',
            'commentTrainingId'=>'required'
        ],[
            'comment.required'=>'Leave comment in the box provided.'
        ]);
        $this->trainingfeedback->newFeedback($request);
        session()->flash("success", "Your comment was recorded.");
        return back();
    }

    public function leaveReplyOnComment(Request $request){

        $this->validate($request,[
            'innerConversation'=>'required',
            //'userLevel'=>'required',
            'innerTrainingId'=>'required',
            'innerCommentId'=>'required'
        ],[
            'innerConversation.required'=>'Leave comment in the box provided.'
        ]);
        $this->trainingfeedbackreply->addTrainingFeedbackReply($request);
        session()->flash("success", "Your reply was recorded.");
        return back();
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function shareSurvey(Request $request)
    {
        if(isset($request->allContacts) && $request->allContacts != 1){
            $this->validate($request,[
                'clients'=>'required|array',
                'clients.*'=>'required',
                'surveyId'=>'required'
            ]);
        }
        $survey = $this->survey->getSurveyById($request->surveyId);
        foreach($request->clients as $clientId){
            #Send mail
            $client = $this->contact->getContactById($clientId);
            try{
                \Mail::to($client->company_email)->send(new SendSurveyMail($client, $survey) );

            }catch (\Exception $ex){
                session()->flash("error", "<strong>Whoops!</strong> We had issues sending out this survey. Try again later".$ex);
                return back();
            }
        }
        session()->flash("success", "<strong>Great!</strong> Survey shared with your contacts.");
        return back();
    }
}
