<?php

namespace Tests\Feature;

use App\Models\Kupac;
use App\Models\Proizvod;
use App\Models\Radnik;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NarudzbinaFeatureTest extends TestCase
{
    use RefreshDatabase;

    private function openOrderFormToInitSession(): void
    {
        // Ovo “zagrejavanje” pokrene web session i CSRF cookie kao u browseru
        $this->get('/narudzbina')->assertStatus(200);
    }

    public function test_can_create_invoice_via_public_order_flow(): void
    {
        $kupac = Kupac::factory()->create();
        $radnik = Radnik::factory()->create();

        $p1 = Proizvod::factory()->create([
            'aktivan' => true,
            'prodajna_cena' => 500,
            'zaliha' => 10,
        ]);

        $p2 = Proizvod::factory()->create([
            'aktivan' => true,
            'prodajna_cena' => 800,
            'zaliha' => 5,
        ]);

        $this->openOrderFormToInitSession();

        $response = $this->post('/narudzbina', [
            '_token' => csrf_token(),
            'kupac_id' => $kupac->id,
            'radnik_id' => $radnik->id,
            'napomena' => 'Test narudžbina',
            'items' => [
                ['proizvod_id' => $p1->id, 'kolicina' => 2],
                ['proizvod_id' => $p2->id, 'kolicina' => 1],
            ],
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('fakturas', [
            'kupac_id' => $kupac->id,
            'radnik_id' => $radnik->id,
        ]);

        $this->assertDatabaseHas('stavka_faktures', [
            'proizvod_id' => $p1->id,
            'kolicina' => 2,
        ]);

        $this->assertDatabaseHas('proizvods', [
            'id' => $p1->id,
            'zaliha' => 8,
        ]);
    }

    public function test_validation_fails_when_items_are_missing(): void
    {
        $kupac = Kupac::factory()->create();
        $radnik = Radnik::factory()->create();

        $this->openOrderFormToInitSession();

        $response = $this->from('/narudzbina')->post('/narudzbina', [
            '_token' => csrf_token(),
            'kupac_id' => $kupac->id,
            'radnik_id' => $radnik->id,
            'items' => [],
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/narudzbina');
        $response->assertSessionHasErrors(['items']);
    }
}
