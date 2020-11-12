<?php

use Illuminate\Database\Seeder;
use App\Models\Penulis;

class PenulisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Seeding Penulis Started');
        
        $datas=[
            'M Kahfid Suyati',
            'Dimas Seto',
            'Agatha Christie',
            'Chaerul Tanjung',
            'Hariz Azhar',
            'Rudi Khoirudin',
            'Justinus Lhaksana',
            'Salim A Fillah',
        ];
        foreach ($datas as $key => $value) {
            $create= Penulis::create([
                'nama'=>$value,
            ]);
        }
        $this->command->info('Seeding Penulis Finished');
    }
}
