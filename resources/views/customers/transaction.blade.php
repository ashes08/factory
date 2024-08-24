@extends('layouts.layout')

@section('title', 'Customer Transaction')
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
                <h4 class="mb-4">{{ $user->first_name }}'s Transaction</h4>
            </div>
            <div class="col-6">
                <form id="dateRangeForm" action="" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="startDate" name="start_date" placeholder="Start Date" autocomplete="off" required>
                        <input type="text" class="form-control" id="endDate" name="end_date" placeholder="End Date" autocomplete="off" required>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>


            
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
                        <th scope="col">Neet</th>
                        <th scope="col">Chant</th>
                        <th scope="col">NeetChant</th>
                        <th scope="col">LeafUse</th>
                        <th scope="col">TobacoUse</th>
                        <th scope="col">Leaf</th>
                        <th scope="col">Thread</th>
                        <th scope="col">Tobaco</th>                        
                    </tr>
                </thead>
                <tbody>
                @if(!empty($customerDatas))
                    @php 
                        $i = 1; 
                    @endphp
                    @foreach($customerDatas as $customer)
                    <tr>
                        <th scope="row"> {{ $i++ }}</th>
                        <td>{{ date('d-m-Y',strtotime($customer->created_at)) }}</td>
                        <td>{{ $customer->neet }}</td>
                        <td>{{ $customer->chant }}</td>
                        <td>{{ $customer->neet+$customer->chant }}</td>
                        <td>{{ ($customer->neet+$customer->chant)*$slab->leaf }}</td>
                        <td>{{ ($customer->neet+$customer->chant)*$slab->tobaco }}</td>
                        <td>{{ $customer->leaf }}</td>
                        <td>{{ $customer->thread }}</td>
                        <td>{{ $customer->tobaco }}</td>
                                              
                    </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        // Datepicker initialization
        $('#startDate').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        $('#endDate').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    });
</script>
@endsection