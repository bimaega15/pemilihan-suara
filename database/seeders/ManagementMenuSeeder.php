<?php

namespace Database\Seeders;

use App\Models\ManagementMenu;
use App\Models\ManagementMenuRoles;
use Illuminate\Database\Seeder;

class ManagementMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'no_management_menu' => 1,
                'nama_management_menu' => 'Dashboard',
                'icon_management_menu' => 'home',
                'link_management_menu' => '/admin/home',
                'membawahi_menu_management_menu' => '',
                'is_node_management_menu' => '0',
            ],
            [
                'id' => 2,
                'no_management_menu' => 2,
                'nama_management_menu' => 'Data master',
                'icon_management_menu' => 'hard-drive',
                'link_management_menu' => '#',
                'membawahi_menu_management_menu' => '4, 5, 6, 7, 8, 12',
                'is_node_management_menu' => '1',
            ],

            [
                'id' => 3,
                'no_management_menu' => 3,
                'nama_management_menu' => 'Data Website',
                'icon_management_menu' => 'globe',
                'link_management_menu' => '#',
                'membawahi_menu_management_menu' => '9, 10, 11',
                'is_node_management_menu' => '1',
            ],

            [
                'id' => 4,
                'no_management_menu' => 4,
                'nama_management_menu' => 'Menu',
                'icon_management_menu' => 'far fa-circle',
                'link_management_menu' => '/admin/menu',
                'membawahi_menu_management_menu' => '',
                'is_node_management_menu' => '',
            ],
            [
                'id' => 5,
                'no_management_menu' => 5,
                'nama_management_menu' => 'Roles',
                'icon_management_menu' => 'far fa-circle',
                'link_management_menu' => '/admin/roles',
                'membawahi_menu_management_menu' => '',
                'is_node_management_menu' => '',
            ],
            [
                'id' => 6,
                'no_management_menu' => 6,
                'nama_management_menu' => 'Users',
                'icon_management_menu' => 'far fa-circle',
                'link_management_menu' => '/admin/users',
                'membawahi_menu_management_menu' => '',
                'is_node_management_menu' => '',
            ],
            [
                'id' => 7,
                'no_management_menu' => 7,
                'nama_management_menu' => 'Konfigurasi',
                'icon_management_menu' => 'far fa-circle',
                'link_management_menu' => '/admin/konfigurasi',
                'membawahi_menu_management_menu' => '',
                'is_node_management_menu' => '',
            ],
            [
                'id' => 8,
                'no_management_menu' => 8,
                'nama_management_menu' => 'Akses User',
                'icon_management_menu' => 'far fa-circle',
                'link_management_menu' => '/admin/access',
                'membawahi_menu_management_menu' => '',
                'is_node_management_menu' => '',
            ],

            [
                'id' => 9,
                'no_management_menu' => 9,
                'nama_management_menu' => 'About',
                'icon_management_menu' => 'far fa-circle',
                'link_management_menu' => '/admin/about',
                'membawahi_menu_management_menu' => '',
                'is_node_management_menu' => '',
            ],
            [
                'id' => 10,
                'no_management_menu' => 10,
                'nama_management_menu' => 'Banner',
                'icon_management_menu' => 'far fa-circle',
                'link_management_menu' => '/admin/banner',
                'membawahi_menu_management_menu' => '',
                'is_node_management_menu' => '',
            ],
            [
                'id' => 11,
                'no_management_menu' => 11,
                'nama_management_menu' => 'Gallery',
                'icon_management_menu' => 'far fa-circle',
                'link_management_menu' => '/admin/gallery',
                'membawahi_menu_management_menu' => '',
                'is_node_management_menu' => '',
            ],
            [
                'id' => 12,
                'no_management_menu' => 12,
                'nama_management_menu' => 'Jabatan',
                'icon_management_menu' => 'far fa-circle',
                'link_management_menu' => '/admin/jabatan',
                'membawahi_menu_management_menu' => '',
                'is_node_management_menu' => '',
            ],

            [
                'id' => 13,
                'no_management_menu' => 13,
                'nama_management_menu' => 'TPS',
                'icon_management_menu' => 'volume',
                'link_management_menu' => '/admin/tps',
                'membawahi_menu_management_menu' => '',
                'is_node_management_menu' => '',
            ],
            [
                'id' => 14,
                'no_management_menu' => 14,
                'nama_management_menu' => 'Pengumuman',
                'icon_management_menu' => 'volume-2',
                'link_management_menu' => '/admin/pengumuman',
                'membawahi_menu_management_menu' => '',
                'is_node_management_menu' => '',
            ],
            [
                'id' => 15,
                'no_management_menu' => 15,
                'nama_management_menu' => 'Logout',
                'icon_management_menu' => 'log-out',
                'link_management_menu' => '/logout',
                'membawahi_menu_management_menu' => '',
                'is_node_management_menu' => '',
            ],

        ];
        ManagementMenu::insert($data);

        $data = [
            [
                'management_menu_id' => 1,
                'roles_id' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 1,
            ],
            [
                'management_menu_id' => 2,
                'roles_id' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 1,
            ],
            [
                'management_menu_id' => 3,
                'roles_id' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 1,
            ],
            [
                'management_menu_id' => 4,
                'roles_id' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 1,
            ],
            [
                'management_menu_id' => 5,
                'roles_id' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 1,
            ],
            [
                'management_menu_id' => 6,
                'roles_id' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 1,
            ],
            [
                'management_menu_id' => 7,
                'roles_id' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 1,
            ],
            [
                'management_menu_id' => 8,
                'roles_id' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 1,
            ],
            [
                'management_menu_id' => 9,
                'roles_id' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 1,
            ],
            [
                'management_menu_id' => 10,
                'roles_id' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 1,
            ],
            [
                'management_menu_id' => 11,
                'roles_id' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 1,
            ],
            [
                'management_menu_id' => 12,
                'roles_id' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 1,
            ],
            [
                'management_menu_id' => 13,
                'roles_id' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 1,
            ],
            [
                'management_menu_id' => 14,
                'roles_id' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 1,
            ],
            [
                'management_menu_id' => 15,
                'roles_id' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 1,
            ],

        ];
        ManagementMenuRoles::insert($data);
    }
}
