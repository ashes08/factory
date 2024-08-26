@extends('layouts.layout')

@section('title', 'Hapta Generate')

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
    <form action="{{ route('hapta_date_store') }}" method="POST">
    @csrf
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h4 class="mb-4">Hapta Generate</h4>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="hapta_end_date" name="hapta_end_date" placeholder="Current hapta end date" required>
                    <label for="hapta_end_date">Current hapta end date</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="hapta_start_date" name="hapta_start_date" placeholder="New hapta start date" required>
                    <label for="last_name">New hapta start date</label>
                </div>
                
                
                <div  class="col-sm-4 col-xl-4">
                    <br>
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </div>
        </div>
    <form>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Datepicker initialization
        $('#hapta_end_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        $('#hapta_start_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    });
</script>
@endsection