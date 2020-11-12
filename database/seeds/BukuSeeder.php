<?php

use Illuminate\Database\Seeder;
use App\Models\Kategori;
use App\Models\Penulis;
use App\Models\Buku;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Seeding Buku Started');
        $datas=[
            [
                'judul'    => 'Matematika, Teori, dan Aplikasi ',
                'isbn'     => '97398279349734',
                'penulis'  => 'M Kahfid Suyati',
                'kategori' => 'Buku Pelajaran',
            ],
            [
                'judul'    => 'Menumbuhkan Kreatifitas pada Balita',
                'isbn'     => '2983443722',
                'penulis'  => 'Dimas Seto',
                'kategori' => 'Anak', 
            ],
            [
                'judul'    => 'Murder on The Orient Express',
                'isbn'     => '2173982873327',
                'penulis'  => 'Agatha Christie',
                'kategori' => 'Novel',
            ],
            [
                'judul'    => 'Memacu Semangat Enterpreneur di Usia Muda',
                'isbn'     => '28939373327932',
                'penulis'  => 'Chaerul Tanjung',
                'kategori' => 'Ekonomi dan Bisnis',
            ],
            [
                'judul'    => 'Pengantar Hukum Pidana',
                'isbn'     => '3039289038328',
                'penulis'  => 'Hariz Azhar',
                'kategori' => 'Hukum',
            ],
            [
                'judul'    => 'Hidangan Paling Menggoda di Musim Dingin',
                'isbn'     => '23098029383283',
                'penulis'  => 'Rudi Khoirudin',
                'kategori' => 'Kuliner',
            ],
            [
                'judul'    => 'Total Football dan Bangkitnya Sepakbola Modern',
                'isbn'     =>  '934893234342244',
                'penulis'  =>'Justinus Lhaksana',
                'kategori' => 'Olahraga',
            ],
            [
                'judul'    => 'Nikmatnya Pacaran Setelah Menikah',
                'isbn'     => '28339233273',
                'penulis'  => 'Salim A Fillah' ,
                'kategori' => 'Agama',
            ],
        ];
        
        foreach ($datas as $key => $value) {
            $penulis = Penulis::where('nama',$value['penulis'])->first();
            $kategori = Kategori::where('nama',$value['kategori'])->first();
            $create= Buku::create([
                'judul'       => $value['judul'],
                'isbn'        => $value['isbn'],
                'penulis_id'  => $penulis  ?  $penulis->id : NULL,
                'kategori_id' => $kategori ?  $kategori->id : NULL,

            ]);
        }
        $this->command->info('Seeding Buku Finished');
    }
}
