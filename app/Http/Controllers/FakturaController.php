<?php

namespace App\Http\Controllers;

use App\Http\Requests\FakturaStoreRequest;
use App\Http\Requests\FakturaUpdateRequest;
use App\Models\Faktura;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FakturaController extends Controller
{
    public function index(Request $request)
    {
        $fakturas = Faktura::all();

        return view('faktura.index', [
            'fakturas' => $fakturas,
        ]);
    }

    public function create(Request $request)
    {
        return view('faktura.create');
    }

    public function store(FakturaStoreRequest $request)
    {
        $faktura = Faktura::create($request->validated());

        $request->session()->flash('faktura.id', $faktura->id);

        return redirect()->route('fakturas.index');
    }

    public function show(Request $request, Faktura $faktura)
    {
        return view('faktura.show', [
            'faktura' => $faktura,
        ]);
    }

    public function edit(Request $request, Faktura $faktura)
    {
        return view('faktura.edit', [
            'faktura' => $faktura,
        ]);
    }

    public function update(FakturaUpdateRequest $request, Faktura $faktura)
    {
        $faktura->update($request->validated());

        $request->session()->flash('faktura.id', $faktura->id);

        return redirect()->route('fakturas.index');
    }

    public function destroy(Request $request, Faktura $faktura)
    {
        $faktura->delete();

        return redirect()->route('fakturas.index');
    }
}
