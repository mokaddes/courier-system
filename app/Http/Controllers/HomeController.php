<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Seo;
use App\Models\City;
use App\Models\User;
use App\Models\Region;
use App\Models\Weight;
use App\Models\Contact;
use App\Models\Pricing;
use App\Models\Franchise;
use App\Models\CustomPage;
use App\Models\OurService;
use App\Models\PageContent;
use App\Models\PricingGroup;
use Illuminate\Http\Request;
use App\Models\PickupRequest;
use App\Mail\ContactMailAdmin;
use App\Models\EcommerceService;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {

        // $deliverymanId = 40;

        // $result = PickupRequest::selectRaw('SUM(CASE WHEN payment_status = 0 THEN cod_amount + amount ELSE cod_amount END) AS total_amount')
        //     ->where('status', 4)
        //     ->where('deliveryman_id', $deliverymanId)
        //     ->where('cod_received_by_admin', 0)
        //     ->first();



        $region         = Region::orderBy('name', 'asc')->get();
        $weights        = Weight::where('status', true)->orderBy('order_id', 'asc')->get();
        $pricingGroups  = PricingGroup::where('status', true)->orderBy('order_id', 'asc')->get();
        $ourServices    = OurService::orderBy('sort_order', 'asc')->limit(9)->latest()->get();
        $seo = Seo::where('page_slug', 'home')->first();
        $meta_title = $seo->title;
        $meta_description = $seo->description;
        $meta_image = $seo->image;
        return view('frontend.index', compact('region', 'weights', 'pricingGroups', 'ourServices', 'meta_title', 'meta_description', 'meta_image'));
    }

    public function about()
    {
        $pageContent = PageContent::first();

        $seo = Seo::where('page_slug', 'about')->first();
        $meta_title = $seo->title;
        $meta_description = $seo->description;
        $meta_image = $seo->image;
        return view('frontend.pages.about', compact('pageContent', 'meta_title', 'meta_description', 'meta_image'));
    }

    public function contact()
    {
        $seo = Seo::where('page_slug', 'contact')->first();
        $meta_title = $seo->title;
        $meta_description = $seo->description;
        $meta_image = $seo->image;
        return view('frontend.pages.contact', compact('meta_title', 'meta_description', 'meta_image'));
    }

    public function contactSub(Request $request)
    {

        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required|email',
            'message'   => 'required'
        ]);

        DB::beginTransaction();
        try {
            $setting = getSetting();
            $data = new Contact();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->message = $request->message;
            $data->save();
            // Mail::to($setting->email)->send(new ContactMailAdmin($data));
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            Toastr::error('Your Request is Not Submitted!.');
            return redirect()->route('contact')->with('error', 'Your Request is Not Submitted!');
        }
        DB::commit();
        Toastr::success('Your Request is Submitted!.');
        return redirect()->route('contact')->with('message', 'Your Request is Submitted!');
    }

    public function pricing()
    {

        $prices = PricingGroup::with('pricing')->orderBy('id', 'asc')->get();
        // dd($prices);
        $seo = Seo::where('page_slug', 'pricing')->first();
        $meta_title = $seo->title;
        $meta_description = $seo->description;
        $meta_image = $seo->image;

        return view('frontend.pages.pricing', compact('prices', 'meta_title', 'meta_description', 'meta_image'));
    }

    public function ecommerce()
    {
        $ecommerceServices = EcommerceService::orderBy('order_id', 'asc')->get();
        $seo = Seo::where('page_slug', 'ecommerce')->first();
        $meta_title = $seo->title;
        $meta_description = $seo->description;
        $meta_image = $seo->image;

        return view('frontend.pages.ecommerce', compact('ecommerceServices', 'meta_title', 'meta_description', 'meta_image'));
    }

    public function privacyPolicy()
    {
        $pageContent = PageContent::first();
        $seo = Seo::where('page_slug', 'privacy-policy')->first();
        $meta_title = $seo->title;
        $meta_description = $seo->description;
        $meta_image = $seo->image;

        return view('frontend.pages.privacy_policy', compact('pageContent', 'meta_title', 'meta_description', 'meta_image'));
    }

    public function termsConditions()
    {
        $pageContent = PageContent::first();

        $seo = Seo::where('page_slug', 'terms-and-conditions')->first();
        $meta_title = $seo->title;
        $meta_description = $seo->description;
        $meta_image = $seo->image;

        return view('frontend.pages.terms_conditions', compact('pageContent', 'meta_title', 'meta_description', 'meta_image'));
    }

    public function tracking(Request $request)
    {
        $data = [];
        if ($request->traking_id) {
            $pickup_request = PickupRequest::with(['city', 'weights'])->where('traking_number', $request->traking_id)->first();

            if ($pickup_request) {

                $data['pickup_request'] = $pickup_request;
                $due = $pickup_request->cod_amount;
                $paid = 0;
                if ($pickup_request->payment_status == 0) {
                    $due += $pickup_request->amount;
                } else {
                    $paid = $pickup_request->amount;
                }
                $data['due'] = $due;
                $data['paid'] = $paid;
                $data['total'] = $pickup_request->cod_amount + $pickup_request->amount;
            }
        }

        $seo = Seo::where('page_slug', 'tracking')->first();
        $data['meta_title'] = $seo->title;
        $data['meta_description'] = $seo->description;
        $data['meta_image'] = $seo->image;

        return view('frontend.pages.tracking', $data);
    }

    public function pickUpRequest()
    {

        $cities = City::orderBy('name', 'asc')->get();
        $weights = Weight::orderBy('order_id', 'asc')->get();
        $pricing_groups = PricingGroup::with('pricing')->orderBy('order_id', 'asc')->get();

        $states = Region::all();

        $seo = Seo::where('page_slug', 'pickup-request')->first();
        $meta_title = $seo->title;
        $meta_description = $seo->description;
        $meta_image = $seo->image;
        return view('frontend.pages.pickup_request', compact('cities', 'states', 'weights', 'pricing_groups', 'meta_title', 'meta_description', 'meta_image'));
    }

    public function pickUpRequestSub(Request $request)
    {

        $request->validate([
            'pickup_name'           => 'required',
            'pickup_contact_name'   => 'required',
            'pickup_address'        => 'required',
            'pickup_mobile'         => 'required',
            'delivery_name'         => 'required',
            'delivery_contact_name' => 'required',
            'delivery_address'      => 'required',
            'delivery_mobile'       => 'required',
            'quantity'              => 'required',
            'weight'                => 'required',
            'product_name'          => 'required',
            'cod_amount'            => 'required',
            'pricing_group_id'      => 'required',
            'pickup_city'           => 'required',
            'delivery_city'         => 'required',
            'description'           => 'required',

        ]);
        DB::beginTransaction();
        try {

            $price = Pricing::where('pricing_group_id', $request->pricing_group_id)->where('weight_id', $request->weight)->first();
            // dd($price);
            $amount = 0;
            if(!isset($price->inside_main_city_price) || !isset($price->inter_city_price)){
                Toastr::error('Delivery is unavailable in those location or change the weight or delivery type.');
                return redirect()->back()->withInput();
            }

            if ($request->pickup_city == $request->delivery_city) {
                $amount = $price->inside_main_city_price ;
            } else {
                $amount = $price->inter_city_price;
            }

            if (isset($price)) {

                $data = new PickupRequest();
                $data->traking_number           = randomString(8);
                $data->pickup_name              = $request->pickup_name;
                $data->pickup_contact_name      = $request->pickup_contact_name;
                $data->pickup_address           = $request->pickup_address;
                $data->pickup_street_address    = $request->pickup_street_address;
                $data->pickup_city              = $request->pickup_city;
                $data->pickup_zip               = $request->pickup_zip;
                $data->pickup_mobile            = $request->pickup_mobile;
                $data->pickup_email             = $request->pickup_email;
                $data->delivery_name            = $request->delivery_name;
                $data->delivery_contact_name    = $request->delivery_contact_name;
                $data->delivery_address         = $request->delivery_address;
                $data->delivery_street_address  = $request->delivery_street_address;
                $data->delivery_city            = $request->delivery_city;
                $data->delivery_zip             = $request->delivery_zip;
                $data->delivery_mobile          = $request->delivery_mobile;
                $data->quantity                 = $request->quantity;
                $data->weight                   = $request->weight;
                $data->product_name             = $request->product_name;
                $data->cod_amount               = $request->cod_amount;
                $data->unit_amount              = $amount;
                $data->amount                   = $amount * $request->quantity;
                $data->status                   = 0;
                $data->pricing_group_id         = $request->pricing_group_id;
                $data->description              = $request->description;


                $data->save();
            } else {
                Toastr::error('Delivery is unavailable in those location or change the weight or delivery type.');
                return redirect()->route('pickup.request')->withInput();
            }
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            Toastr::error('Something Wrong');
            return redirect()->route('pickup.request')->withInput();
        }
        DB::commit();
        Toastr::success('Thanks for contracting us. We will get in touch with you shortly.');
        return redirect()->route('tracking', ['traking_id' => $data->traking_number])->with('message', 'Pick up Request is Submitted!');
    }

    public function getPickupArea(Request $request)
    {



        $cities = City::where('region_id', $request->region_id)->get();
        $html = '<option value="" class="d-nonde">Select Pickup City</option>';
        foreach ($cities as $city) {
            if (isset($request->selected_city)) {
                $selected = null;
                if ($city->id == $request->selected_city) {
                    $selected = "selected";
                }
                $html .= '<option value="' . $city->id . '" ' . $selected . '>' . $city->name . '</option>';
            } else {

                $html .= '<option value="' . $city->id . '">' . $city->name . '</option>';
            }
        }
        return response()->json($html);
    }

    public function getdeliveryArea(Request $request)
    {

        $cities = City::where('region_id', $request->delivery_region_id)->get();
        $html = '<option value="" class="d-nonde">Select Delivery Area</option>';
        foreach ($cities as $city) {
            $html .= '<option value="' . $city->id . '">' . $city->name . '</option>';
        }
        return response()->json($html);
    }

    public function deliveryCost(Request $request)
    {

        $price = Pricing::where('pricing_group_id', $request->delivery_type)
            ->where('weight_id', $request->weight)->first();
        if (isset($price)) {

            return response()->json(["status" => true, "price" => $price]);
        } else {
            return response()->json(["status" => false]);
        }
    }

    public function document()
    {
        $delivery = PricingGroup::pluck('code')->toArray();
        $weight = Weight::max('weight');
        return view('frontend.documentation', compact('delivery', 'weight'));
    }
}
