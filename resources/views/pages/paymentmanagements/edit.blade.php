@extends('layouts.app')

@section('title', 'Update - Payment Page')
@section('page-title', 'ORDER MANAGEMENT')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Update - Payment page</h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form action="{{ route('admin.paymentmanagements.update', $payment->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="p-4 rounded-4 mb-4" style="background-color: #FFFAF7; border: 1px solid #FBE3EC;">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <p class="small text-muted mb-1">Order ID</p>
                                <div class="p-2 rounded-3" style="background-color: #FBE3EC;">
                                    #BLM-{{ str_pad($payment->order->id, 4, '0', STR_PAD_LEFT) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p class="small text-muted mb-1">Customer</p>
                                <div class="p-2 rounded-3" style="background-color: #FBE3EC;">
                                    {{ $payment->order->customer->name }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p class="small text-muted mb-1">Payment Method</p>
                                <div class="p-2 rounded-3" style="background-color: #FBE3EC;">{{ $payment->payment_method }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p class="small text-muted mb-1">Amount</p>
                                <div class="p-2 rounded-3" style="background-color: #FBE3EC;">
                                    Rp{{ number_format($payment->amount, 0, ',', '.') }}</div>
                            </div>
                            <div class="col-md-6">
                                <label for="payment_date" class="form-label">Payment Date</label>
                                <input type="date" name="payment_date" id="payment_date"
                                    value="{{ old('payment_date') ?? $payment->payment_date }}"
                                    class="form-control @error('payment_date') is-invalid @enderror">

                                @error('payment_date')
                                    <div class="invalid-feedack d-block">
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <p class="small text-muted mb-1">Status</p>
                                <select name="status" class="form-select">
                                    <option value="Belum Dibayar"
                                        {{ $payment->status === 'Belum Dibayar' ? 'selected' : '' }}>
                                        Belum Dibayar
                                    </option>
                                    <option value="Sudah Dibayar"
                                        {{ $payment->status === 'Sudah Dibayar' ? 'selected' : '' }}>
                                        Sudah Dibayar</option>
                                </select>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <span class="fa fa-save"></span>
                                    Save
                                </button>

                                <a href="{{ route('admin.paymentmanagements.index') }}" class="btn text-white"
                                    style="background-color: #6c757d; border-color: #6c757d;">
                                    <span class="fa fa-times-circle"></span>
                                    Cancle
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
