<?php

namespace App\Http\Controllers;

use App\Http\Requests\NabavkaStoreRequest;
use App\Http\Requests\NabavkaUpdateRequest;
use App\Models\Nabavka;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NabavkaController extends Controller
{
    public function index(Request $request): Response
    {
        $nabavkas = Nabavka::all();

        return view('nabavka.index', [
            'nabavkas' => $nabavkas,
        ]);
    }

    public function create(Request $request): Response
    {
        return view('nabavka.create');
    }

    public function store(NabavkaStoreRequest $request): Response
    {
        $nabavka = Nabavka::create($request->validated());

        $request->session()->flash('nabavka.id', $nabavka->id);

        return redirect()->route('nabavkas.index');
    }

    public function show(Request $request, Nabavka $nabavka): Response
    {
        return view('nabavka.show', [
            'nabavka' => $nabavka,
        ]);
    }

    public function edit(Request $request, Nabavka $nabavka): Response
    {
        return view('nabavka.edit', [
            'nabavka' => $nabavka,
        ]);
    }

    public function update(NabavkaUpdateRequest $request, Nabavka $nabavka): Response
    {
        $nabavka->update($request->validated());

        $request->session()->flash('nabavka.id', $nabavka->id);

        return redirect()->route('nabavkas.index');
    }

    public function destroy(Request $request, Nabavka $nabavka): Response
    {
        $nabavka->delete();

        return redirect()->route('nabavkas.index');
    }
}
