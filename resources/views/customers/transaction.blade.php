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
                        <select name="hapta_id" id="hapta_id" class="form-control" required>                            
                            @foreach($haptaList as $hapta)
                                <option value="{{ $hapta->id }}" {{ request()->query('hapta_id') == $hapta->id ? 'selected' : '' }}>{{ $hapta->hapta_start_date }} - {{ $hapta->hapta_end_date?$hapta->hapta_end_date:date('Y-m-d')  }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary">Search</button>
                        
                    </div>
                </form>
            </div>
        </div>
        @php
            $previousLeafBalance = isset($previousBalance->leaf_balance)?$previousBalance->leaf_balance:0;
            $previousTobacoBalance = isset($previousBalance->tobaco_balance)?$previousBalance->tobaco_balance:0;
        @endphp
        <div class="row border border-dark">
            <div class="col-4 border-right border-dark"><strong>Previous Week Balance</strong></div>
            <div class="col-3 border-left border-dark"><strong>Leaf:</strong> {{ $previousLeafBalance }}</div>
            <div class="col-3 border-right border-dark"><strong>Tobaco:</strong> {{ $previousTobacoBalance }}</div>
            
        </div>
        <div class="row">
            <div class="col-12">&nbsp;</div>
        </div> 
        
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
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
                        <td>{{ date('d-m-Y',strtotime($customer->entry_date)) }}</td>
                        <td>{{ $customer->neet }}</td>
                        <td>{{ $customer->chant }}</td>                        
                        <td>{{ $customer->leaf }}</td>
                        <td>{{ $customer->thread }}</td>
                        <td>{{ $customer->tobaco }}</td>
                        <td>{{ $customer->neet_chant}}</td>
                        <td>{{ $customer->leaf_use}}</td>
                        <td>{{ $customer->tobaco_use }}</td>                                              
                    </tr>
                    @php                       
                        $totalNeet = $totalNeet + $customer->neet;
                        $totalChant = $totalChant + $customer->chant;
                        $totalLeaf = $totalLeaf + $customer->leaf;
                        $totalThread = $totalThread + $customer->thread;
                        $totalTobaco = $totalTobaco + $customer->tobaco;
                        $totalNeetChant = $totalNeetChant + $customer->neet_chant;
                        $totalLeafUse = $totalLeafUse + $customer->leaf_use;
                        $totalTobacoUse = $totalTobacoUse + $customer->tobaco_use;                        
                    @endphp
                    @endforeach
                    <tr>
                        <td colspan="2"><strong>Total</strong></td>
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
        <div class="row border border-dark">
            <div class="col-4 border-right border-dark"><strong>Current Week Balance</strong></div>
            <div class="col-3 border-left border-dark"><strong>Leaf:</strong> {{ $previousLeafBalance + $totalLeaf-$totalLeafUse }}</div>
            <div class="col-3 border-right border-dark"><strong>Tobaco:</strong> {{ $previousTobacoBalance+$totalTobaco-$totalTobacoUse }}</div>
            
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