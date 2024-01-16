<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFeedbackRequest as RequestsStoreFeedbackRequest;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Resources\FeedbackCollection;
use App\Http\Resources\FeedbackResource;
use App\Http\Requests\StoreFeedbackRequest;
use App\Http\Requests\UpdateFeedbackRequest;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    //

    public function index(Request $request)
    {
        $feedbacks = Feedback::orderBy('created_at', 'desc')->get();
        $feedbacks->load('user', 'category', 'comments');
        return new FeedbackCollection($feedbacks);
    }

    public function show(Feedback $feedback)
    {
        return new FeedbackResource($feedback);
    }

    public function store(StoreFeedbackRequest $request)
    {
        $user = Auth::user();
        $request['user_id'] = $user->id;
        $feedback = Feedback::create($request->all());
        return new FeedbackResource($feedback);
    }

    public function update(UpdateFeedbackRequest $request, Feedback $feedback)
    {
        $feedback->update($request->all());
        return new FeedbackResource(Feedback::find($feedback->id));
    }

    public function destory(Feedback $feedback)
    {
        $user = Auth::user();
        if ($user->id !== $feedback) {
            return response()->json([
                "message" => "You are not allowed to delete this feedback"
            ], 422);
        }
        $feedback->destroy($feedback);
        return response()->json([], 204);
    }
}
