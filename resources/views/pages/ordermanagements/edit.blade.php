@extends('layouts.app')

@section('title', 'Update - Order Page')
@section('page-title', 'ORDER MANAGEMENT')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Update - Order page</h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form action="{{ route('admin.ordermanagements.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="p-4 rounded-4 mb-4" style="background-color: #FFFAF7; border: 1px solid #FBE3EC;">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <p class="small text-muted mb-1">Order ID</p>
                                <div class="p-2 rounded-3" style="background-color: #FBE3EC;">
                                    #BLM-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p class="small text-muted mb-1">Customer</p>
                                <div class="p-2 rounded-3" style="background-color: #FBE3EC;">{{ $order->customer->name }}
                                </div>
                            </div>

                            <div class="col-12">
                                <p class="small text-muted mb-1">Status</p>
                                <select name="status" class="form-select">
                                    <option value="Diproses" {{ $order->status === 'Diproses' ? 'selected' : '' }}>Diproses
                                    </option>
                                    <option value="Disiapkan" {{ $order->status === 'Disiapkan' ? 'selected' : '' }}>
                                        Disiapkan</option>
                                    <option value="Siap Diambil/Dikirim"
                                        {{ $order->status === 'Siap Diambil/Dikirim' ? 'selected' : '' }}>Siap
                                        Diambil/Dikirim</option>
                                    <option value="Selesai" {{ $order->status === 'Selesai' ? 'selected' : '' }}>Selesai
                                    </option>
                                </select>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <span class="fa fa-save"></span>
                                    Save
                                </button>

                                <a href="{{ route('admin.ordermanagements.index') }}" class="btn text-white"
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
