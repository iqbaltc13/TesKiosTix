<?php

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Seeding Kategori Started');
        $datas=[
            'Agama',
            'Olahraga',
            'Kuliner',
            'Hukum',
            'Ekonomi dan Bisnis',
            'Novel',
            'Anak',
            'Buku Pelajaran',
        ];

        foreach ($datas as $key => $value) {
            $create= Kategori::create([
                'nama'=>$value,
            ]);
        }
        $this->command->info('Seeding Kategori Finished');
    }
}
