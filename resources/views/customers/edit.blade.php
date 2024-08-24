@extends('layouts.layout')

@section('title', 'Customer Edit')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="{{ route('customer_update') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $customer->id}}">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h4 class="mb-4">Customer Edit</h4>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" value="{{$customer->first_name}}" id="first_name" name="first_name" placeholder="First Name" required>
                    <label for="first_name">First Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" value="{{$customer->last_name}}" id="last_name" name="last_name" placeholder="Last Name" required>
                    <label for="last_name">Last Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" value="{{$customer->phone}}" id="phone" name="phone" placeholder="Phone"  required>
                    <label for="phone">Phone</label>
                </div>

                <div class="form-floating mb-3">
                    <textarea class="form-control" name="address"  id="address" placeholder="Address" style="height: 100px;">{{$customer->address}}</textarea>
                    <label for="address">Address</label>
                </div>               
                <div class="form-floating mb-3">
                    <select name="slab" id="slab" class="form-control">
                        @foreach($slabs as $slab)
                        <option value="{{ $slab->id}}" @if($customer->slab_id == $slab->id) selected @endif>{{ $slab->slab_name}}</option>
                        @endforeach
                    </select>
                    <label for="tobaco">Slab</label>
                </div>
                <div  class="col-sm-4 col-xl-4">
                    <br>
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </div>
        </div>
    <form>

@endsection