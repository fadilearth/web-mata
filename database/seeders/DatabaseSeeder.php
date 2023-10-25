<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('users')->insert(array(
            array(
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => Hash::make('password'),
                'is_admin' => 1,
                'active' => 1,
                'foto_profile' => null,
                'tempat_lahir' => null,
                'tgl_lahir' => null,
                'umur' => null,
                'jenis_kelamin' => null,
                'alamat' => null,
                'created_by' => 'SYSTEM',
                'updated_by' => null,
            )
        ));
        DB::table('pasiens')->insert(array(
            array(
                'name' => 'Pasien 1',
                'email' => 'pasien1@gmail.com',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => Hash::make('password'),
                'is_admin' => '0',
                'active' => 1,
                'foto_profile' => null,
                'tempat_lahir' => null,
                'tgl_lahir' => null,
                'umur' => null,
                'jenis_kelamin' => null,
                'alamat' => null,
                'created_by' => 'SYSTEM',
                'updated_by' => null,
            )
        ));
    }
}
