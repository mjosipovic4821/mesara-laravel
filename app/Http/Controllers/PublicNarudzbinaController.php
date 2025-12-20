<?php

namespace App\Http\Controllers;

use App\Http\Requests\NarudzbinaStoreRequest;
use App\Models\Faktura;
use App\Models\Kupac;
use App\Models\Proizvod;
use App\Models\Radnik;
use App\Models\StavkaFakture;
use Illuminate\Support\Facades\DB;

class PublicNarudzbinaController extends Controller
{
    public function create()
    {
        $kupci = Kupac::orderBy('naziv_kupca')->get();
        $radnici = Radnik::orderBy('prezime')->get();
        $proizvodi = Proizvod::where('aktivan', true)->orderBy('naziv_proizvoda')->get();

        return view('public.narudzbina.create', compact('kupci', 'radnici', 'proizvodi'));
    }

    public function store(NarudzbinaStoreRequest $request)
    {
        $data = $request->validated();

        return DB::transaction(function () use ($data) {
            // 1) Kreiraj fakturu (bez redundantnih polja)
            $faktura = Faktura::create([
                'kupac_id' => $data['kupac_id'],
                'radnik_id' => $data['radnik_id'],
                'datum' => now()->toDateString(),
                'napomena' => $data['napomena'] ?? null,
                'ukupno' => 0,
            ]);

            $ukupno = 0;

            // 2) Kreiraj stavke
            foreach ($data['items'] as $item) {
                $proizvod = Proizvod::findOrFail($item['proizvod_id']);
                $kolicina = (float) $item['kolicina'];

                // (opciono ali realno): proveri zalihe
                if ((float) $proizvod->zaliha < $kolicina) {
                    abort(422, "Nema dovoljno zaliha za proizvod: {$proizvod->naziv_proizvoda}");
                }

                $cena = (float) $proizvod->prodajna_cena;
                $iznos = round($cena * $kolicina, 2);
                $ukupno += $iznos;

                StavkaFakture::create([
                    'faktura_id' => $faktura->id,
                    'proizvod_id' => $proizvod->id,
                    'kolicina' => $kolicina,
                    'cena' => $cena,
                    'iznos' => $iznos,
                ]);

                // smanji zalihe proizvoda
                $proizvod->zaliha = (float) $proizvod->zaliha - $kolicina;
                $proizvod->save();
            }

            // 3) Update ukupno
            $faktura->ukupno = $ukupno;
            $faktura->save();

            return redirect()->route('public.narudzbina.show', $faktura);
        });
    }

    public function show(Faktura $faktura)
    {
        $faktura->load(['kupac', 'radnik', 'stavkaFaktures.proizvod']);

        return view('public.narudzbina.show', compact('faktura'));
    }
}
