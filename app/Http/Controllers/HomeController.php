<?php

namespace App\Http\Controllers;

use App\Models\Grant;
use App\Models\Training;
use App\Models\TrainingCategory;
use App\Models\TrainingFeedback;
use App\Models\TrainingFeedbackReply;
use Illuminate\Http\Request;

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
    public function index()
    {
        return view('home');
    }
}
