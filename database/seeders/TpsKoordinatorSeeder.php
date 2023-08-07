<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Tps;
use App\Models\TpsDetail;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TpsKoordinatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // user
        $user = User::create([
            'username' => 'koordinator1.1kpu@gmail.com',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%koordinator%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'koordinator1.1 kpu',
            'email_profile' => 'koordinator1.1kpu@gmail.com',
            'alamat_profile' => 'alamat koordinator1.1',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        $tps = [
            'provinces_id' => 11,
            'regencies_id' => 1101,
            'districts_id' => 1101010,
            'villages_id' => 1,
            'nama_tps' => 'tps1',
            'totallk_tps' => '2',
            'totalpr_tps' => '3',
            'totalsemua_tps' => '5',
            'users_id' => $user->id,
            'minimal_tps' => '50',
            'target_tps' => '100',
            'alamat_tps' => 'alamat_tps1',
        ];
        $tps = Tps::create($tps);

        // user
        $user = User::create([
            'username' => 'relawan1.1kpu@gmail.com',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%relawan%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'relawan1.1 kpu',
            'email_profile' => 'relawan1.1kpu@gmail.com',
            'alamat_profile' => 'alamat relawan1.1',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        TpsDetail::create([
            'users_id' => $user->id,
            'tps_id' => $tps->id,
            'bukticoblos_detail' => 'default.png',
            'detail_verification' => 0
        ]);
        // user
        $user = User::create([
            'username' => 'relawan1.2kpu@gmail.com',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%relawan%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'relawan1.2 kpu',
            'email_profile' => 'relawan1.2kpu@gmail.com',
            'alamat_profile' => 'alamat relawan1.2',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        TpsDetail::create([
            'users_id' => $user->id,
            'tps_id' => $tps->id,
            'bukticoblos_detail' => 'default.png',
            'detail_verification' => 0
        ]);
        // user
        $user = User::create([
            'username' => 'relawan1.3kpu@gmail.com',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%relawan%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'relawan1.3 kpu',
            'email_profile' => 'relawan1.3kpu@gmail.com',
            'alamat_profile' => 'alamat relawan1.3',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        TpsDetail::create([
            'users_id' => $user->id,
            'tps_id' => $tps->id,
            'bukticoblos_detail' => 'default.png',
            'detail_verification' => 0
        ]);
        // user
        $user = User::create([
            'username' => 'relawan1.4kpu@gmail.com',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%relawan%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'relawan1.4 kpu',
            'email_profile' => 'relawan1.4kpu@gmail.com',
            'alamat_profile' => 'alamat relawan1.4',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'P',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        TpsDetail::create([
            'users_id' => $user->id,
            'tps_id' => $tps->id,
            'bukticoblos_detail' => 'default.png',
            'detail_verification' => 0
        ]);
        // user
        $user = User::create([
            'username' => 'relawan1.5kpu@gmail.com',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%relawan%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'relawan1.5 kpu',
            'email_profile' => 'relawan1.5kpu@gmail.com',
            'alamat_profile' => 'alamat relawan1.5',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'P',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        TpsDetail::create([
            'users_id' => $user->id,
            'tps_id' => $tps->id,
            'bukticoblos_detail' => 'default.png',
            'detail_verification' => 0
        ]);
        // ==================
        $user = User::create([
            'username' => 'koordinator124',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%koordinator%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'koordinator124 kpu',
            'email_profile' => 'koordinator124kpu@gmail.com',
            'alamat_profile' => 'alamat koordinator124',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        $tps = [
            'provinces_id' => 11,
            'regencies_id' => 1101,
            'districts_id' => 1101010,
            'villages_id' => 1,
            'nama_tps' => 'tps2',
            'totallk_tps' => '2',
            'totalpr_tps' => '3',
            'totalsemua_tps' => '5',
            'users_id' => $user->id,
            'minimal_tps' => '50',
            'target_tps' => '100',
            'alamat_tps' => 'alamat_tps2',
        ];
        $tps = Tps::create($tps);
        // user
        $user = User::create([
            'username' => 'relawan2.1kpu@gmail.com',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%relawan%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'relawan2.1 kpu',
            'email_profile' => 'relawan2.1kpu@gmail.com',
            'alamat_profile' => 'alamat relawan2.1',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        TpsDetail::create([
            'users_id' => $user->id,
            'tps_id' => $tps->id,
            'bukticoblos_detail' => 'default.png',
            'detail_verification' => 0
        ]);
        // user
        $user = User::create([
            'username' => 'relawan2.2kpu@gmail.com',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%relawan%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'relawan2.2 kpu',
            'email_profile' => 'relawan2.2kpu@gmail.com',
            'alamat_profile' => 'alamat relawan2.2',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        TpsDetail::create([
            'users_id' => $user->id,
            'tps_id' => $tps->id,
            'bukticoblos_detail' => 'default.png',
            'detail_verification' => 0
        ]);
        // user
        $user = User::create([
            'username' => 'relawan2.3kpu@gmail.com',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%relawan%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'relawan2.3 kpu',
            'email_profile' => 'relawan2.3kpu@gmail.com',
            'alamat_profile' => 'alamat relawan2.3',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'P',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        TpsDetail::create([
            'users_id' => $user->id,
            'tps_id' => $tps->id,
            'bukticoblos_detail' => 'default.png',
            'detail_verification' => 0
        ]);
        // user
        $user = User::create([
            'username' => 'relawan2.4kpu@gmail.com',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%relawan%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'relawan2.4 kpu',
            'email_profile' => 'relawan2.4kpu@gmail.com',
            'alamat_profile' => 'alamat relawan2.4',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'P',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        TpsDetail::create([
            'users_id' => $user->id,
            'tps_id' => $tps->id,
            'bukticoblos_detail' => 'default.png',
            'detail_verification' => 0
        ]);
        // user
        $user = User::create([
            'username' => 'relawan2.5kpu@gmail.com',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%relawan%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'relawan2.5 kpu',
            'email_profile' => 'relawan2.5kpu@gmail.com',
            'alamat_profile' => 'alamat relawan2.5',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'P',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        TpsDetail::create([
            'users_id' => $user->id,
            'tps_id' => $tps->id,
            'bukticoblos_detail' => 'default.png',
            'detail_verification' => 0
        ]);
        // ==================

        $user = User::create([
            'username' => 'koordinator125',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%koordinator%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'koordinator125 kpu',
            'email_profile' => 'koordinator125kpu@gmail.com',
            'alamat_profile' => 'alamat koordinator125',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        $tps = [
            'provinces_id' => 11,
            'regencies_id' => 1101,
            'districts_id' => 1101010,
            'villages_id' => 1,
            'nama_tps' => 'tps3',
            'totallk_tps' => '2',
            'totalpr_tps' => '3',
            'totalsemua_tps' => '5',
            'users_id' => $user->id,
            'minimal_tps' => '50',
            'target_tps' => '100',
            'alamat_tps' => 'alamat_tps3',
        ];
        $tps = Tps::create($tps);
         // user
         $user = User::create([
            'username' => 'relawan6.1kpu@gmail.com',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%relawan%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'relawan6.1 kpu',
            'email_profile' => 'relawan6.1kpu@gmail.com',
            'alamat_profile' => 'alamat relawan6.1',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        TpsDetail::create([
            'users_id' => $user->id,
            'tps_id' => $tps->id,
            'bukticoblos_detail' => 'default.png',
            'detail_verification' => 0
        ]);
         // user
         $user = User::create([
            'username' => 'relawan6.2kpu@gmail.com',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%relawan%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'relawan6.2 kpu',
            'email_profile' => 'relawan6.2kpu@gmail.com',
            'alamat_profile' => 'alamat relawan6.2',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        TpsDetail::create([
            'users_id' => $user->id,
            'tps_id' => $tps->id,
            'bukticoblos_detail' => 'default.png',
            'detail_verification' => 0
        ]);
         // user
         $user = User::create([
            'username' => 'relawan6.3kpu@gmail.com',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%relawan%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'relawan6.3 kpu',
            'email_profile' => 'relawan6.3kpu@gmail.com',
            'alamat_profile' => 'alamat relawan6.3',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        TpsDetail::create([
            'users_id' => $user->id,
            'tps_id' => $tps->id,
            'bukticoblos_detail' => 'default.png',
            'detail_verification' => 0
        ]);
         // user
         $user = User::create([
            'username' => 'relawan6.4kpu@gmail.com',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%relawan%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'relawan6.4 kpu',
            'email_profile' => 'relawan6.4kpu@gmail.com',
            'alamat_profile' => 'alamat relawan6.4',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        TpsDetail::create([
            'users_id' => $user->id,
            'tps_id' => $tps->id,
            'bukticoblos_detail' => 'default.png',
            'detail_verification' => 0
        ]);
         // user
         $user = User::create([
            'username' => 'relawan6.5kpu@gmail.com',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%relawan%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'relawan6.5 kpu',
            'email_profile' => 'relawan6.5kpu@gmail.com',
            'alamat_profile' => 'alamat relawan6.5',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        TpsDetail::create([
            'users_id' => $user->id,
            'tps_id' => $tps->id,
            'bukticoblos_detail' => 'default.png',
            'detail_verification' => 0
        ]);
        // ==================

        $user = User::create([
            'username' => 'koordinator126',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%koordinator%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'koordinator126 kpu',
            'email_profile' => 'koordinator126kpu@gmail.com',
            'alamat_profile' => 'alamat koordinator126',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        $tps = [
            'provinces_id' => 11,
            'regencies_id' => 1101,
            'districts_id' => 1101010,
            'villages_id' => 1,
            'nama_tps' => 'tps4',
            'totallk_tps' => '2',
            'totalpr_tps' => '3',
            'totalsemua_tps' => '5',
            'users_id' => $user->id,
            'minimal_tps' => '50',
            'target_tps' => '100',
            'alamat_tps' => 'alamat_tps4',
        ];
        $tps = Tps::create($tps);
        // user
        $user = User::create([
            'username' => 'relawan3.1kpu@gmail.com',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%relawan%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'relawan3.1 kpu',
            'email_profile' => 'relawan3.1kpu@gmail.com',
            'alamat_profile' => 'alamat relawan3.1',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        TpsDetail::create([
            'users_id' => $user->id,
            'tps_id' => $tps->id,
            'bukticoblos_detail' => 'default.png',
            'detail_verification' => 0
        ]);
        // user
        $user = User::create([
            'username' => 'relawan3.2kpu@gmail.com',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%relawan%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'relawan3.2 kpu',
            'email_profile' => 'relawan3.2kpu@gmail.com',
            'alamat_profile' => 'alamat relawan3.2',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        TpsDetail::create([
            'users_id' => $user->id,
            'tps_id' => $tps->id,
            'bukticoblos_detail' => 'default.png',
            'detail_verification' => 0
        ]);
        // user
        $user = User::create([
            'username' => 'relawan3.3kpu@gmail.com',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%relawan%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'relawan3.3 kpu',
            'email_profile' => 'relawan3.3kpu@gmail.com',
            'alamat_profile' => 'alamat relawan3.3',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'P',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        TpsDetail::create([
            'users_id' => $user->id,
            'tps_id' => $tps->id,
            'bukticoblos_detail' => 'default.png',
            'detail_verification' => 0
        ]);
        // user
        $user = User::create([
            'username' => 'relawan3.4kpu@gmail.com',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%relawan%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'relawan3.4 kpu',
            'email_profile' => 'relawan3.4kpu@gmail.com',
            'alamat_profile' => 'alamat relawan3.4',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'P',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        TpsDetail::create([
            'users_id' => $user->id,
            'tps_id' => $tps->id,
            'bukticoblos_detail' => 'default.png',
            'detail_verification' => 0
        ]);
        // user
        $user = User::create([
            'username' => 'relawan3.5kpu@gmail.com',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%relawan%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'relawan3.5 kpu',
            'email_profile' => 'relawan3.5kpu@gmail.com',
            'alamat_profile' => 'alamat relawan3.5',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'P',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        TpsDetail::create([
            'users_id' => $user->id,
            'tps_id' => $tps->id,
            'bukticoblos_detail' => 'default.png',
            'detail_verification' => 0
        ]);
        // ==================

        $user = User::create([
            'username' => '127',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%koordinator%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => '127 kpu',
            'email_profile' => '127kpu@gmail.com',
            'alamat_profile' => 'alamat 127',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        $tps = [
            'provinces_id' => 11,
            'regencies_id' => 1101,
            'districts_id' => 1101010,
            'villages_id' => 1,
            'nama_tps' => 'tps5',
            'totallk_tps' => '2',
            'totalpr_tps' => '3',
            'totalsemua_tps' => '5',
            'users_id' => $user->id,
            'minimal_tps' => '50',
            'target_tps' => '100',
            'alamat_tps' => 'alamat_tps5',
        ];
        $tps = Tps::create($tps);
        // user
        $user = User::create([
            'username' => 'relawan4.1kpu@gmail.com',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%relawan%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'relawan4.1 kpu',
            'email_profile' => 'relawan4.1kpu@gmail.com',
            'alamat_profile' => 'alamat relawan4.1',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        TpsDetail::create([
            'users_id' => $user->id,
            'tps_id' => $tps->id,
            'bukticoblos_detail' => 'default.png',
            'detail_verification' => 0
        ]);
        // user
        $user = User::create([
            'username' => 'relawan4.2kpu@gmail.com',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%relawan%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'relawan4.2 kpu',
            'email_profile' => 'relawan4.2kpu@gmail.com',
            'alamat_profile' => 'alamat relawan4.2',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        TpsDetail::create([
            'users_id' => $user->id,
            'tps_id' => $tps->id,
            'bukticoblos_detail' => 'default.png',
            'detail_verification' => 0
        ]);
        // user
        $user = User::create([
            'username' => 'relawan4.3kpu@gmail.com',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%relawan%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'relawan4.3 kpu',
            'email_profile' => 'relawan4.3kpu@gmail.com',
            'alamat_profile' => 'alamat relawan4.3',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        TpsDetail::create([
            'users_id' => $user->id,
            'tps_id' => $tps->id,
            'bukticoblos_detail' => 'default.png',
            'detail_verification' => 0
        ]);
        // user
        $user = User::create([
            'username' => 'relawan4.4kpu@gmail.com',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%relawan%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'relawan4.4 kpu',
            'email_profile' => 'relawan4.4kpu@gmail.com',
            'alamat_profile' => 'alamat relawan4.4',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'P',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        TpsDetail::create([
            'users_id' => $user->id,
            'tps_id' => $tps->id,
            'bukticoblos_detail' => 'default.png',
            'detail_verification' => 0
        ]);
        // user
        $user = User::create([
            'username' => 'relawan4.5kpu@gmail.com',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%relawan%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'relawan4.5 kpu',
            'email_profile' => 'relawan4.5kpu@gmail.com',
            'alamat_profile' => 'alamat relawan4.5',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        TpsDetail::create([
            'users_id' => $user->id,
            'tps_id' => $tps->id,
            'bukticoblos_detail' => 'default.png',
            'detail_verification' => 0
        ]);
        // ==================

        $user = User::create([
            'username' => 'koordinator128',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%koordinator%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'koordinator128 kpu',
            'email_profile' => 'koordinator128kpu@gmail.com',
            'alamat_profile' => 'alamat koordinator128',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        $tps = [
            'provinces_id' => 11,
            'regencies_id' => 1101,
            'districts_id' => 1101010,
            'villages_id' => 1,
            'nama_tps' => 'tps6',
            'totallk_tps' => '2',
            'totalpr_tps' => '3',
            'totalsemua_tps' => '5',
            'users_id' => $user->id,
            'minimal_tps' => '50',
            'target_tps' => '100',
            'alamat_tps' => 'alamat_tps6',
        ];
        $tps = Tps::create($tps);
        // user
        $user = User::create([
            'username' => 'relawan5.1kpu@gmail.com',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%relawan%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'relawan5.1 kpu',
            'email_profile' => 'relawan5.1kpu@gmail.com',
            'alamat_profile' => 'alamat relawan5.1',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        TpsDetail::create([
            'users_id' => $user->id,
            'tps_id' => $tps->id,
            'bukticoblos_detail' => 'default.png',
            'detail_verification' => 0
        ]);
        // user
        $user = User::create([
            'username' => 'relawan5.2kpu@gmail.com',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%relawan%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'relawan5.2 kpu',
            'email_profile' => 'relawan5.2kpu@gmail.com',
            'alamat_profile' => 'alamat relawan5.2',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        TpsDetail::create([
            'users_id' => $user->id,
            'tps_id' => $tps->id,
            'bukticoblos_detail' => 'default.png',
            'detail_verification' => 0
        ]);
        // user
        $user = User::create([
            'username' => 'relawan5.3kpu@gmail.com',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%relawan%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'relawan5.3 kpu',
            'email_profile' => 'relawan5.3kpu@gmail.com',
            'alamat_profile' => 'alamat relawan5.3',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'P',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        TpsDetail::create([
            'users_id' => $user->id,
            'tps_id' => $tps->id,
            'bukticoblos_detail' => 'default.png',
            'detail_verification' => 0
        ]);
        // user
        $user = User::create([
            'username' => 'relawan5.4kpu@gmail.com',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%relawan%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'relawan5.4 kpu',
            'email_profile' => 'relawan5.4kpu@gmail.com',
            'alamat_profile' => 'alamat relawan5.4',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        TpsDetail::create([
            'users_id' => $user->id,
            'tps_id' => $tps->id,
            'bukticoblos_detail' => 'default.png',
            'detail_verification' => 0
        ]);
        // user
        $user = User::create([
            'username' => 'relawan5.5kpu@gmail.com',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%relawan%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'relawan5.5 kpu',
            'email_profile' => 'relawan5.5kpu@gmail.com',
            'alamat_profile' => 'alamat relawan5.5',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        TpsDetail::create([
            'users_id' => $user->id,
            'tps_id' => $tps->id,
            'bukticoblos_detail' => 'default.png',
            'detail_verification' => 0
        ]);
        // ==================

        $user = User::create([
            'username' => 'koordinator129',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%koordinator%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'koordinator129 kpu',
            'email_profile' => 'koordinator129kpu@gmail.com',
            'alamat_profile' => 'alamat koordinator129',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        $tps = [
            'provinces_id' => 11,
            'regencies_id' => 1101,
            'districts_id' => 1101010,
            'villages_id' => 1,
            'nama_tps' => 'tps7',
            'totallk_tps' => '0',
            'totalpr_tps' => '0',
            'totalsemua_tps' => '0',
            'users_id' => $user->id,
            'minimal_tps' => '50',
            'target_tps' => '100',
            'alamat_tps' => 'alamat_tps7',
        ];
        Tps::create($tps);
        // ==================

        $user = User::create([
            'username' => 'koordinator130',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%koordinator%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'koordinator130 kpu',
            'email_profile' => 'koordinator130kpu@gmail.com',
            'alamat_profile' => 'alamat koordinator130',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        $tps = [
            'provinces_id' => 11,
            'regencies_id' => 1101,
            'districts_id' => 1101010,
            'villages_id' => 1,
            'nama_tps' => 'tps8',
            'totallk_tps' => '0',
            'totalpr_tps' => '0',
            'totalsemua_tps' => '0',
            'users_id' => $user->id,
            'minimal_tps' => '50',
            'target_tps' => '100',
            'alamat_tps' => 'alamat_tps8',
        ];
        Tps::create($tps);
        // ==================


        $user = User::create([
            'username' => 'koordinator131',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%koordinator%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'koordinator131 kpu',
            'email_profile' => 'koordinator131kpu@gmail.com',
            'alamat_profile' => 'alamat koordinator131',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        $tps = [
            'provinces_id' => 11,
            'regencies_id' => 1101,
            'districts_id' => 1101010,
            'villages_id' => 1,
            'nama_tps' => 'tps9',
            'totallk_tps' => '0',
            'totalpr_tps' => '0',
            'totalsemua_tps' => '0',
            'users_id' => $user->id,
            'minimal_tps' => '50',
            'target_tps' => '100',
            'alamat_tps' => 'alamat_tps9',
        ];
        Tps::create($tps);
        // ==================

        $user = User::create([
            'username' => 'koordinator132',
            'password' => Hash::make('123456'),
            'is_aktif' => 1
        ]);
        $role = Role::where('nama_roles', 'like', '%koordinator%')->first();

        $profile = Profile::create([
            'nik_profile' => rand(1, 1000000000000),
            'users_id' => $user->id,
            'jabatan_id' => 27,
            'nama_profile' => 'koordinator132 kpu',
            'email_profile' => 'koordinator132kpu@gmail.com',
            'alamat_profile' => 'alamat koordinator132',
            'nohp_profile' => '082277506232',
            'jenis_kelamin_profile' => 'L',
            'gambar_profile' => 'default.png'
        ]);

        $roleUser = RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        $tps = [
            'provinces_id' => 11,
            'regencies_id' => 1101,
            'districts_id' => 1101010,
            'villages_id' => 1,
            'nama_tps' => 'tps10',
            'totallk_tps' => '0',
            'totalpr_tps' => '0',
            'totalsemua_tps' => '0',
            'users_id' => $user->id,
            'minimal_tps' => '50',
            'target_tps' => '100',
            'alamat_tps' => 'alamat_tps10',
        ];
        Tps::create($tps);
    }
}
