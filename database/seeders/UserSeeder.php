<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = User::create([
            'username' => 'admin123',
            'password' => Hash::make('admin123'),
        ]);
        $role = Role::create([
            'nama_roles' => 'admin'
        ]);

        $profile = Profile::create([
            'users_id' => $user->id,
            'jabatan_id' => 25,
            'nama_profile' => 'Admin KPU',
            'email_profile' => 'adminkpu@gmail.com',
            'alamat_profile' => 'alamat admin',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);

        // koordinator
        $user = User::create([
            'username' => 'koordinator123',
            'password' => Hash::make('koordinator123'),
        ]);
        $role = Role::create([
            'nama_roles' => 'koordinator'
        ]);

        $profile = Profile::create([
            'users_id' => $user->id,
            'jabatan_id' => 25,
            'nama_profile' => 'koordinator kpu',
            'email_profile' => 'koordinatorkpu@gmail.com',
            'alamat_profile' => 'alamat koordinator',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);


        // caleg
        $user = User::create([
            'username' => 'caleg123',
            'password' => Hash::make('caleg123'),
        ]);
        $role = Role::create([
            'nama_roles' => 'caleg'
        ]);
        $roleCaleg = $role->id;

        $profile = Profile::create([
            'users_id' => $user->id,
            'jabatan_id' => 25,
            'nama_profile' => 'caleg kpu',
            'email_profile' => 'calegkpu@gmail.com',
            'alamat_profile' => 'alamat caleg',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);

        // user
        $user = User::create([
            'username' => 'relawan123',
            'password' => Hash::make('relawan123'),
        ]);
        $role = Role::create([
            'nama_roles' => 'relawan'
        ]);

        $profile = Profile::create([
            'users_id' => $user->id,
            'jabatan_id' => 25,
            'nama_profile' => 'relawan kpu',
            'email_profile' => 'relawankpu@gmail.com',
            'alamat_profile' => 'alamat relawan',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
    }
}
