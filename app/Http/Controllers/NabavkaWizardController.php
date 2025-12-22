<?php

namespace App\Http\Controllers;

use App\Http\Requests\NabavkaWizardStoreRequest;
use App\Models\Dobavljac;
use App\Models\Materijal;
use App\Models\Nabavka;
use App\Models\StavkaNabavke;
use Illuminate\Support\Facades\DB;

class NabavkaWizardController extends Controller
{
    public function create()
    {
        $dobavljacs = Dobavljac::orderBy('naziv')->get();
        $materijals = Materijal::orderBy('naziv')->get();

        return view('nabavka.wizard', compact('dobavljacs', 'materijals'));
    }

    public function store(NabavkaWizardStoreRequest $request)
    {
        $data = $request->validated();

        return DB::transaction(function () use ($data) {
            $nabavka = Nabavka::create([
                'dobavljac_id' => $data['dobavljac_id'],
                'datum_nabavke' => $data['datum_nabavke'],
                'napomena' => $data['napomena'] ?? null,
                'ukupno' => 0,
            ]);

            $ukupno = 0;

            foreach ($data['items'] as $item) {
                $iznos = (float) $item['kolicina'] * (float) $item['cena_po_jedinici'];
                $ukupno += $iznos;

                StavkaNabavke::create([
                    'nabavka_id' => $nabavka->id,
                    'materijal_id' => $item['materijal_id'],
                    'kolicina' => $item['kolicina'],
                    'cena_po_jedinici' => $item['cena_po_jedinici'],
                    'iznos' => $iznos,
                ]);

                // ažuriranje zaliha materijala (bonus, ali super za poene)
                Materijal::whereKey($item['materijal_id'])->increment('zaliha', $item['kolicina']);
            }

            $nabavka->update(['ukupno' => $ukupno]);

            return redirect()
                ->route('nabavkas.show', $nabavka) // koristi postojeći resource show
                ->with('success', 'Nabavka je uspešno sačuvana.');
        });
    }
}
