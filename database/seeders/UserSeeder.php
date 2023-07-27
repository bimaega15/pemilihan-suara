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


        // kepala kepegawaian
        $user = User::create([
            'username' => 'kepala123',
            'password' => Hash::make('kepala123'),
        ]);
        $role = Role::create([
            'nama_roles' => 'kepala kepegawaian'
        ]);

        $profile = Profile::create([
            'users_id' => $user->id,
            'jabatan_id' => 25,
            'nama_profile' => 'kepala kepegawaian kpu',
            'email_profile' => 'kepalakepegawaiankpu@gmail.com',
            'alamat_profile' => 'alamat kepala kepegawaian',
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
            'nama_roles' => 'Relawan'
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
