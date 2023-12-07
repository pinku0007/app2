<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;
use Hash;
use File;
use App\Helpers\Common;
use App\User;
class HomeController extends Controller {
  
    public function __construct() {
             $this->middleware('admin')->except('logout');
	}
	//show admin page

	public function dashboard(){
		return view('admin.dashboard');
	}
	
	public function orders(){
		$data['orders'] = DB::table('orders')->paginate(20);
		return view('admin.orders.list',$data);
	}
	public function remove_row(Request $request){
		DB::table($request->table)->where('id',$request->id)->delete();
		echo 1;
	}

	public function orders_create(){
		$data['brands'] = DB::connection('mysql2')->table('app_brands')->get();
		return view('admin.orders.add',$data);
	}
	public function get_models(Request $request){
		$brand = explode('~',$request->value);
		$model = DB::connection('mysql2')->table('app_model')->where('brand_id',$brand[0])->get();
		$html='';
		$html.='<option value="">Select</option>';
		if (!$model->isEmpty()) {
			foreach ($model as $key) {
				$html.='<option value="'.$key->id.'~'.$key->model_name.'">'.$key->model_name.'</option>';
			}
		}
		echo $html;
	}

	public function orders_store(Request $request){
		if (!DB::table('orders')->where('vin',$request->car_vin)->exists()) {
			$brand = explode('~',$request->brand);
			$model = explode('~',$request->model);
			$insert= DB::table('orders')->insert(['vin'=>$request->car_vin,'customer_name'=>$request->customer_name,'address'=>$request->address,'telephone'=>$request->telephone,'brand_name'=>$brand[1],'model_name'=>$model[1],'year'=>$request->year,'price'=>$request->price]);
			if($insert) {
				return redirect()->back()->with('message','New Order Created.');
			}else{
				return redirect()->back()->with('error','Something went wrong. Please try after some time.');
			}
		}else{
			return redirect()->back()->with('error','This vin id already exist. Please use another.');
		}
	}

	public function service(){
		$data['service'] = DB::table('services')->paginate(20);
		return view('admin.service.list',$data);
	}

	public function service_create(){
		return view('admin.service.add');
	}

	public function service_store(Request $request){
		$insert= DB::table('services')->insert(['vin'=>$request->car_vin,'mechanic_name'=>$request->mechanic_name,'type_of_service'=>$request->service_type,'date_of_service'=>$request->date_of_service,'customer_name'=>$request->customer_name]);
		if($insert) {
			return redirect()->back()->with('message','New Service Created.');
		}else{
			return redirect()->back()->with('error','Something went wrong. Please try after some time.');
		}
	}

}
