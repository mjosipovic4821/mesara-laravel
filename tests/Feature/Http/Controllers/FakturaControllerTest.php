<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Faktura;
use App\Models\Kupac;
use App\Models\KupacRadnik;
use App\Models\Radnik;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\FakturaController
 */
final class FakturaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $fakturas = Faktura::factory()->count(3)->create();

        $response = $this->get(route('fakturas.index'));

        $response->assertOk();
        $response->assertViewIs('faktura.index');
        $response->assertViewHas('fakturas', $fakturas);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('fakturas.create'));

        $response->assertOk();
        $response->assertViewIs('faktura.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FakturaController::class,
            'store',
            \App\Http\Requests\FakturaStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $kupac = Kupac::factory()->create();
        $radnik = Radnik::factory()->create();
        $datum = Carbon::parse(fake()->date());
        $kupac_radnik = KupacRadnik::factory()->create();

        $response = $this->post(route('fakturas.store'), [
            'kupac_id' => $kupac->id,
            'radnik_id' => $radnik->id,
            'datum' => $datum->toDateString(),
            'kupac_radnik_id' => $kupac_radnik->id,
        ]);

        $fakturas = Faktura::query()
            ->where('kupac_id', $kupac->id)
            ->where('radnik_id', $radnik->id)
            ->where('datum', $datum)
            ->where('kupac_radnik_id', $kupac_radnik->id)
            ->get();
        $this->assertCount(1, $fakturas);
        $faktura = $fakturas->first();

        $response->assertRedirect(route('fakturas.index'));
        $response->assertSessionHas('faktura.id', $faktura->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $faktura = Faktura::factory()->create();

        $response = $this->get(route('fakturas.show', $faktura));

        $response->assertOk();
        $response->assertViewIs('faktura.show');
        $response->assertViewHas('faktura', $faktura);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $faktura = Faktura::factory()->create();

        $response = $this->get(route('fakturas.edit', $faktura));

        $response->assertOk();
        $response->assertViewIs('faktura.edit');
        $response->assertViewHas('faktura', $faktura);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FakturaController::class,
            'update',
            \App\Http\Requests\FakturaUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $faktura = Faktura::factory()->create();
        $kupac = Kupac::factory()->create();
        $radnik = Radnik::factory()->create();
        $datum = Carbon::parse(fake()->date());
        $kupac_radnik = KupacRadnik::factory()->create();

        $response = $this->put(route('fakturas.update', $faktura), [
            'kupac_id' => $kupac->id,
            'radnik_id' => $radnik->id,
            'datum' => $datum->toDateString(),
            'kupac_radnik_id' => $kupac_radnik->id,
        ]);

        $faktura->refresh();

        $response->assertRedirect(route('fakturas.index'));
        $response->assertSessionHas('faktura.id', $faktura->id);

        $this->assertEquals($kupac->id, $faktura->kupac_id);
        $this->assertEquals($radnik->id, $faktura->radnik_id);
        $this->assertEquals($datum, $faktura->datum);
        $this->assertEquals($kupac_radnik->id, $faktura->kupac_radnik_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $faktura = Faktura::factory()->create();

        $response = $this->delete(route('fakturas.destroy', $faktura));

        $response->assertRedirect(route('fakturas.index'));

        $this->assertModelMissing($faktura);
    }
}
