<?php

declare(strict_types=1);

use App\Models\Concert;

use function Pest\Laravel\get;

it('renders the home page with the concerts', function () {
    $concerts = Concert::factory(2)->create();

    get(route('home'))
        ->assertOk()
        ->assertSee('Nos concerts')
        ->assertSee($concerts[0]->title)
        ->assertSee($concerts[0]->excerpt)
        ->assertSee(route('concerts.show', $concerts[1]));
});

it('shows the concerts in position order', function () {
    Concert::factory()->create(['title' => 'Deuxième', 'position' => 2]);
    Concert::factory()->create(['title' => 'Premier', 'position' => 1]);

    get(route('home'))
        ->assertOk()
        ->assertSeeInOrder(['Premier', 'Deuxième']);
});

it('falls back to the default photos when there are no concerts', function () {
    get(route('home'))
        ->assertOk()
        ->assertSee('assets/img/concert-2.jpg');
});

it('renders a concert page', function () {
    $concert = Concert::factory()->create([
        'description' => '<p>Un <strong>superbe</strong> concert.</p>',
    ]);

    get(route('concerts.show', $concert))
        ->assertOk()
        ->assertSee($concert->title)
        ->assertSee('<strong>superbe</strong>', escape: false);
});

it('strips unsafe html from the description', function () {
    $concert = Concert::factory()->create([
        'description' => '<p>Bonjour</p><script>alert(1)</script>',
    ]);

    get(route('concerts.show', $concert))
        ->assertOk()
        ->assertSee('Bonjour')
        ->assertDontSee('<script>alert(1)</script>', escape: false);
});

it('returns 404 for an unknown concert', function () {
    get('/concerts/999')->assertNotFound();
});
