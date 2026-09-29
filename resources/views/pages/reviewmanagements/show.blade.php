@extends('layouts.app')

@section('title', 'Detail - Review Page')
@section('page-title', 'REVIEW')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 admin-page-title">Detail - Review page</h1>
    </div>

    <div class="p-4 rounded-4 mb-4 info-box">
        <div class="row g-3">
            <div class="col-md-6">
                <p class="small text-muted mb-1">Customer</p>
                <div class="p-2 rounded-3 info-value-box">{{ $review->customer->name }}</div>
            </div>
            <div class="col-md-6">
                <p class="small text-muted mb-1">Product</p>
                <div class="p-2 rounded-3 info-value-box">{{ $review->product->name }}</div>
            </div>
            <div class="col-md-6">
                <p class="small text-muted mb-1">Rating</p>
                <div class="p-2 rounded-3 info-value-box">
                    @for ($i = 1; $i <= 5; $i++)
                        <span class="fa fa-star" style="color: {{ $i <= $review->rating ? '#f0ad4e' : '#ccc' }};"></span>
                    @endfor
                </div>
            </div>
            <div class="col-md-6">
                <p class="small text-muted mb-1">Status</p>
                <div class="p-2 rounded-3 info-value-box">
                    @if ($review->is_visible)
                        <span class="badge badge-visible">Visible</span>
                    @else
                        <span class="badge badge-hidden">Hidden</span>
                    @endif
                </div>
            </div>
            <div class="col-12">
                <p class="small text-muted mb-1">Comment</p>
                <div class="p-2 rounded-3 info-value-box">{{ $review->comment ?? '-' }}</div>
            </div>

            @if ($review->photo)
                <div class="col-12">
                    <p class="small text-muted mb-1">Photo</p>
                    <img src="{{ asset('storage/' . $review->photo) }}" alt="foto ulasan" class="rounded-3"
                        style="max-width: 200px;">
                </div>
            @endif
        </div>
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('admin.reviewmanagements.index') }}" class="btn text-white btn-cancel-gray">
            <span class="fa fa-arrow-left"></span>
            Back
        </a>
    </div>

@endsection
