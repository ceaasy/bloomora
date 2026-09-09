<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewManagementController extends Controller
{
    public function index()
    {
        $reviews=Review::with('customer','product')->latest()->get();
        return view('pages.reviewmanagements.index', compact('reviews'));
    }

   public function show(Review $review)
    {
        $review->load('customer', 'product');

        return view('pages.reviewmanagements.show', compact('review'));
    }

    public function toggle(Review $review)
{
    $review->is_visible = !$review->is_visible;
    $review->save();

    return redirect()->route('admin.reviewmanagements.index')
        ->with('success', 'Status ulasan berhasil diperbarui');
}
}
