<?php

namespace App\Http\Controllers\backend;

use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Models\SubscribeNewsletter;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{
    /**
     * Admin Feedback lists
     */
    public function feedbacks_list()
    {
        $feedbacks = Feedback::paginate(10);
        return view('backend.pages.feedback.feedback_list', compact('feedbacks'));
    }
    public function feedback_view($feedback_id)
    {
        $feedback = Feedback::findOrFail($feedback_id);
        return view('backend.pages.feedback.feedback_view', compact('feedback'));
    }
    public function feedback_edit($feedback_id)
    {
        $feedback = Feedback::findOrFail($feedback_id);
        return view('backend.pages.feedback.feddback_edit', compact('feedback'));
    }
    public function feedback_update(Request $request, $feedback_id)
    {
        $request->validate(['status' => 'required']);
        $feedback = Feedback::findOrFail($feedback_id);
        $feedback->update([
            'status' => $request->status
        ]);
        return back()->with('success', 'Feedback updated successfully');
    }
    public function feedback_delete($feedback_id)
    {
        Feedback::findOrFail($feedback_id)->delete();
        session()->flash('success', 'Feedback deleted successfully');
        return redirect()->back();
    }
    public function subscription_emails()
    {
        $subscriptions = SubscribeNewsletter::latest()->paginate(10);
        return view('backend.pages.subscription_emails', compact('subscriptions'));
    }
}
