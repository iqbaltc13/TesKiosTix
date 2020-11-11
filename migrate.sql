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
