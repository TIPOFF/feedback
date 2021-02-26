<?php

declare(strict_types=1);

namespace Tipoff\Feedback\Http\Controllers\Web;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Tipoff\Feedback\Http\Requests\Web\Feedback\UpdateFeedbackRequest;
use Tipoff\Feedback\Models\Feedback;

class FeedbackController extends Controller
{
    public function index()
    {
        return view('feedback.index');
    }

    public function response(Request $request)
    {
        $rating = $request->query('rating');
        $token = $request->query('token');
        if (empty($rating) || empty($token)) {
            return redirect()->route('feedback');
        }
        $feedback = Feedback::where('token', $token)->first();
        if (empty($feedback)) {
            return redirect()->route('feedback');
        }

        // Only save the current datetime if it is the first time the user clicked the link in the email
        if ($rating == 'positive') {
            if (empty($feedback->clicked_positive_at)) {
                $feedback->clicked_positive_at = Carbon::now('UTC');
                $feedback->save();
            }
            $review_link = '/feedback/review?token='.$token;
            $external_redirect = url('/feedback/external?token='.$token);

            return view('feedback.positive', [
                'feedback' => $feedback,
                'market' => $feedback->location->market,
                'review_link' => $review_link,
                'external_redirect' => $external_redirect,
            ]);
        }

        if ($rating == 'negative') {
            if (empty($feedback->clicked_negative_at)) {
                $feedback->clicked_negative_at = Carbon::now('UTC');
                $feedback->save();
            }

            return redirect()->route('feedback.internal', ['token' => $token]);
        }

        if ($rating == 'seminegative') {
            if (empty($feedback->clicked_semi_negative_at)) {
                $feedback->clicked_semi_negative_at = Carbon::now('UTC');
                $feedback->save();
            }

            return redirect()->route('feedback.internal', ['token' => $token]);
        }

        if ($rating == 'semipositive') {
            if (empty($feedback->clicked_semi_positive_at)) {
                $feedback->clicked_semi_positive_at = Carbon::now('UTC');
                $feedback->save();
            }

            return redirect()->route('feedback.internal', ['token' => $token]);
        }
    }

    public function review(Request $request)
    {
        $token = $request->query('token');
        if (empty($token)) {
            return redirect()->route('feedback');
        }
        $feedback = Feedback::where('token', $token)->first();
        if (empty($feedback)) {
            return redirect()->route('feedback');
        }
        // Only save the current datetime if it is the first time the user clicked the link to review on Google My Business
        if (empty($feedback->clicked_review_at)) {
            $feedback->clicked_review_at = Carbon::now('UTC');
            $feedback->save();
        }

        return redirect()->to($feedback->location->review_url);
    }

    public function external(Request $request)
    {
        $token = $request->query('token');
        if (empty($token)) {
            return redirect()->route('feedback');
        }
        $feedback = Feedback::where('token', $token)->first();
        if (empty($feedback)) {
            return redirect()->route('feedback');
        }
        // Only save the current datetime if it is the first time the user is being redirected to Google My Business
        if (empty($feedback->redirected_at)) {
            $feedback->redirected_at = Carbon::now('UTC');
            $feedback->save();
        }

        return redirect()->to($feedback->location->review_url);
    }

    public function internal(Request $request)
    {
        $token = $request->query('token');
        if (empty($token)) {
            return redirect()->route('feedback');
        }
        $feedback = Feedback::where('token', $token)->first();
        if (empty($feedback)) {
            return redirect()->route('feedback');
        }

        return view('feedback.internal', [
            'feedback' => $feedback,
            'market' => $feedback->location->market,
        ]);
    }

    public function update(UpdateFeedbackRequest $request, Feedback $feedback)
    {

        // Save the message that the user posts
        $feedback->message = $request->message;
        $feedback->submitted_at = Carbon::now();
        $feedback->save();

        return redirect()->route('feedback.thanks');
    }

    public function thanks()
    {
        return view('feedback.thanks');
    }
}
