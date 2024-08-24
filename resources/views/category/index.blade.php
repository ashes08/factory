@extends('layouts.layout')

@section('title', 'Category')

@section('content')

    <div class="col-sm-12 col-xl-12">
        <div class="bg-light rounded h-100 p-4">
            <h4 class="mb-4">Category</h4>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Category Name</label>
            </div>
            
            <div class="form-floating mb-3">
                <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                    <option selected="">Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
                <label for="floatingSelect">Works with selects</label>
            </div>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 150px;"></textarea>
                <label for="floatingTextarea">Comments</label>
            </div>
            <div  class="col-sm-4 col-xl-4">
                <br>
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </div>
    </div>
    

@endsection