<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slab;

class SlabController extends Controller
{
    //

    public function index(){
        $slabs = Slab::get();
        return view('slabs.list')->with(['slabs' => $slabs]);

    }

    public function add(){
        return view('slabs.add');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'slab_name' => 'required|string|max:255',
            'leaf' => 'required',
            'tobaco' => 'required',
            'price' => 'required',
            
        ]);

        //Slab::create($validatedData);
        $Slab = new Slab;
        $Slab->slab_name = $request->slab_name;        
        $Slab->leaf = $request->leaf;
        $Slab->tobaco = $request->tobaco;
        $Slab->price = $request->price;
        $Slab->save();
       
        return redirect()->route('slab_list')->with('success', 'Slab added successfully!');
    }

    public function edit(Request $request,$id){
        $slab = Slab::find($id);
        return view('slabs.edit')->with(['slab' => $slab]);
    }

    public function update(Request $request){
        $id = $request->id;
        $Slab = Slab::find($id);
        $Slab->slab_name = $request->slab_name;
        $Slab->leaf = $request->leaf;
        $Slab->tobaco = $request->tobaco;
        $Slab->price = $request->price;
        $Slab->save();
        return redirect()->route('slab_list')->with('success', 'Slab updated successfully!');
    }
}
