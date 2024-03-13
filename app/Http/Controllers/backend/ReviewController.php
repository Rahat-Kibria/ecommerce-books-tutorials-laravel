<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\ProductReview;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    /**
     * Display a listing of the product reviews in admin panel.
     */
    public function reviews_list()
    {
        $product_reviews = ProductReview::with('product', 'user')->latest()->paginate(10);
        return view('backend.pages.review.reviews_list', compact('product_reviews'));
    }

    /**
     * Display the specified review.
     */
    public function admin_review_view($review_id)
    {
        $review = ProductReview::findOrFail($review_id);
        return view('backend.pages.review.review_view', compact('review'));
    }

    /**
     * Show the form for editing the specific review.
     */
    public function admin_review_edit($review_id)
    {
        $review = ProductReview::findOrFail($review_id);
        return view('backend.pages.review.review_edit', compact('review'));
    }

    /**
     * Update the specified review in storage.
     */
    public function admin_review_update(Request $request, $review_id)
    {
        $request->validate(['status' => 'required']);
        $review = ProductReview::findOrFail($review_id);
        $review->update([
            'status' => $request->status
        ]);
        session()->flash('success', 'Review successfully updated');
        return redirect()->back();
    }

    /**
     * Remove the specified review from storage.
     */
    public function admin_review_delete($review_id)
    {
        ProductReview::findOrFail($review_id)->delete();
        session()->flash('success', 'Review successfully deleted');
        return redirect()->route('admin.reviews.list');
    }
}
