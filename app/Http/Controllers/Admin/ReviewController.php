<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.reviews.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReviewRequest $request)
    {
        $params = $request->all();
        unset($params['image']);
        if($request->has('image')){
            $path = $request->file('image')->store('reviews');
            $params['image'] = $path;
        }
        Review::create($params);

        session()->flash('success', 'Отзыв добавлен ' . $request->title);
        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function edit(Review $review)
    {
        return view('auth.reviews.form', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReviewRequest $request, Review $review)
    {
        $params = $request->all();
        unset($params['image']);
        if ($request->has('image')) {
            Storage::delete($review->image);
            $params['image'] = $request->file('image')->store('reviews');
        }

        $review->update($params);

        session()->flash('success', 'Отзыв ' . $request->title . ' обновлен');
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();
        session()->flash('success', 'Отзыв ' . $review->title . ' удален');
        return redirect()->route('dashboard');
    }
}
