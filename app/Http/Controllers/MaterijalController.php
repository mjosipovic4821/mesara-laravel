<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaterijalStoreRequest;
use App\Http\Requests\MaterijalUpdateRequest;
use App\Models\Materijal;
use Illuminate\Http\Request;

class MaterijalController extends Controller
{
    public function index(Request $request)
    {
        $materijals = Materijal::all();

        return view('materijal.index', [
            'materijals' => $materijals,
        ]);
    }

    public function create(Request $request)
    {
        return view('materijal.create');
    }

    public function store(MaterijalStoreRequest $request)
    {
        $materijal = Materijal::create($request->validated());

        $request->session()->flash('materijal.id', $materijal->id);

        return redirect()->route('materijals.index');
    }

    public function show(Request $request, Materijal $materijal)
    {
        return view('materijal.show', [
            'materijal' => $materijal,
        ]);
    }

    public function edit(Request $request, Materijal $materijal)
    {
        return view('materijal.edit', [
            'materijal' => $materijal,
        ]);
    }

    public function update(MaterijalUpdateRequest $request, Materijal $materijal)
    {
        $materijal->update($request->validated());

        $request->session()->flash('materijal.id', $materijal->id);

        return redirect()->route('materijals.index');
    }

    public function destroy(Request $request, Materijal $materijal)
    {
        $materijal->delete();

        return redirect()->route('materijals.index');
    }
}
