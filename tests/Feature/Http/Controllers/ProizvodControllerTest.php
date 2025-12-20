<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Proizvod;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProizvodController
 */
final class ProizvodControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $proizvods = Proizvod::factory()->count(3)->create();

        $response = $this->get(route('proizvods.index'));

        $response->assertOk();
        $response->assertViewIs('proizvod.index');
        $response->assertViewHas('proizvods', $proizvods);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('proizvods.create'));

        $response->assertOk();
        $response->assertViewIs('proizvod.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProizvodController::class,
            'store',
            \App\Http\Requests\ProizvodStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $naziv_proizvoda = fake()->word();
        $prodajna_cena = fake()->randomFloat(/** decimal_attributes **/);
        $zaliha = fake()->randomFloat(/** decimal_attributes **/);
        $aktivan = fake()->boolean();

        $response = $this->post(route('proizvods.store'), [
            'naziv_proizvoda' => $naziv_proizvoda,
            'prodajna_cena' => $prodajna_cena,
            'zaliha' => $zaliha,
            'aktivan' => $aktivan,
        ]);

        $proizvods = Proizvod::query()
            ->where('naziv_proizvoda', $naziv_proizvoda)
            ->where('prodajna_cena', $prodajna_cena)
            ->where('zaliha', $zaliha)
            ->where('aktivan', $aktivan)
            ->get();
        $this->assertCount(1, $proizvods);
        $proizvod = $proizvods->first();

        $response->assertRedirect(route('proizvods.index'));
        $response->assertSessionHas('proizvod.id', $proizvod->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $proizvod = Proizvod::factory()->create();

        $response = $this->get(route('proizvods.show', $proizvod));

        $response->assertOk();
        $response->assertViewIs('proizvod.show');
        $response->assertViewHas('proizvod', $proizvod);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $proizvod = Proizvod::factory()->create();

        $response = $this->get(route('proizvods.edit', $proizvod));

        $response->assertOk();
        $response->assertViewIs('proizvod.edit');
        $response->assertViewHas('proizvod', $proizvod);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProizvodController::class,
            'update',
            \App\Http\Requests\ProizvodUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $proizvod = Proizvod::factory()->create();
        $naziv_proizvoda = fake()->word();
        $prodajna_cena = fake()->randomFloat(/** decimal_attributes **/);
        $zaliha = fake()->randomFloat(/** decimal_attributes **/);
        $aktivan = fake()->boolean();

        $response = $this->put(route('proizvods.update', $proizvod), [
            'naziv_proizvoda' => $naziv_proizvoda,
            'prodajna_cena' => $prodajna_cena,
            'zaliha' => $zaliha,
            'aktivan' => $aktivan,
        ]);

        $proizvod->refresh();

        $response->assertRedirect(route('proizvods.index'));
        $response->assertSessionHas('proizvod.id', $proizvod->id);

        $this->assertEquals($naziv_proizvoda, $proizvod->naziv_proizvoda);
        $this->assertEquals($prodajna_cena, $proizvod->prodajna_cena);
        $this->assertEquals($zaliha, $proizvod->zaliha);
        $this->assertEquals($aktivan, $proizvod->aktivan);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $proizvod = Proizvod::factory()->create();

        $response = $this->delete(route('proizvods.destroy', $proizvod));

        $response->assertRedirect(route('proizvods.index'));

        $this->assertModelMissing($proizvod);
    }
}
