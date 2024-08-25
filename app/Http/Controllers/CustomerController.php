<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerData;
use App\Models\Slab;

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
        $Customer->save();
       
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

    public function expanceMaterials(Request $request,$id){
        return view('customers.expance_material')->with(['user_id' => $id]);
    }

    public function storeExpanceMaterials(Request $request){
        $validatedData = $request->validate([
            'leaf' => 'required|integer',
            'thread' => 'required|integer',
            'tobaco' => 'required|integer',
        ]);
        $customer = Customer::find( $request->user_id);
        $slab = Slab::find($customer->slab_id);
        $customer->leaf = $customer->leaf - $request->leaf;
        $customer->thread = $customer->thread - $request->thread;
        $customer->tobaco = $customer->tobaco - $request->tobaco;
        $customer->save();

        $material = new CustomerData;
        $material->user_id = $request->user_id;
        $material->type = 2;
        $material->leaf = $request->leaf;
        $material->thread = $request->thread;
        $material->tobaco = $request->tobaco;  
        $material->neet_chant = $material->neet+$material->chant;
        $material->leaf_use = ($material->neet+$material->chant)*$slab->leaf;
        $material->tobaco_use = ($material->neet+$material->chant)*$slab->tobaco; 
        $material->save();
        return redirect()->route('customer_list')->with('success', 'Record added successfully!');
    }


public function customerTransaction(Request $request, $id) {
    $user = Customer::find($id); 
    $slab = Slab::find($user->slab_id);

    // Get date range from request
    $startDate = $request->input('start_date',date('Y-m-d', strtotime('-1 week')));
    $endDate = $request->input('end_date',date('Y-m-d'));

    // Query CustomerData with date range filter
    $query = CustomerData::where('user_id', $id);

    if ($startDate && $endDate) {
        $query->whereBetween('created_at',  [$startDate.' 00:00:00', $endDate." 23:59:59"]);
    }

    $customerDatas = $query->get();

    return view('customers.transaction')->with([
        'customerDatas' => $customerDatas,
        'user' => $user,
        'slab' => $slab
    ]);
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
