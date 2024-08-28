@extends('layouts.layout')

@section('title', 'Add Materials')

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
    <form action="{{ route('store_materials') }}" method="POST">
    @csrf
    
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h4 class="mb-4">Add Materials</h4>
                <div class="form-floating mb-3">
                    <select name="user_id" id="user_id" class="form-control" required>
                        <option value="">Select User</option>
                        @foreach($users as $user)
                        <option value="{{ $user->id}}" data-leaf="{{ $user->slab->leaf }}" data-tobaco="{{ $user->slab->tobaco }}">{{ $user->first_name}} {{ $user->last_name}}</option>
                        @endforeach
                    </select>
                    <label for="user_id">User</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="entry_date" name="entry_date" placeholder="Entry Date" value="{{ date('Y-m-d')}}" >
                    <label for="entry_date">Entry Date</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control neetchat" id="neet" name="neet" placeholder="neet" value="0" >
                    <label for="neet">Neet</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control neetchat" id="chant" name="chant" placeholder="chant" value="0" >
                    <label for="chant">Chant</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="leaf" name="leaf" placeholder="Leaf" value="0">
                    <label for="leaf">Leaf</label>
                </div>                
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="tobaco" name="tobaco" placeholder="Tobaco" value="0">
                    <label for="tobaco">Tobaco</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="thread" name="thread" placeholder="Thread" value="0">
                    <label for="thread">Thread</label>
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
            $('#entry_date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            });

            $('#user_id').change(function() {
                var leaf = $(this).find(':selected').data('leaf');
                var tobaco = $(this).find(':selected').data('tobaco');
                var neet = $('#neet').val();
                var chant = $('#chant').val();
                var total = parseInt(neet) + parseInt(chant);
                var leaf_use = total*leaf;
                var tobaco_use = total*tobaco;
                $('#leaf').val(leaf_use);
                $('#tobaco').val(tobaco_use);

            });

            $('.neetchat').blur(function() {
                var leaf = $('#user_id').find(':selected').data('leaf');
                var tobaco = $('#user_id').find(':selected').data('tobaco');
                var neet = $('#neet').val();
                var chant = $('#chant').val();
                var total = parseInt(neet) + parseInt(chant);
                var leaf_use = parseFloat(total*leaf);
                var tobaco_use = parseFloat(total*tobaco);
                console.log(total);
                console.log(tobaco);
                console.log(tobaco_use);
                $('#leaf').val(leaf_use.toFixed(2));
                $('#tobaco').val(tobaco_use.toFixed(2));

            });
        });
    </script>

@endsection