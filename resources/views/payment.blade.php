@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Complete Your Subscription Payment</h2>
    <form method="POST" action="{{ route('pay') }}" id="paymentForm">
        @csrf
        <div class="form-group mb-3">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name" class="form-control" value="{{ Auth::user()->name }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" class="form-control" value="{{ Auth::user()->last_name }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ Auth::user()->email }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="amount">Amount (ETB)</label>
            <input type="text" name="amount" id="amount" class="form-control" value="100" readonly>
        </div>

        

        <button type="submit" class="btn btn-primary">Pay Now</button>
    </form>
</div>
@endsection
