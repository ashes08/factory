@extends('layouts.layout')

@section('title', 'Customer Add')

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
    <form action="{{ route('store_customer') }}" method="POST">
    @csrf
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h4 class="mb-4">Customer Add</h4>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required>
                    <label for="first_name">First Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required>
                    <label for="last_name">Last Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone"  required>
                    <label for="phone">Phone</label>
                </div>

                <div class="form-floating mb-3">
                    <textarea class="form-control" name="address" id="address" placeholder="Address" style="height: 100px;"></textarea>
                    <label for="address">Address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="leaf" name="leaf" placeholder="Leaf"  required>
                    <label for="leaf">Leaf</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="thread" name="thread" placeholder="Thread"  required>
                    <label for="thread">Thread</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="tobaco" name="tobaco" placeholder="Tobaco"  required>
                    <label for="tobaco">Tobaco</label>
                </div>
                <div class="form-floating mb-3">
                    <select name="slab" id="slab" class="form-control">
                        @foreach($slabs as $slab)
                        <option value="{{ $slab->id}}">{{ $slab->slab_name}}</option>
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