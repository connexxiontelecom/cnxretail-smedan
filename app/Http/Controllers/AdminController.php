<?php

namespace App\Http\Controllers;

use App\Models\AdminNotification;
use App\Models\AdminUser;
use App\Models\BusinessCategory;
use App\Models\DailyMotivation;
use App\Models\Grant;
use App\Models\GrantMaterial;
use App\Models\Pricing;
use App\Models\Subscription;
use App\Models\Tenant;
use App\Models\TenantNotification;
use App\Models\Training;
use App\Models\TrainingMaterial;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Newsletter\NewsletterFacade as Newsletter;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->adminuser = new AdminUser();
        $this->tenant = new Tenant();
        $this->subscription = new Subscription();
        $this->pricing = new Pricing();
        $this->dailymotivation = new DailyMotivation();
        $this->adminnotification = new AdminNotification();
        $this->user = new User();
        $this->training = new Training();
        $this->trainingmaterial = new TrainingMaterial();
        $this->tenantnofitication = new TenantNotification();
        $this->grant = new Grant();
        $this->grantmaterial = new GrantMaterial();
        $this->businesscategory = new BusinessCategory();
    }

    public function notification(){
        return view('admin.notifications',['notifications'=>$this->adminnotification->getNotifications()]);
    }

    public function adminDashboard(){
        return view('admin.admin-dashboard',[
            'tenants'=>$this->tenant->getAllRegisteredTenants(),
            'thismonth'=>$this->tenant->getAllRegisteredTenantsThisMonth()
        ]);
    }

    public function showAddNewUserForm(){
        return view('admin.add-new-admin');
    }

    public function storeAdminUser(Request $request){
        $this->validate($request,[
            'full_name'=>'required',
            'email'=>'required|email|unique:admin_users,email',
            'mobile_no'=>'required',
            'password'=>'required'
        ],[
            'full_name.required'=>'Enter user full name',
            'email.required'=>'Enter a valid email address',
            'email.email'=>'Enter a valid email address',
            'email.unique'=>'This email address is already in use',
            'mobile_no.required'=>'Enter user mobile number',
            'password.required'=>'Choose password for user',
            //'password.confirmed'=>'Password'
        ]);
        $this->adminuser->createNewAdminUser($request);
        session()->flash("success","Your action was registered successfully.");
        return back();
    }

    public function showAddNewTenantForm(){
        return view('admin.add-new-tenant',['categories'=>$this->businesscategory->getBusinessCategories()]);
    }

    public function addNewTenant(Request $request){
        $this->validate($request,[
            'company_name'=>'required',
            'full_name'=>'required',
            'email'=>'required|email|unique:users,email',
            'office_address'=>'required',
            'address'=>'required',
            'rc_no'=>'required|unique:tenants,rc_no',
            'business_category'=>'required',
            'nin'=>'required',
            'phone_no'=>'required'

            //'password'=>'required|confirmed',
            //'terms'=>'required'
        ],[
            'company_name.required'=>'Enter your company name',
            'full_name.required'=>'Enter your first name',
            'email.required'=>'Enter a valid email address',
            'email.email'=>'Enter a valid email address',
            'email.unique'=>'Whoops! Another account exists with this email',
            'nin.required'=>'Enter your NIN number here',
            'phone_no.required'=>'Enter your phone number',
            'rc_no.required'=>'Enter your CAC RC No.',
            'rc_no.unique'=>'A business is already associated with this RC No.',
            'business_category.required'=>'Select business category',
            'address.required'=>'Enter your address in field provided',
            'office_address.required'=>'Where is your business situated?'
            //'password.required'=>'Choose a password',
            //'password.confirmed'=>'Your chosen password does not match re-type password',
            //'terms.required'=>'Accept our terms & conditions to continue with this registration'
        ]);
        $tenant = $this->tenant->setNewTenant($request);
        $this->user->setNewUser($request, $tenant);
        #Notification
        $subject = "New registration";
        $body = "There's a new registration to CNX Retail. Kindly check it out.";
        $this->adminnotification->setNewAdminNotification($subject, $body, 'view-tenant', $tenant->slug, 1, 0);
        #Mailchimp welcome email
        try {
            if ( ! Newsletter::isSubscribed($request->email) ) {
                Newsletter::subscribe($request->email);
                Newsletter::subscribe($request->email, ['FNAME'=>$request->first_name]);
            }
        }catch (\Exception $exception){

        }
        session()->flash("success", "New business registered.");
        return back();
    }

    public function manageTenants(){
        return view('admin.manage-tenants',['tenants'=>$this->tenant->getAllRegisteredTenants()]);
    }

    public function viewTenant($slug){
        $tenant = $this->tenant->getTenantBySlug($slug);
        if(!empty($tenant)){
            return view('admin.view-tenant', ['tenant'=>$tenant]);
        }else{
            session()->flash("error", "No record found.");
            return back();
        }
    }

    public function getTenantSubscriptions(){
        return view('admin.subscription',['subscriptions'=>$this->subscription->getTenantSubscriptions()]);
    }

    public function managePricing(){
        return view('admin.manage-pricing',['pricings'=>$this->pricing->getAllPricing()]);
    }

    public function addPricing(Request $request){
        $this->validate($request,[
            'name'=>'required|unique:pricings,price_name',
            'amount'=>'required',
            'duration'=>'required'
        ],[
            'name.required'=>'Enter price name',
            'name.unique'=>'Enter a unique price name',
            'amount.required'=>'Enter amount',
            'duration.required'=>'Enter duration for this pricing plan'
        ]);
        $this->pricing->setNewPricing($request);
        session()->flash("success", "New pricing plan added successfully");
        return back();
    }

    public function editPricing(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'amount'=>'required',
            'duration'=>'required',
            'price'=>'required'
        ],[
            'name.required'=>'Enter price name',
            'amount.required'=>'Enter amount',
            'duration.required'=>'Enter duration for this pricing plan'
        ]);
        $this->pricing->editPricing($request);
        session()->flash("success", "Your changes were saved successfully");
        return back();
    }

    public function manageDailyMotivations(){
        return view('admin.manage-daily-motivation',['motivations'=>$this->dailymotivation->getAllDailyMotivations()]);
    }

    public function addDailyMotivation(Request $request){
        $this->validate($request,[
            'time'=>'required',
            'author'=>'required',
            'motivation'=>'required'
        ],[
            'time.required'=>'Select time of day',
            'author.required'=>'Enter the name of the author or type Unknown',
            'motivation.required'=>'Enter motivation here...'
        ]);
        $this->dailymotivation->setNewDailyMotivation($request);
        session()->flash("success", "Daily motivation added successfully.");
        return back();
    }
    public function updateDailyMotivation(Request $request){
        $this->validate($request,[
            'time'=>'required',
            'author'=>'required',
            'motivation'=>'required'
        ],[
            'time.required'=>'Select time of day',
            'author.required'=>'Enter the name of the author or type Unknown',
            'motivation.required'=>'Enter motivation here...'
        ]);
        $this->dailymotivation->editDailyMotivation($request);
        session()->flash("success", "Your changes were saved.");
        return back();
    }

    public function manageAdminUsers(){
        return view('admin.manage-admin-users',['users'=>$this->adminuser->getAllAdminUsers()]);
    }

    public function updateAccountStatus(Request $request){
        $this->validate($request, [
            'tenantId'=>'required',
            'actionType'=>'required'
        ]);
        $tenant = $this->tenant->getTenantById($request->tenantId);
        if(!empty($tenant)){
            $update = $this->tenant->updateTenantAccountStatus($request);
            session()->flash("success", "Account status updated!");
            return back();
        }else{
            session()->flash("error", "Whoops! No record found. Try again.");
            return back();
        }
    }


    public function showSMETrainings(){
        return view('admin.trainings', ['trainings'=>$this->training->getAllTrainings()]);
    }

    public function showNewTrainingForm(){
        return view('admin.add-new-training');
    }

    public function publishTraining(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'description'=>'required'
        ],[
            'title.required'=>'Enter a title for this training',
            'description.required'=>'Enter a brief description of the training'
        ]);
        $training = $this->training->addNewTraining($request);
        //Notify businesses
        $tenants = $this->tenant->getAllActiveRegisteredTenants();
        foreach($tenants as $tenant){
            //$subject, $body, $route_name, $route_param, $route_type, $user_id
            $title = 'New Training: '.$training->title;
            $body = substr(strip_tags($training->description),0,57);
            $this->tenantnofitication->setNewAdminNotification($title, $body, 'view-training',
                $training->slug, 1, $tenant->id);
        }
        if($request->hasFile('attachments')){
            $this->trainingmaterial->uploadTrainingMaterials($training->id, $request);
        }
        session()->flash("success", "Training published.");
        return redirect()->route('show-trainings');
    }

    public function  showTrainingDetails($slug){
        $training = $this->training->getTrainingBySlug($slug);
        if(!empty($training)){
            return view("admin.training-details", ['training'=>$training]);
        }else{
            session()->flash("error", "No record found.");
            return back();
        }
    }

    public function downloadTrainingMaterial($file_name){
        try{
            return $this->trainingmaterial->downloadFile($file_name);
            session()->flash("success", "Processing request...");
            return back();
        }catch (\Exception $ex){
            session()->flash("error", "Ooops! File does not exist.");
            return back();
        }

    }

    public function showSMEGrants(){
        return view('admin.grants', ['grants'=>$this->grant->getAllGrants()]);
    }

    public function showNewGrantForm(){
        return view('admin.add-new-grant');
    }

    public function publishGrant(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'description'=>'required'
        ],[
            'title.required'=>'Enter a title for this training',
            'description.required'=>'Enter a brief description of the training'
        ]);
        $grant = $this->grant->addNewGrant($request);
        //Notify businesses
        $tenants = $this->tenant->getAllActiveRegisteredTenants();
        foreach($tenants as $tenant){
            //$subject, $body, $route_name, $route_param, $route_type, $user_id
            $title = 'New Grant: '.$grant->title;
            $body = substr(strip_tags($grant->description),0,57);
            $this->tenantnofitication->setNewAdminNotification($title, $body, 'view-grant',
                $grant->slug, 1, $tenant->id);
        }
        if($request->hasFile('attachments')){
            $this->grantmaterial->uploadGrantMaterials($grant->id, $request);
        }
        session()->flash("success", "Grant published.");
        return redirect()->route('show-grants');
    }

    public function  showGrantDetails($slug){
        $grant = $this->grant->getGrantBySlug($slug);
        if(!empty($grant)){
            return view("admin.grant-details", ['grant'=>$grant]);
        }else{
            session()->flash("error", "No record found.");
            return back();
        }
    }

    public function downloadGrantMaterial($file_name){
        try{
            return $this->grantmaterial->downloadFile($file_name);
            session()->flash("success", "Processing request...");
            return back();
        }catch (\Exception $ex){
            session()->flash("error", "Ooops! File does not exist.");
            return back();
        }

    }


    public function showBusinessCategories(){
        return view('admin.business-categories',['categories'=>$this->businesscategory->getBusinessCategories()]);
    }

    public function addNewBusinessCategory(Request $request){
        $this->validate($request,[
            'category_name'=>'required|unique:business_categories,category_name'
        ],[
            'category_name.required'=>'Enter business category name',
            'category_name.unique'=>'Business category already exist. Choose another one'

        ]);
        $this->businesscategory->addNewBusinessCategory($request);
        session()->flash("success", "New business category published.");
        return back();
    }

    public function updateBusinessCategory(Request $request){
        $this->validate($request,[
            'category_name'=>'required|unique:business_categories,category_name',
            'categoryId'=>'required'
        ],[
            'category_name.required'=>'Enter business category name',
            'category_name.unique'=>'Business category already exist. Choose another one'

        ]);
        $this->businesscategory->updateBusinessCategory($request);
        session()->flash("success", "Your changes were saved.");
        return back();
    }

}
