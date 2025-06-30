<?php

use App\Models\User;
use App\Models\Barang;
use App\Filament\Resources\BarangResource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Livewire\livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->actingAs(User::factory()->create());
});

describe('authenticates user using barang resource', function () {
    it('can show index page', function () {
        $this->get(BarangResource::getUrl('index'))->assertSuccessful();
    });

    it('can access create page', function () {
        $this->get(BarangResource::getUrl('create'))->assertSuccessful();
    });

    it('can create barang', function () {
        $newData = Barang::factory()->make();

        livewire(BarangResource\Pages\CreateBarang::class)
            ->fillForm([
                'nama' => $newData->nama,
                'barcode' => $newData->barcode,
                'satuan' => $newData->satuan,
                'version' => $newData->version,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('barangs', [
            'nama' => $newData->nama,
            'barcode' => $newData->barcode,
            'satuan' => $newData->satuan,
            'version' => $newData->version,
        ]);
    });

    it('can edit barang', function () {
        $barang = Barang::factory()->create();
        $newData = Barang::factory()->make();

        livewire(BarangResource\Pages\EditBarang::class, [
            'record' => $barang->getRouteKey(),
        ])
            ->fillForm([
                'nama' => $newData->nama,
                'barcode' => $newData->barcode,
                'satuan' => $newData->satuan,
                'version' => $newData->version,
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        expect($barang->refresh())
            ->nama->toBe($newData->nama)
            ->barcode->toBe($newData->barcode)
            ->satuan->toBe($newData->satuan)
            ->version->toBe($newData->version);
    });
});