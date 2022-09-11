<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Requests\SliderFormRequest;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('created_at', 'DESC')->paginate(50);
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(SliderFormRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $path = 'uploads/sliders/';
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . \Str::random(5) . '.' . $ext;
            $file->move($path, $filename);
            $validatedData['image'] = $path . $filename;
        }
        $validatedData['status'] = $request->status == true ? 1 : 0;
        Slider::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'],
            'status' => $validatedData['status'],
        ]);

        return redirect()->route('slider.index')->with('message', 'Slider has been added successfully');
    }

    public function edit(Slider $slider)
    {
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(SliderFormRequest $request, Slider $slider)
    {
        $validatedData = $request->validated();
        $existingFile = File::exists($slider->image);
        if ($request->hasFile('image')) {
            if ($existingFile) {
                File::delete($slider->image);
            }
            $path = 'uploads/sliders/';
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . \Str::random(5) . '.' . $ext;
            $file->move($path, $filename);
            $validatedData['image'] = $path . $filename;
        }
        $validatedData['status'] = $request->status == true ? 1 : 0;
        $slider->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'] ?? $slider->image,
            'status' => $validatedData['status'],
        ]);

        return redirect()->route('slider.index')->with('message', 'Slider has been updated successfully');
    }

    public function destroy(Slider $slider)
    {
        if (File::exists($slider->image)) {
            File::delete($slider->image);
        }
        $slider->delete();
        return redirect()->route('slider.index')->with('message', 'Slider has been deleted successfully');
    }
}
