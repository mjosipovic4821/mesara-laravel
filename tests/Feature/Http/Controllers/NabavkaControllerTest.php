<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Dobavljac;
use App\Models\Nabavka;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\NabavkaController
 */
final class NabavkaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $nabavkas = Nabavka::factory()->count(3)->create();

        $response = $this->get(route('nabavkas.index'));

        $response->assertOk();
        $response->assertViewIs('nabavka.index');
        $response->assertViewHas('nabavkas', $nabavkas);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('nabavkas.create'));

        $response->assertOk();
        $response->assertViewIs('nabavka.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\NabavkaController::class,
            'store',
            \App\Http\Requests\NabavkaStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $dobavljac = Dobavljac::factory()->create();
        $datum_nabavke = Carbon::parse(fake()->date());

        $response = $this->post(route('nabavkas.store'), [
            'dobavljac_id' => $dobavljac->id,
            'datum_nabavke' => $datum_nabavke->toDateString(),
        ]);

        $nabavkas = Nabavka::query()
            ->where('dobavljac_id', $dobavljac->id)
            ->where('datum_nabavke', $datum_nabavke)
            ->get();
        $this->assertCount(1, $nabavkas);
        $nabavka = $nabavkas->first();

        $response->assertRedirect(route('nabavkas.index'));
        $response->assertSessionHas('nabavka.id', $nabavka->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $nabavka = Nabavka::factory()->create();

        $response = $this->get(route('nabavkas.show', $nabavka));

        $response->assertOk();
        $response->assertViewIs('nabavka.show');
        $response->assertViewHas('nabavka', $nabavka);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $nabavka = Nabavka::factory()->create();

        $response = $this->get(route('nabavkas.edit', $nabavka));

        $response->assertOk();
        $response->assertViewIs('nabavka.edit');
        $response->assertViewHas('nabavka', $nabavka);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\NabavkaController::class,
            'update',
            \App\Http\Requests\NabavkaUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $nabavka = Nabavka::factory()->create();
        $dobavljac = Dobavljac::factory()->create();
        $datum_nabavke = Carbon::parse(fake()->date());

        $response = $this->put(route('nabavkas.update', $nabavka), [
            'dobavljac_id' => $dobavljac->id,
            'datum_nabavke' => $datum_nabavke->toDateString(),
        ]);

        $nabavka->refresh();

        $response->assertRedirect(route('nabavkas.index'));
        $response->assertSessionHas('nabavka.id', $nabavka->id);

        $this->assertEquals($dobavljac->id, $nabavka->dobavljac_id);
        $this->assertEquals($datum_nabavke, $nabavka->datum_nabavke);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $nabavka = Nabavka::factory()->create();

        $response = $this->delete(route('nabavkas.destroy', $nabavka));

        $response->assertRedirect(route('nabavkas.index'));

        $this->assertModelMissing($nabavka);
    }
}
