<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
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
                'name' => 'Dashboard',
                'route_name' => 'dashboard.ownership',
                'icon' => 'fas fa-atom fs-3',
                'level' => '0',
                'sequence' => '100'
            ],
            [
                'name' => 'Inventory Management',
                'route_name' => '#',
                'icon' => 'fas fa-atom fs-3',
                'level' => '1',
                'sequence' => '200'
            ],
            [
                'name' => 'List',
                'route_name' => 'inventory.index',
                'icon' => 'bi bi-archive fs-3',
                'level' => '2',
                'sequence' => '210'
            ],
            [
                'name' => 'Qr Code',
                'route_name' => 'report.qrcode',
                'icon' => 'bi bi-archive fs-3',
                'level' => '2',
                'sequence' => '220'
            ],
            [
                'name' => 'IK Documents',
                'route_name' => 'ikdocument.index',
                'icon' => 'fas fa-atom fs-3',
                'level' => '0',
                'sequence' => '300'
            ],
            [
                'name' => 'Monitoring',
                'route_name' => '#',
                'icon' => 'fas fa-atom fs-3',
                'level' => '1',
                'sequence' => '400'
            ],
            [
                'name' => 'Form',
                'route_name' => 'monitoring.index',
                'icon' => 'bi bi-archive fs-3',
                'level' => '2',
                'sequence' => '410'
            ],
            [
                'name' => 'Kodelini',
                'route_name' => 'kodelini.index',
                'icon' => 'fas fa-atom fs-3',
                'level' => '0',
                'sequence' => '500'
            ],
            [
                'name' => 'Suku Cadang',
                'route_name' => '#',
                'icon' => 'fas fa-atom fs-3',
                'level' => '1',
                'sequence' => '500'
            ],
            [
                'name' => 'Data',
                'route_name' => 'sukucadang.index',
                'icon' => 'bi bi-archive fs-3',
                'level' => '2',
                'sequence' => '510'
            ],
            [
                'name' => 'Permintaan',
                'route_name' => 'usedmaterial.index',
                'icon' => 'bi bi-archive fs-3',
                'level' => '2',
                'sequence' => '520'
            ],
            [
                'name' => 'Qr Code',
                'route_name' => 'report.qrcode-sukucadang',
                'icon' => 'bi bi-archive fs-3',
                'level' => '2',
                'sequence' => '530'
            ],
            [
                'name' => 'Report',
                'route_name' => '#',
                'icon' => 'fas fa-atom fs-3',
                'level' => '1',
                'sequence' => '600'
            ],
            [
                'name' => 'Inventory',
                'route_name' => 'report.inventory',
                'icon' => 'bi bi-archive fs-3',
                'level' => '2',
                'sequence' => '610'
            ],
            [
                'name' => 'Usia Alat',
                'route_name' => 'report.age',
                'icon' => 'bi bi-archive fs-3',
                'level' => '2',
                'sequence' => '620'
            ],
            [
                'name' => 'Rekap Inventory',
                'route_name' => 'report.rekap-inventory',
                'icon' => 'bi bi-archive fs-3',
                'level' => '2',
                'sequence' => '630'
            ],
            [
                'name' => 'Checklist Perawatan',
                'route_name' => '#',
                'icon' => 'fas fa-atom fs-3',
                'level' => '1',
                'sequence' => '700'
            ],
            [
                'name' => 'Data',
                'route_name' => 'checklist.index',
                'icon' => 'bi bi-card-list fs-3',
                'level' => '2',
                'sequence' => '710'
            ],
            [
                'name' => 'Form',
                'route_name' => 'checklist-perawatan.index',
                'icon' => 'bi bi-card-list fs-3',
                'level' => '2',
                'sequence' => '720'
            ],
            [
                'name' => 'Assign',
                'route_name' => 'checklist-perawatan-assign.index',
                'icon' => 'bi bi-card-list fs-3',
                'level' => '2',
                'sequence' => '730'
            ],
            [
                'name' => 'Setting',
                'route_name' => '#',
                'icon' => 'fas fa-atom fs-3',
                'level' => '1',
                'sequence' => '800'
            ],
            [
                'name' => 'Akses Menu',
                'route_name' => 'setting.akses.menu.index',
                'icon' => 'bi bi-card-list fs-3',
                'level' => '2',
                'sequence' => '810'
            ],
        ];

        $parent0 = null;
        $parent1 = null;
        $parent2 = null;
        foreach ($menus as $item) {
            $menu = Menu::firstOrNew([
                'seq' => $item['sequence']
            ]);
            $menu->name       = $item['name'];
            $menu->route_name = $item['route_name'];
            $menu->icon       = $item['icon'];
            $menu->level      = $item['level'];

            $menu->seq        = $item['sequence'];
            if(in_array($item['level'], [2, 3])){
                $menu->parent_id = $parent1;
            }
            if($item['level'] == 4){
                $menu->parent_id = $parent2;
            }
            $menu->save();

            if($menu->level == 1){
                $parent1 = $menu->id;
            }
            if($menu->level == 3){
                $parent2 = $menu->id;
            }
            $menu->save();
        }
    }
}
