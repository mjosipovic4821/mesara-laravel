<?php

namespace App\Http\Controllers;

use App\Http\Requests\RasporedStoreRequest;
use App\Models\Radnik;
use App\Models\Raspored;
use Illuminate\Http\Request;

class RasporedController extends Controller
{
    public function index(Request $request)
    {
        $weekStart = $request->get('week_start', now()->startOfWeek()->toDateString());

        $radnici = Radnik::orderBy('prezime')->orderBy('ime')->get();

        $rasporedi = Raspored::with('radnik')
            ->where('week_start', $weekStart)
            ->orderBy('dan')
            ->orderBy('radnik_id')
            ->get();

        return view('raspored.index', [
            'weekStart' => $weekStart,
            'radnici' => $radnici,
            'rasporedi' => $rasporedi,
        ]);
    }

    public function store(RasporedStoreRequest $request)
    {
        $data = $request->validated();

        // update-or-create po unique(radnik_id, week_start, dan)
        Raspored::updateOrCreate(
            [
                'radnik_id' => $data['radnik_id'],
                'week_start' => $data['week_start'],
                'dan' => $data['dan'],
            ],
            [
                'smena' => $data['smena'],
                'zadatak' => $data['zadatak'] ?? null,
            ]
        );

        return redirect()
            ->route('raspored.index', ['week_start' => $data['week_start']])
            ->with('success', 'Raspored je sačuvan.');
    }
}
