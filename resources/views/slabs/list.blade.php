@extends('layouts.layout')

@section('title', 'Slab List')
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
                <h4 class="mb-4">Slab List</h4>
            </div>
            <div class="col-6">
                <span style="float: right;">
                    <a href="{{ route('slab_add') }}" class="btn btn-primary"> + Add </a>
                </span>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Slab Name</th>                        
                        <th scope="col">Leaf</th>
                        <th scope="col">Tobaco</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                @if(!empty($slabs))
                    @php 
                        $i = 1; 
                    @endphp
                    @foreach($slabs as $slab)
                    <tr>
                        <td scope="row"> {{ $i++ }}</td>
                        <td>{{ $slab->slab_name }}</td>  
                        <td>{{ $slab->leaf }}</td>
                        <td>{{ $slab->tobaco }}</td>
                        <td>{{ $slab->price }}</td>
                        <td>
                            <a href="{{route('slab_edit',$slab->id)}}"  title="Edit"></title><i class="fa fa-edit"></i></a>                            
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