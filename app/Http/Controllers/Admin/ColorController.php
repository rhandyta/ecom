<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorFormRequest;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::orderBy('id', 'DESC')->paginate(50);
        return view('admin.color.index', compact('colors'));
    }

    public function create()
    {
        return view('admin.color.create');
    }

    public function store(ColorFormRequest $request)
    {
        $validatedData = $request->validated();
        Color::create([
            'name' => $validatedData['name'],
            'code' => $validatedData['code'],
            'status' => $request->status == true ? 1 : 0,
        ]);
        return redirect()->route('color.index')->with('message', 'Color has been added successfully');
    }

    public function edit(Color $color)
    {
        return view('admin.color.edit', compact('color'));
    }

    public function update(ColorFormRequest $request, $id)
    {
        $validatedData = $request->validated();
        Color::findOrFail($id)->update([
            'name' => $validatedData['name'],
            'code' => $validatedData['code'],
            'status' => $request->status == true ? 1 : 0,
        ]);
        return redirect()->route('color.index')->with('message', 'Color has been updated successfully');
    }

    public function destroy($id)
    {
        Color::findOrFail($id)->delete();
        return redirect()->route('color.index')->with('message', 'Color has been deleted successfully');
    }
}
