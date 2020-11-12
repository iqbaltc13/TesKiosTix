# Laravel 6.2 - TesKiosTix

## Very Quick start
- git clone 'https://github.com/iqbaltc13/TesKiosTix.git'
- composer install
- composer run-script post-root-package-install
- setting .env
- php artisan migrate
- php artisan key:generate
- php artisan passport:install --force
- php artisan db:seed --class=DatabaseSeeder

## Permission
- chmod -R 775 storage
- chmod -R 775 bootstrap/cache
- chmod -R 775 public/uploads


Dokumentasi Jawaban Soal

1   Problem Solving Max Min
        
        -buka cmd
        -Masuk Ke Folder Soal1-3
        -Masuk ke Folder Soal No 1
        -Masukkan command "go run get_min_max.go"

2    Problem Solving Check Number
        
        -buka cmd
        -Masuk Ke Folder Soal1-3
        -Masuk ke Folder Soal No 2
        -Masukkan command "go run check_number_kiostix.go"
        

3   Problem Solving Check Palindrome
        
        -buka cmd
        -Masuk Ke Folder Soal1-3
        -Masuk ke Folder Soal No 3
        -Masukkan command "go run palindrome.go"

4 Struktur Tabel
        CreateKategori: 
            create table `kategori` (
                `id` bigint unsigned not null auto_increment primary key, 
                `nama` varchar(255) null, 
                `status` int null default '0',
                `created_at` datetime null,
                `updated_at` datetime null, 
                `deleted_at` datetime null
            ) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
        CreatePenulis: 
            create table `penulis` (
                `id` bigint unsigned not null auto_increment primary key, 
                `nama` varchar(255) null, 
                `status` int null default '0', 
                `created_at` datetime null,
                `updated_at` datetime null, 
                `deleted_at` datetime null
            ) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
        CreateBuku: 
            create table `buku` (
                `id` bigint unsigned not null auto_increment primary key, 
                `judul` varchar(255) null, 
                `isbn` varchar(255) null, 
                `status` int null default '0',
                `penulis_id` bigint unsigned null, 
                `kategori_id` bigint unsigned null, 
                `created_at` datetime null, 
                `updated_at` datetime null, 
                `deleted_at` datetime null
            ) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
        CreateBuku: 
            alter table `buku` 
            add index `buku_penulis_id_kategori_id_index`(`penulis_id`, `kategori_id`)
        CreateBuku: 
            alter table `buku` 
            add constraint 
                `buku_penulis_id_foreign` 
                foreign key (`penulis_id`) 
                references `penulis` (`id`) 
                on delete cascade
        CreateBuku: 
            alter table `buku` 
            add constraint 
                `buku_kategori_id_foreign` 
                foreign key (`kategori_id`) 
                references `kategori` (`id`) 
                on delete cascade

5 query data buku by nama penulis 

    select * from buku where penulis_id in 
    (select id from penulis where nama = <nama_penulis>) 

6 query data buku by nama penulis 

    select a.*, b.nama from buku a , penulis b where a.kategori_id in
    (select id from kategori where nama = <kategori>)  and a.penulis_id = b.id

7 api load semua daftar buku

  -Setelah menjalankan semua quick start di instruksi sebelumnya , masukkan url ini di postman

  'http://<public url>/api/v1/buku/index'
  - klik send
  - data list buku terdapat di atribut data

8 api load buku berdasarkan nama penulis


  sama seperti no 7 , namun buat payload 'nama_penulis' , set value payload tersebut, misal set 'Agatha Christie' 
  - klik send
  - data list buku terdapat di atribut data

9 api load buku berdasarkan kategori


  sama seperti no 7 , namun buat payload 'kategori' , set value payload tersebut, misal set 'Novel'
  - klik send
  - data list buku terdapat di atribut data
  - data penulis ada di atribut penulis yang berupa object 

10 setelah melakukan quick start di instruksi sebelumnya
  
   -buka halaman login di ' 'http://<public url>/login'
   -login dengan akun berikut
        email    : super.admin@artcak.com
        password : bismillah
   -masuk di halaman home
   -Manajemen Buku
      - klik List Buku , di sana ada tombol Add Buku, Edit, dan Hapus 
   -Manajemen Kategori
      - klik List Kategori , di sana ada tombol Add Kategori, Edit, dan Hapus  
   -Manajemen Penulis
      - klik List Penulis , di sana ada tombol Add Penulis, Edit, dan Hapus  