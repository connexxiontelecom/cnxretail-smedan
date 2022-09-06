<?php

namespace App\Http\Controllers;

use App\Models\MailchimpSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use MailchimpMarketing\ApiClient;

class MailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->mailchimpsetting = new MailchimpSettings();
    }

    public function mailChimpConfig(){
        $setting = $this->mailchimpsetting->getTenantMailChimpFirstApiKey();
        if(!empty($setting)) {
            $mailchimp = new ApiClient();
            $server = substr($setting->mailchimp_api_key, 33);
            $mailchimp->setConfig([
                'apiKey' => $setting->mailchimp_api_key,
                'server' => $server
            ]);
            return $mailchimp;
        }else{
            return $mailchimp = new \stdClass();
        }
    }

    public function manageCampaigns(){
        $mailchimp = $this->mailChimpConfig();
        if((array)$mailchimp){

            try {
                $response = $mailchimp->ping->get();
                if(!empty($response)){
                    $request = $mailchimp->campaigns->list();
                    return view('campaign.manage-campaigns',['request'=>$request]);
                }else{
                    session()->flash("error","Whoops! We couldn't establish connection to the remote server. Try again.");
                    return back();
                }
            }catch (\Exception $ex){
                session()->flash("error", "Whoops! We couldn't establish connection to the remote server. Try again.");
                return back();
            }
        }else{
            session()->flash("error", "Ensure your mailchimp settings (API) is properly set and try again.");
            return redirect()->route('app-settings');
        }

    }

    public function viewCampaign(Request $request){
        $mailchimp = $this->mailChimpConfig();
        if((array)$mailchimp){
            try {
                $response = $mailchimp->campaigns->get($request->web_id);
                //return $response->settings->subject_line;
                //return $response;
                return view('campaign.view-campaign',['campaign'=>$response]);
            }catch (\Exception $ex){
                session()->flash("error", "Whoops! We couldn't establish connection to the remote server. Try again.");
                return back();
            }
        }
    }

    public function manageAudiences(){
        $mailchimp = $this->mailChimpConfig();
        if((array)$mailchimp){

            try {
                $response = $mailchimp->ping->get();
                if(!empty($response)){
                    $audiences = $mailchimp->lists->getAllLists();
                    //return $audiences->lists;
                    return view('campaign.manage-audiences',['audiences'=>$audiences]);
                }else{
                    session()->flash("error","Whoops! We couldn't establish connection to the remote server. Try again.");
                    return back();
                }
            }catch (\Exception $ex){
                session()->flash("error", "Whoops! We couldn't establish connection to the remote server. Try again.");
                return back();
            }
        }else{
            session()->flash("error", "Ensure your mailchimp settings (API) is properly set and try again.");
            return redirect()->route('app-settings');
        }
    }

    public function viewAudience(Request $request){
        $mailchimp = $this->mailChimpConfig();
        if((array)$mailchimp){
            try {
                $response = $mailchimp->lists->getList($request->id);
                //return $response;
                return view('campaign.view-audience',['audience'=>$response]);
            }catch (\Exception $ex){
                session()->flash("error", "Whoops! We couldn't establish connection to the remote server. Try again.");
                return back();
            }
        }
    }

    public function showAddNewAudienceForm(){
        return view('campaign.add-new-audience');
    }
}
