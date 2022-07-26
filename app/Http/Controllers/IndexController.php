<?php

namespace App\Http\Controllers;

use App\Models\BuyerRequest;
use App\Models\Category;
use App\Models\Contact;
use App\Models\ContactUs;
use App\Models\Item;
use App\Models\Tenant;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->item = new Item();
        $this->category = new Category();
        $this->buyerrequest = new BuyerRequest();
        $this->contactus = new ContactUs();
        $this->tenant = new Tenant();
    }

    public function index(){
        return view('frontend.index',[
            'items'=>$this->item->getItemsAtRandom()
        ]);
    }

    public function marketplace(){

        return view('frontend.marketplace',[
            'items'=>$this->item->getItemsAtRandom(),
            'categories'=>$this->category->getAllGeneralCategories(),
            'vendors'=>$this->tenant->getAllActiveRegisteredTenants()
        ]);
    }

    public function viewItem($slug){
        $item = $this->item->getItemBySlug($slug);
        if(!empty($item)){
            return view('frontend.view-item',['item'=>$item,
                'categories'=>$this->category->getAllGeneralCategories(),]);
        }else{
            return back();
        }
    }

    public function vendorStore($slug){
        $vendor = $this->tenant->getTenantBySlug($slug);

        if(!empty($vendor)){
            $items = $this->item->getAllTenantItems($vendor->id);
            return view('frontend.vendor-store',[
                'tenant'=>$vendor,
                'items'=>$items,
                'categories'=>$this->category->getAllGeneralCategories(),
                'vendors'=>$this->tenant->getAllActiveRegisteredTenants()
                ]);
        }else{
            return back();
        }
    }

    public function productCategories($slug){
        $category = $this->category->getCategoryBySlug($slug);
        if(!empty($category)){
            $items = $this->item->getItemsByCategoryId($category->id);
            return view('frontend.product-category',['items'=>$items,
                'categories'=>$this->category->getAllGeneralCategories(),
                'vendors'=>$this->tenant->getAllActiveRegisteredTenants(),
                'category'=>$category]);
        }else{
            return back();
        }
    }


    public function searchProduct(Request $request){
        $this->validate($request,[
            'keyword'=>'required'
        ]);
            $items = $this->item->searchForProduct($request->keyword);
            return view('frontend.search-product',[
                'items'=>$items,
                'categories'=>$this->category->getAllGeneralCategories(),
                'vendors'=>$this->tenant->getAllActiveRegisteredTenants(),
                'keyword'=>$request->keyword
               ]);
    }

    public function contactUs(){
        return view('frontend.contact-us');
    }

    public function buyerRequest(Request $request){
        $this->validate($request,[
            'item'=>'required',
            'first_name'=>'required',
            'email'=>'required|email',
            'mobile_no'=>'required',
            'message'=>'required'
        ],[
            'first_name.required'=>'Enter your first name',
            'email.required'=>'Enter your email address',
            'email.email'=>'Enter a valid email address',
            'mobile.required'=>'Enter your mobile number',
            'message.required'=>'Type your message in the field provided',
        ]);

        $item = $this->item->getItemById($request->item);
        if(!empty($item)){
            $this->buyerrequest->setNewBuyerRequest($request, $item->tenant_id);
            session()->flash("success", "Your request was submitted successfully.");
            return back();
        }else{
            return back();
        }
    }

    public function saveContactUs(Request $request){
        $this->validate($request,[
            'first_name'=>'required',
            'email'=>'required|email',
            'subject'=>'required',
            'mobile_no'=>'required',
            'message'=>'required'
        ],[
            'first_name.required'=>'Enter your first name',
            'email.required'=>'Enter your email address',
            'email.email'=>'Enter a valid email address',
            'mobile_no.required'=>'Enter mobile no.',
            'message.required'=>'Help us understand your concerns. Type your message.'
        ]);
        $this->contactus->setNewContactUs($request);
        session()->flash("success", "<strong>Thank you!</strong> Your message was sent successfully. You'll hear from us soonest.");
        return back();
    }
}
