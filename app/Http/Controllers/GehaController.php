<?php

namespace App\Http\Controllers;

use App\Models\Geha;
use Illuminate\Http\Request;

class GehaController extends Controller
{
    public function index()
    {
        $gehas = Geha::get();
        return view('admin.geha.geha', compact('gehas'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'number' => 'nullable',
        ]);

        Geha::create([
            'name' => $request->name,
            'number' => $request->number,
            'user_name' => auth()->user()->name,
        ]);

        return back()->with('success', 'تمت الإضافة بنجاح');
    }

    public function update(Request $request, $id)
    {
        $geha = Geha::findOrFail($id);
        $geha->update([
            'name' => $request->name,
            'number' => $request->number,
        ]);

        return back()->with('success', 'تم التعديل بنجاح');
    }

    public function destroy($id)
    {
        $geha = Geha::findOrFail($id);
        $geha->delete();
        return back()->with('success', 'تم الحذف بنجاح');
    }
}
