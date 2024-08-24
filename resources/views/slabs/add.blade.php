@extends('layouts.layout')

@section('title', 'Slab Add')

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
    <form action="{{ route('store_slab') }}" method="POST">
    @csrf
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h4 class="mb-4">Slab Add</h4>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="slab_name" name="slab_name" placeholder="Slab Name" required>
                    <label for="slab_name">Slab Name</label>
                </div>                
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="leaf" name="leaf" placeholder="Leaf"  required>
                    <label for="leaf">Leaf</label>
                </div>                
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="tobaco" name="tobaco" placeholder="Tobaco"  required>
                    <label for="tobaco">Tobaco</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="price" name="price" placeholder="Price"  required>
                    <label for="Price">price</label>
                </div>
                <div  class="col-sm-4 col-xl-4">
                    <br>
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </div>
        </div>
    <form>

@endsection