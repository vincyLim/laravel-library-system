@extends('layout.admin')

@section("content")

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Pay Penalty</h4>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="post" action="{{ route('penalty.update',$penalty->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <div class="col-md-4">
                <label for="amount" class="form-label fw-bold">Amount</label>
                <input type="text" class="form-control" id="amount" name="amount" value="{{ $penalty->amount }}" readonly>
                </div>
                <div class="col-md-4">
                <label for="return_date" class="form-label fw-bold">Return Date</label>
                <input type="text" class="form-control" id="return_date" name="return_date" value="{{ $penalty->borrowRecord->return_date }}" readonly>
                </div>
                <div class="col-md-4">
                <label for="end_date" class="form-label fw-bold">End Date</label>
                <input type="text" class="form-control" id="end_date" name="end_date" value="{{ $penalty->borrowRecord->end_date }}" readonly>
                </div>
            </div>
            <div class="mb-3">
                <label for="payment_method" class="form-label fw-bold">Payment Method</label>
                <select class="form-select" id="payment_method" name="payment_method" required>
                <option value="credit_card">Credit Card</option>
                <option value="cash">Cash</option>
                <option value="bank_transfer">Bank Transfer</option>
                <option value="e-Wallet">E-Wallet</option>
                </select>
            </div>
            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-primary">Pay Now</button>
            </div>
            </form>
        </div>
@endsection