@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Welcome <span style="color: blue;">{{ auth()->user()->name }} </span></h5>
        <p class="card-text">Be your own boss. Manage users now!</p>
        
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Users</h5>
                        <p class="card-text">{{ $usersCount }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Products</h5>
                        <p class="card-text">{{ $productsCount }}</p>
                    </div>
                </div>
            </div>
            <!-- Add more cards as needed -->
        </div>
    </div>
</div>
@endsection