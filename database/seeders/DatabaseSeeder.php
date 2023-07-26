<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(KuisionerSeeder::class);
        $this->call(JawabanKuisionerSeeder::class);
        $this->call(RangeBobotSeeder::class);
        $this->call(PernyataanSeeder::class);
        $this->call(UserDiagnosaSeeder::class);
        
        $this->call(KonfigurasiSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ManagementMenuSeeder::class);
    }
}
