<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuMobile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuMobileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $menus = [
            [
                'name' => 'Scan',
                'urutan' => 1
            ],
            [
                'name' => 'Cari Alat',
                'urutan' => 2
            ],
            [
                'name' => 'Checklist Perawatan',
                'urutan' => 3
            ],
            [
                'name' => 'Daftar Perbaikan',
                'urutan' => 4
            ],
            [
                'name' => 'Approval Perbaikan (Operator)',
                'urutan' => 5
            ],
            [
                'name' => 'Approval Perbaikan (Manajer)',
                'urutan' => 6
            ],
            [
                'name' => 'Approval Perawatan (Operator)',
                'urutan' => 7
            ],
            [
                'name' => 'Approval Perawatan (Manajer)',
                'urutan' => 8
            ],
            [
                'name' => 'Permohonan Set Up',
                'urutan' => 9
            ],
            [
                'name' => 'Pemenuhan Set Up',
                'urutan' => 10
            ],
            [
                'name' => 'Approval Pemenuhan Set Up (QA)',
                'urutan' => 11
            ],
            [
                'name' => 'Approval Pemenuhan Set Up (Manajer)',
                'urutan' => 12
            ],
        ];

        foreach ($menus as $item) {
            $slug = Str::slug($item['name']);
            $menu = MenuMobile::firstOrNew([
                'code' => $slug
            ]);
            $menu->name   = $item['name'];
            $menu->urutan = $item['urutan'];
            $menu->save();
        }
    }
}
