<?php

namespace App\Http\Controllers;

use App\Models\Proizvod;
use Illuminate\Http\Request;

class PublicProizvodController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->string('q')->toString();

        $proizvodi = Proizvod::query()
            ->where('aktivan', true)
            ->when($q !== '', fn ($query) => $query->where('naziv_proizvoda', 'like', "%{$q}%"))
            ->orderBy('naziv_proizvoda')
            ->paginate(10)
            ->withQueryString();

        return view('public.proizvodi.index', compact('proizvodi', 'q'));
    }

    public function show(Proizvod $proizvod)
    {
        abort_unless($proizvod->aktivan, 404);

        return view('public.proizvodi.show', compact('proizvod'));
    }
}
