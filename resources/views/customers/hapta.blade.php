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
                <h4 class="mb-4">Hapta</h4>
            </div>
            <div class="col-6">
                <form id="dateRangeForm" action="" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="startDate" name="start_date" placeholder="Start Date" autocomplete="off" value="{{ request()->query('start_date') }}" required>
                        <input type="text" class="form-control" id="endDate" name="end_date" placeholder="End Date" autocomplete="off" value="{{ request()->query('end_date') }}" required>
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
                        <th scope="col">Name</th>
                        <th scope="col">Neet</th>
                        <th scope="col">Chant</th>                        
                        <th scope="col">Leaf</th>
                        <th scope="col">Thread</th>
                        <th scope="col">Tobaco</th>  
                        <th scope="col">NeetChant</th>
                        <th scope="col">LeafUse</th>
                        <th scope="col">TobacoUse</th>                      
                    </tr>
                </thead>
                <tbody>
                @if(!empty($customerDatas))
                    @php 
                        $i = 1; 
                        $totalNeet = 0;
                        $totalChant = 0;
                        $totalLeaf = 0;
                        $totalThread = 0;
                        $totalTobaco = 0;
                        $totalNeetChant = 0;
                        $totalLeafUse = 0;
                        $totalTobacoUse = 0;
                    @endphp
                    @foreach($customerDatas as $customer)
                        <tr>
                            <th scope="row"> {{ $i++ }}</th>
                            <td>{{ $customer->customer->first_name }}</td>
                            <td>{{ $customer->total_neet }}</td>
                            <td>{{ $customer->total_chant }}</td>                        
                            <td>{{ $customer->total_leaf }}</td>
                            <td>{{ $customer->total_thread }}</td>
                            <td>{{ $customer->total_tobaco }}</td>
                            <td>{{ $customer->total_neet_chant}}</td>
                            <td>{{ $customer->total_leaf_use}}</td>
                            <td>{{ $customer->total_tobaco_use }}</td>
                                                
                        </tr>
                        @php
                            $totalNeet += $customer->total_neet;
                            $totalChant += $customer->total_chant;
                            $totalLeaf += $customer->total_leaf;
                            $totalThread += $customer->total_thread;
                            $totalTobaco += $customer->total_tobaco;
                            $totalNeetChant += $customer->total_neet_chant;
                            $totalLeafUse += $customer->total_leaf_use;
                            $totalTobacoUse += $customer->total_tobaco_use;
                        @endphp
                    @endforeach
                        <tr>
                            <th scope="row" colspan="2"><strong>Total</strong></th>
                            <td><strong>{{ $totalNeet }}</strong></td>
                            <td><strong>{{ $totalChant }}</strong></td>                        
                            <td><strong>{{ $totalLeaf }}</strong></td>
                            <td><strong>{{ $totalThread }}</strong></td>
                            <td><strong>{{ $totalTobaco }}</strong></td>
                            <td><strong>{{ $totalNeetChant }}</strong></td>
                            <td><strong>{{ $totalLeafUse }}</strong></td>
                            <td><strong>{{ $totalTobacoUse }}</strong></td>
                        </tr>
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