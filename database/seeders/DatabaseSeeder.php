<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
         \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
             'password' => bcrypt('test@example.com'),
         ]);

         DB::table('kategori')->insert([
            'nama_kategori' => 'Nasional'
         ]);
        DB::table('berita')->insert([
            'judul_berita' => 'Loren Ipsum',
            'isi_berita' => 'Lorem Ipsum',
            'gambar_berita' => 'lorem.jpg',
            'id_kategori' => 1
        ]);

        DB::table('page')->insert([
            'judul_page' => 'Lorem Ipsum',
            'isi_page' => 'Lorem Ipsum',
            'status_page' => 1
        ]);

        DB::table('menu')->insert([
            'nama_menu' => 'Lorem',
            'jenis_menu' => 'page',
            'url_menu' => '1',
            'target_menu' => '_blank',
            'urutan_menu' => 1
        ]);

        DB::table('menu')->insert([
            'nama_menu' => 'Google',
            'jenis_menu' => 'url',
            'url_menu' => 'https://www.google.com',
            'target_menu' => 'blank',
            'urutan_menu' => 2
        ]);

        DB::table('menu')->insert([
            'nama_menu' => 'Cloud Storage',
            'jenis_menu' => 'url',
            'url_menu' => '#',
            'target_menu' => '-self',
            'urutan_menu' => 3
        ]);

        DB::table('menu')->insert([
            'nama_menu' => 'GCP',
            'jenis_menu' => 'url',
            'url_menu' => 'https://cloud.google.com',
            'target_menu' => '-self',
            'urutan_menu' => 1,
            'parent_menu' => 3
        ]);

        DB::table('menu')->insert([
            'nama_menu' => 'AWS',
            'jenis_menu' => 'url',
            'url_menu' => 'https://aws.amazon.com',
            'target_menu' => '-self',
            'urutan_menu' => 2,
            'parent_menu' => 3
        ]);
    }
}
