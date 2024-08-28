<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerData;
use App\Models\Slab;
use App\Models\HaptaDate;
use App\Models\HaptaBalance;

class CustomerController extends Controller
{
    public function index(Request $request){
        $customers = Customer::get();
        return view('customers.list')->with(['customers' => $customers]);
    }

    public function add(){
        $slabs = Slab::get();
        return view('customers.add')->with(['slabs' => $slabs]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            //'email' => 'required|email|unique:customers,email',
            'phone' => 'required|string|max:15',
        ]);

        $Customer = new Customer;
        $Customer->first_name = $request->first_name;
        $Customer->last_name = $request->last_name;
        $Customer->phone = $request->phone;
        $Customer->address = $request->address;
        $Customer->leaf = $request->leaf;
        $Customer->tobaco = $request->tobaco;
        $Customer->thread = $request->thread;
        $Customer->slab_id = $request->slab;
        if($Customer->save()){
            $material = new CustomerData;
            $material->entry_date = date('Y-m-d');
            $material->leaf = $request->leaf;
            $material->thread = $request->thread;
            $material->tobaco = $request->tobaco;
            $material->save();
        }
       
        return redirect()->route('customer_list')->with('success', 'Customer added successfully!');
    }

    public function edit(Request $request,$id){
        $customer = Customer::find($id);
        $slabs = Slab::get();
        return view('customers.edit')->with(['customer' => $customer,'slabs' => $slabs]);
    }

    public function update(Request $request){
        $id = $request->id;
        $Customer = Customer::find($id);
        $Customer->first_name = $request->first_name;
        $Customer->last_name = $request->last_name;
        $Customer->phone = $request->phone;
        $Customer->address = $request->address;
        $Customer->slab_id = $request->slab;
        $Customer->save();
        return redirect()->route('customer_list')->with('success', 'Customer updated successfully!');
    }

    public function addMaterials(Request $request){
        $users = Customer::get();        
        return view('customers.add_material')->with(['users' => $users]);
    }

    public function storeMaterials(Request $request){
        
        $customer = Customer::find( $request->user_id);
        $slab = Slab::find($customer->slab_id);

        $customer->leaf = $customer->leaf + $request->leaf;
        $customer->thread = $customer->thread + $request->thread;
        $customer->tobaco = $customer->tobaco + $request->tobaco;
        $customer->save();

        $material = new CustomerData;
        $material->user_id = $request->user_id;
        $material->entry_date = $request->entry_date;
        $material->neet = $request->neet;
        $material->chant = $request->chant;
        $material->leaf = $request->leaf;
        $material->thread = $request->thread;
        $material->tobaco = $request->tobaco;
        $material->neet_chant = $material->neet+$material->chant;
        $material->leaf_use = ($material->neet+$material->chant)*$slab->leaf;
        $material->tobaco_use = ($material->neet+$material->chant)*$slab->tobaco;
        $material->save();
        return redirect()->route('customer_list')->with('success', 'Record added successfully!');
    }

    // public function expanceMaterials(Request $request,$id){
    //     return view('customers.expance_material')->with(['user_id' => $id]);
    // }

    // public function storeExpanceMaterials(Request $request){
    //     $validatedData = $request->validate([
    //         'leaf' => 'required|integer',
    //         'thread' => 'required|integer',
    //         'tobaco' => 'required|integer',
    //     ]);
    //     $customer = Customer::find( $request->user_id);
    //     $slab = Slab::find($customer->slab_id);
    //     $customer->leaf = $customer->leaf - $request->leaf;
    //     $customer->thread = $customer->thread - $request->thread;
    //     $customer->tobaco = $customer->tobaco - $request->tobaco;
    //     $customer->save();

    //     $material = new CustomerData;
    //     $material->user_id = $request->user_id;
    //     $material->type = 2;
    //     $material->leaf = $request->leaf;
    //     $material->thread = $request->thread;
    //     $material->tobaco = $request->tobaco;  
    //     $material->neet_chant = $material->neet+$material->chant;
    //     $material->leaf_use = ($material->neet+$material->chant)*$slab->leaf;
    //     $material->tobaco_use = ($material->neet+$material->chant)*$slab->tobaco; 
    //     $material->save();
    //     return redirect()->route('customer_list')->with('success', 'Record added successfully!');
    // }


    public function customerTransaction(Request $request, $id) {
        $user = Customer::find($id); 
        $slab = Slab::find($user->slab_id);
        $hapta_id = $request->input('hapta_id',0); 
        
        $hapta = HaptaDate::find($hapta_id);

        if($hapta){
            $startDate = $hapta->hapta_start_date;
            $endDate = ($hapta->hapta_end_date) ? $hapta->hapta_end_date : date('Y-m-d');
        }else{
            $hapta = HaptaDate::orderBy('id','desc')->first();            
            $startDate = $hapta ? $hapta->hapta_start_date : date('Y-m-d');
            $endDate = ($hapta->hapta_end_date) ? $hapta->hapta_end_date : date('Y-m-d');            
        }
        // Query CustomerData with date range filter
        $query = CustomerData::where('user_id', $id);
        $haptaquery = HaptaBalance::where('user_id', $id);

        if ($startDate && $endDate) {
            $query->whereBetween('entry_date',  [$startDate.' 00:00:00', $endDate." 23:59:59"]);
            $previousHapta =   HaptaDate::where('id','<',$hapta_id)->orderBy('id','desc')->first();
            $previousHaptaId = $previousHapta ? $previousHapta->id : 0;          
            $haptaquery->where('hapta_id', $previousHaptaId);
        }
        $customerDatas = $query->get();        
        $previousBalance = $haptaquery->orderBy('id', 'desc')->first();
        $haptaList = HaptaDate::orderBy('id','desc')->get();

        return view('customers.transaction')->with([
            'customerDatas' => $customerDatas,
            'user' => $user,
            'slab' => $slab,
            'previousBalance' => $previousBalance,
            'haptaList' => $haptaList
        ]);
    }

    public function haptaGenerate(Request $request){
        if($request->post()){
            $validatedData = $request->validate([
                'hapta_start_date' => 'required|date',
                'hapta_end_date' => 'required|date',
            ]);
            
            $lastHapta = HaptaDate::orderBy('id', 'desc')->first();
            if($lastHapta){
                $lastHapta->hapta_end_date = $request->hapta_end_date;
                $lastHapta->save();
            }
            $hapta = new HaptaDate;
            $hapta->hapta_start_date = $request->hapta_start_date;
            $hapta->save();

            $lastHapta = HaptaDate::orderBy('id', 'desc')->skip(1)->first();
            $hapta_start_date = $lastHapta ? $lastHapta->hapta_start_date : date('Y-m-d');
            $hapta_end_date = $lastHapta ? $lastHapta->hapta_end_date : date('Y-m-d');
            
            $customers = Customer::where('status','1')->get(); 
            foreach($customers as $customer){
                $customerData = CustomerData::selectRaw('user_id,  (SUM(leaf) - SUM(leaf_use)) as leaf_balance, (SUM(tobaco) - SUM(tobaco_use)) as tobaco_balance')->where('user_id', $customer->id)->groupBy('user_id')->whereBetween('entry_date',  [$hapta_start_date.' 00:00:00', $hapta_end_date." 23:59:59"])->first();
                
                $haptBalance = new HaptaBalance;
                $haptBalance->user_id = $customer->id;
                $haptBalance->hapta_id = $hapta->id;
                $haptBalance->hapta_start_date = $hapta_start_date;
                $haptBalance->hapta_end_date = $hapta_end_date;
                $haptBalance->leaf_balance = isset($customerData->leaf_balance)?$customerData->leaf_balance:0;
                $haptBalance->tobaco_balance = isset($customerData->tobaco_balance)?$customerData->tobaco_balance:0;
                $haptBalance->save();
            }
            return redirect()->route('hapta_generate')->with('success', 'Record added successfully!');
        }
        return view('customers.hapta_generate');
    }


    public function hapta(Request $request){

        // Get date range from request
        $startDate = $request->input('start_date',date('Y-m-d', strtotime('-1 week')));
        $endDate = $request->input('end_date',date('Y-m-d'));

        
            $query = CustomerData::selectRaw('user_id,SUM(neet) as total_neet, SUM(chant) as total_chant, SUM(leaf) as total_leaf, SUM(thread) as total_thread, SUM(tobaco) as total_tobaco, SUM(neet_chant) as total_neet_chant, SUM(leaf_use) as total_leaf_use, SUM(tobaco_use) as total_tobaco_use');
            
            if ($startDate && $endDate) {
                $query->whereBetween('created_at', [$startDate.' 00:00:00', $endDate." 23:59:59"]);
            }
            $customerDatas = $query->groupBy('user_id')->get();
        


        return view('customers.hapta')->with([
            'customerDatas' => $customerDatas
        ]);

    }
}
