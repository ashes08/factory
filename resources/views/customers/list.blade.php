@extends('layouts.layout')

@section('title', 'Customer List')
@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if(session('errors'))
    <div class="alert alert-success">
        {{ session('errors') }}
    </div>
@endif
<div class="col-12">
    <div class="bg-light rounded h-100 p-4">
        <div class="row">
            <div class="col-6">
                <h4 class="mb-4">Customer List</h4>
            </div>
            <div class="col-6">
                <span style="float: right;">
                    <a href="{{ route('customer_add') }}" class="btn btn-primary"> + Add </a>
                </span>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Leaf</th>
                        <th scope="col">Thread</th>
                        <th scope="col">Tobaco</th>
                        <th scope="col">Slab</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                @if(!empty($customers))
                    @php 
                        $i = 1; 
                    @endphp
                    @foreach($customers as $customer)
                    <tr>
                        <th scope="row"> {{ $i++ }}</th>
                        <td>{{ $customer->first_name }}</td>
                        <td>{{ $customer->last_name }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->leaf }}</td>
                        <td>{{ $customer->thread }}</td>
                        <td>{{ $customer->tobaco }}</td>
                        <td>{{ $customer->slab->slab_name}}</td>
                        <td>
                            <a href="{{route('customer_edit',$customer->id)}}"  title="Edit"></title><i class="fa fa-edit"></i></a>
                            <a href="{{route('customer_transaction',$customer->id)}}"  title="Edit"></title><i class="fa fa-eye"></i></a>
                            
                        </td>                        
                    </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection