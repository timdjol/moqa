<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.sliders.form');
    }

    /**
     * Store a newly created resource in storage.
     * @param SliderRequest $request
     * @return RedirectResponse
     */
    public function store(SliderRequest $request)
    {
        $params = $request->all();
        unset($params['image']);
        if($request->has('image')){
            $path = $request->file('image')->store('sliders');
            $params['image'] = $path;
        }
        Slider::create($params);

        session()->flash('success', 'Слайд добавлен ' . $request->title);
        return redirect()->route('dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Slider $slider
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Slider $slider)
    {
        return view('auth.sliders.form', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     * @param SliderRequest $request
     * @param Slider $slider
     * @return RedirectResponse
     */
    public function update(SliderRequest $request, Slider $slider)
    {
        $params = $request->all();
        unset($params['image']);
        if ($request->has('image')) {
            Storage::delete($slider->image);
            $params['image'] = $request->file('image')->store('sliders');
        }

        $slider->update($params);

        session()->flash('success', 'Слайд ' . $request->title . ' обновлен');
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     * @param Slider $slider
     * @return RedirectResponse
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        session()->flash('success', 'Слайд ' . $slider->title . ' удален');
        return redirect()->route('dashboard');
    }
}
