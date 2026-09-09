@extends('layouts.app')

@section('title', 'Detail - Review Page')
@section('page-title', 'REVIEW')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail - Review page</h1>
    </div>

    <div class="p-4 rounded-4 mb-4" style="background-color: #FFFAF7; border: 1px solid #FBE3EC;">
        <div class="row g-3">
            <div class="col-md-6">
                <p class="small text-muted mb-1">Customer</p>
                <div class="p-2 rounded-3" style="background-color: #FBE3EC;">{{ $review->customer->name }}</div>
            </div>
            <div class="col-md-6">
                <p class="small text-muted mb-1">Product</p>
                <div class="p-2 rounded-3" style="background-color: #FBE3EC;">{{ $review->product->name }}</div>
            </div>
            <div class="col-md-6">
                <p class="small text-muted mb-1">Rating</p>
                <div class="p-2 rounded-3" style="background-color: #FBE3EC;">
                    @for ($i = 1; $i <= 5; $i++)
                        <span class="fa fa-star" style="color: {{ $i <= $review->rating ? '#f0ad4e' : '#ccc' }};"></span>
                    @endfor
                </div>
            </div>
            <div class="col-md-6">
                <p class="small text-muted mb-1">Status</p>
                <div class="p-2 rounded-3" style="background-color: #FBE3EC;">
                    @if ($review->is_visible)
                        <span class="badge" style="background-color: #d4edda; color: #155724;">Visible</span>
                    @else
                        <span class="badge" style="background-color: #f8d7da; color: #721c24;">Hidden</span>
                    @endif
                </div>
            </div>
            <div class="col-12">
                <p class="small text-muted mb-1">Comment</p>
                <div class="p-2 rounded-3" style="background-color: #FBE3EC;">{{ $review->comment ?? '-' }}</div>
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
        <a href="{{ route('admin.reviewmanagements.index') }}" class="btn text-white"
            style="background-color: #6c757d; border-color: #6c757d;">
            <span class="fa fa-arrow-left"></span>
            Back
        </a>
    </div>

@endsection
