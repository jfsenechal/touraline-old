<?php

declare(strict_types=1);

use App\Filament\Resources\Concerts\Pages\CreateConcert;
use App\Filament\Resources\Concerts\Pages\EditConcert;
use App\Filament\Resources\Concerts\Pages\ListConcerts;
use App\Models\Concert;
use Filament\Actions\DeleteAction;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Livewire\livewire;

beforeEach(function () {
    Storage::fake('public');
});

it('can render the index page', function () {
    livewire(ListConcerts::class)
        ->assertOk();
});

it('can render the create page', function () {
    livewire(CreateConcert::class)
        ->assertOk();
});

it('can render the edit page', function () {
    $concert = Concert::factory()->create();

    livewire(EditConcert::class, [
        'record' => $concert->id,
    ])
        ->assertOk()
        ->assertSchemaStateSet([
            'title' => $concert->title,
            'excerpt' => $concert->excerpt,
        ]);
});

it('can render column', function (string $column) {
    livewire(ListConcerts::class)
        ->assertCanRenderTableColumn($column);
})->with(['position', 'image', 'title', 'excerpt', 'created_at']);

it('lists concerts by position', function () {
    $concerts = collect([3, 1, 2])->map(fn (int $position) => Concert::factory()->create(['position' => $position]));

    livewire(ListConcerts::class)
        ->loadTable()
        ->assertCanSeeTableRecords($concerts->sortBy('position'), inOrder: true);
});

it('puts a new concert at the end of the list', function () {
    Concert::factory()->create(['position' => 5]);

    expect(Concert::factory()->create()->position)->toBe(6);
});

it('can reorder concerts', function () {
    [$first, $second, $third] = Concert::factory(3)->create();

    livewire(ListConcerts::class)
        ->call('reorderTable', [(string) $third->id, (string) $first->id, (string) $second->id]);

    expect(Concert::query()->ordered()->pluck('id')->all())
        ->toBe([$third->id, $first->id, $second->id]);
});

it('can search column', function (string $column) {
    $records = Concert::factory(5)->create();

    $value = $records->first()->{$column};

    livewire(ListConcerts::class)
        ->loadTable()
        ->searchTable($value)
        ->assertCanSeeTableRecords($records->where($column, $value))
        ->assertCanNotSeeTableRecords($records->where($column, '!=', $value));
})->with(['title']);

it('can create a concert with an image', function () {
    $concert = Concert::factory()->make();

    livewire(CreateConcert::class)
        ->fillForm([
            'title' => $concert->title,
            'excerpt' => $concert->excerpt,
            'description' => $concert->description,
            'image' => UploadedFile::fake()->image('concert.jpg'),
        ])
        ->call('create')
        ->assertHasNoFormErrors()
        ->assertNotified();

    $created = Concert::query()->sole();

    expect($created->title)->toBe($concert->title)
        ->and($created->image)->toStartWith('concerts/');

    Storage::disk('public')->assertExists($created->image);
});

it('can update a concert', function () {
    $concert = Concert::factory()->create();
    $newData = Concert::factory()->make();

    livewire(EditConcert::class, [
        'record' => $concert->id,
    ])
        ->fillForm([
            'title' => $newData->title,
            'excerpt' => $newData->excerpt,
        ])
        ->call('save')
        ->assertNotified();

    assertDatabaseHas(Concert::class, [
        'id' => $concert->id,
        'title' => $newData->title,
        'excerpt' => $newData->excerpt,
    ]);
});

it('deletes the image file when the concert is deleted', function () {
    $path = UploadedFile::fake()->image('concert.jpg')->store('concerts', 'public');
    $concert = Concert::factory()->create(['image' => $path]);

    livewire(EditConcert::class, [
        'record' => $concert->id,
    ])
        ->callAction(DeleteAction::class)
        ->assertNotified()
        ->assertRedirect();

    assertDatabaseMissing($concert);
    Storage::disk('public')->assertMissing($path);
});

it('deletes the previous image file when it is replaced', function () {
    $oldPath = UploadedFile::fake()->image('old.jpg')->store('concerts', 'public');
    $concert = Concert::factory()->create(['image' => $oldPath]);

    $concert->update(['image' => 'concerts/new.jpg']);

    Storage::disk('public')->assertMissing($oldPath);
});

it('validates the form data', function (array $data, array $errors) {
    livewire(CreateConcert::class)
        ->fillForm([
            'title' => 'Concert de Noël',
            'excerpt' => 'Un extrait',
            ...$data,
        ])
        ->call('create')
        ->assertHasFormErrors($errors)
        ->assertNotNotified();
})->with([
    '`title` is required' => [['title' => null], ['title' => 'required']],
    '`title` is max 255 characters' => [['title' => Str::random(256)], ['title' => 'max']],
    '`excerpt` is required' => [['excerpt' => null], ['excerpt' => 'required']],
    '`excerpt` is max 500 characters' => [['excerpt' => Str::random(501)], ['excerpt' => 'max']],
]);
