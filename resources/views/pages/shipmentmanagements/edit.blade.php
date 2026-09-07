@extends('layouts.app')

@section('title', 'Update - Shipment Page')
@section('page-title', 'ORDER MANAGEMENT')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Update - Shipment page</h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form action="{{ route('admin.shipmentmanagements.update', $shipment->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="p-4 rounded-4 mb-4" style="background-color: #FFFAF7; border: 1px solid #FBE3EC;">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <p class="small text-muted mb-1">Order ID</p>
                                <div class="p-2 rounded-3" style="background-color: #FBE3EC;">
                                    #BLM-{{ str_pad($shipment->order->id, 4, '0', STR_PAD_LEFT) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p class="small text-muted mb-1">Customer</p>
                                <div class="p-2 rounded-3" style="background-color: #FBE3EC;">
                                    {{ $shipment->order->customer->name }}
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="tracking_number" class="form-label">Tracking Number</label>
                                <input type="text" name="tracking_number" id="tracking_number"
                                    value="{{ old('tracking_number', $shipment->tracking_number) }}"
                                    class="form-control @error('tracking_number') is-invalid @enderror">
                                @error('tracking_number')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="Menunggu" {{ $shipment->status === 'Menunggu' ? 'selected' : '' }}>
                                        Menunggu</option>

                                    @if ($shipment->order->pickup_method === 'Dikirim')
                                        <option value="Dikirim" {{ $shipment->status === 'Dikirim' ? 'selected' : '' }}>
                                            Dikirim</option>
                                    @else
                                        <option value="Siap Diambil"
                                            {{ $shipment->status === 'Siap Diambil' ? 'selected' : '' }}>Siap Diambil
                                        </option>
                                    @endif

                                    <option value="Selesai" {{ $shipment->status === 'Selesai' ? 'selected' : '' }}>Selesai
                                    </option>
                                </select>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <span class="fa fa-save"></span>
                                    Save
                                </button>
                                <a href="{{ route('admin.shipmentmanagements.index') }}" class="btn text-white"
                                    style="background-color: #6c757d; border-color: #6c757d;">
                                    <span class="fa fa-times-circle"></span>
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
