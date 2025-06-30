<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Filament\Resources\GudangResource;
use App\Models\Gudang;

use function Pest\Livewire\livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->actingAs(User::factory()->create());
});

describe('authenticated user using gudang resource', function () {
    it('can show index page', function () {
        $this->get(GudangResource::getUrl('index'))->assertSuccessful();
    });

    it('can access create page', function () {
        $this->get(GudangResource::getUrl('create'))->assertSuccessful();
    });
});

describe('authenticated user using gudang resource', function () {
    it('can create Gudang', function () {
        $newData = Gudang::factory()->make();

        livewire(GudangResource\Pages\CreateGudang::class)
            ->fillForm([
                'nama' => $newData->nama,
                'status' => $newData->status,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas(
            Gudang::class,
            [
                'nama' => $newData->nama,
                'status' => $newData->status,
            ]
        );
    });
});

describe('authenticated user using gudang resource', function () {
    it('can edit Gudang', function () {
        $gudang = Gudang::factory()->create();
        $newData = Gudang::factory()->make();

        livewire(GudangResource\Pages\EditGudang::class, [
            'record' => $gudang->getRouteKey(),
        ])
            ->fillForm([
                'nama' => $newData->nama,
                'status' => $newData->status,
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        expect($gudang->refresh())
            ->nama->toBe($newData->nama)
            ->status->toBe($newData->status);
    });
});