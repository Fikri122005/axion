-- =====================================================================
-- Database Schema: AxionVet (Sistem Pakar Penyakit Hewan - Certainty Factor)
-- Engine: MySQL 8.0.16+ / MariaDB 10.2+ (InnoDB)  -> CHECK constraint aktif
-- Versi lengkap: perbaikan relasi, tabel baru, index, view, dan seed contoh
-- =====================================================================

CREATE DATABASE IF NOT EXISTS `db_axion_vet`
DEFAULT CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE `db_axion`;

SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- 1. users
-- (+ is_active, email_verified_at, remember_token)
-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('admin', 'pakar', 'user') NOT NULL DEFAULT 'user',
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    `remember_token` VARCHAR(100) NULL,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_users_role` (`role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- 2. kategori_hewan
-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `kategori_hewan`;
CREATE TABLE `kategori_hewan` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `nama_kategori` VARCHAR(50) NOT NULL,
    `slug` VARCHAR(50) NOT NULL UNIQUE,
    `deskripsi` TEXT NULL,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- 3. penyakit
-- (+ penyebab, pencegahan)
-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `penyakit`;
CREATE TABLE `penyakit` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `kategori_id` BIGINT UNSIGNED NOT NULL,
    `kode_penyakit` VARCHAR(10) NOT NULL UNIQUE,
    `nama_penyakit` VARCHAR(150) NOT NULL,
    `deskripsi` TEXT NULL,
    `penyebab` TEXT NULL,
    `pencegahan` TEXT NULL,
    `solusi` TEXT NOT NULL,
    `gambar` VARCHAR(255) NULL,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_penyakit_kategori` (`kategori_id`),
    CONSTRAINT `fk_penyakit_kategori` FOREIGN KEY (`kategori_id`)
        REFERENCES `kategori_hewan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- 4. gejala
-- kategori_id NULL = gejala umum (berlaku untuk semua jenis hewan)
-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `gejala`;
CREATE TABLE `gejala` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `kategori_id` BIGINT UNSIGNED NULL,
    `kode_gejala` VARCHAR(10) NOT NULL UNIQUE,
    `nama_gejala` TEXT NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_gejala_kategori` (`kategori_id`),
    CONSTRAINT `fk_gejala_kategori` FOREIGN KEY (`kategori_id`)
        REFERENCES `kategori_hewan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- 5. basis_pengetahuan
-- (+ CHECK nilai CF pakar 0 - 1)
-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `basis_pengetahuan`;
CREATE TABLE `basis_pengetahuan` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `penyakit_id` BIGINT UNSIGNED NOT NULL,
    `gejala_id` BIGINT UNSIGNED NOT NULL,
    `cf_pakar` DECIMAL(3, 2) NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY `unique_rule` (`penyakit_id`, `gejala_id`),
    INDEX `idx_rule_gejala` (`gejala_id`),
    CONSTRAINT `chk_cf_pakar` CHECK (`cf_pakar` >= 0 AND `cf_pakar` <= 1),
    CONSTRAINT `fk_rule_penyakit` FOREIGN KEY (`penyakit_id`)
        REFERENCES `penyakit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_rule_gejala` FOREIGN KEY (`gejala_id`)
        REFERENCES `gejala` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- 6. bobot_keyakinan (BARU)
-- Pilihan tingkat keyakinan user di form diagnosa -> nilai cf_user
-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `bobot_keyakinan`;
CREATE TABLE `bobot_keyakinan` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `label` VARCHAR(50) NOT NULL,
    `nilai_cf` DECIMAL(3, 2) NOT NULL,
    `urutan` TINYINT UNSIGNED NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY `unique_label` (`label`),
    CONSTRAINT `chk_bobot_cf` CHECK (`nilai_cf` >= 0 AND `nilai_cf` <= 1)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- 7. riwayat_diagnosa
-- Perubahan: relasi kategori & penyakit pakai RESTRICT agar riwayat
-- tidak ikut terhapus; + umur_hewan, keluhan_tambahan; + index
-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `riwayat_diagnosa`;
CREATE TABLE `riwayat_diagnosa` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `user_id` BIGINT UNSIGNED NULL,
    `kategori_id` BIGINT UNSIGNED NOT NULL,
    `nama_hewan` VARCHAR(100) NOT NULL,
    `umur_hewan` VARCHAR(30) NULL,
    `keluhan_tambahan` TEXT NULL,
    `penyakit_terpilih_id` BIGINT UNSIGNED NOT NULL,
    `nilai_cf_akhir` DECIMAL(5, 4) NOT NULL,
    `persentase` DECIMAL(5, 2) NOT NULL,
    `tanggal_diagnosa` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_riwayat_user` (`user_id`),
    INDEX `idx_riwayat_tanggal` (`tanggal_diagnosa`),
    CONSTRAINT `fk_riwayat_user` FOREIGN KEY (`user_id`)
        REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT `fk_riwayat_kategori` FOREIGN KEY (`kategori_id`)
        REFERENCES `kategori_hewan` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT `fk_riwayat_penyakit` FOREIGN KEY (`penyakit_terpilih_id`)
        REFERENCES `penyakit` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- 8. hasil_diagnosa (BARU)
-- Menyimpan SEMUA kandidat penyakit + CF kombinasi + ranking
-- (riwayat_diagnosa hanya menyimpan penyakit teratas)
-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `hasil_diagnosa`;
CREATE TABLE `hasil_diagnosa` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `riwayat_id` BIGINT UNSIGNED NOT NULL,
    `penyakit_id` BIGINT UNSIGNED NOT NULL,
    `nilai_cf` DECIMAL(5, 4) NOT NULL,
    `persentase` DECIMAL(5, 2) NOT NULL,
    `ranking` TINYINT UNSIGNED NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY `unique_hasil` (`riwayat_id`, `penyakit_id`),
    INDEX `idx_hasil_penyakit` (`penyakit_id`),
    CONSTRAINT `fk_hasil_riwayat` FOREIGN KEY (`riwayat_id`)
        REFERENCES `riwayat_diagnosa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_hasil_penyakit` FOREIGN KEY (`penyakit_id`)
        REFERENCES `penyakit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---------------------------------------------------------------------
-- 9. detail_diagnosa
-- PERBAIKAN PENTING: ditambah penyakit_id. Satu gejala bisa dimiliki
-- beberapa penyakit dengan cf_pakar berbeda, sehingga cf_gejala
-- (= cf_user x cf_pakar) harus disimpan per pasangan penyakit-gejala.
-- ---------------------------------------------------------------------
DROP TABLE IF EXISTS `detail_diagnosa`;
CREATE TABLE `detail_diagnosa` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `riwayat_id` BIGINT UNSIGNED NOT NULL,
    `penyakit_id` BIGINT UNSIGNED NOT NULL,
    `gejala_id` BIGINT UNSIGNED NOT NULL,
    `cf_user` DECIMAL(3, 2) NOT NULL,
    `cf_pakar` DECIMAL(3, 2) NOT NULL,
    `cf_gejala` DECIMAL(5, 4) NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY `unique_detail` (`riwayat_id`, `penyakit_id`, `gejala_id`),
    INDEX `idx_detail_gejala` (`gejala_id`),
    INDEX `idx_detail_penyakit` (`penyakit_id`),
    CONSTRAINT `fk_detail_riwayat` FOREIGN KEY (`riwayat_id`)
        REFERENCES `riwayat_diagnosa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_detail_penyakit` FOREIGN KEY (`penyakit_id`)
        REFERENCES `penyakit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_detail_gejala` FOREIGN KEY (`gejala_id`)
        REFERENCES `gejala` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;

-- ---------------------------------------------------------------------
-- VIEW: basis pengetahuan versi terbaca (untuk halaman admin/pakar)
-- ---------------------------------------------------------------------
DROP VIEW IF EXISTS `v_basis_pengetahuan`;
CREATE VIEW `v_basis_pengetahuan` AS
SELECT
    bp.id,
    k.nama_kategori,
    p.kode_penyakit,
    p.nama_penyakit,
    g.kode_gejala,
    g.nama_gejala,
    bp.cf_pakar
FROM basis_pengetahuan bp
JOIN penyakit p ON p.id = bp.penyakit_id
JOIN gejala g ON g.id = bp.gejala_id
JOIN kategori_hewan k ON k.id = p.kategori_id;

-- =====================================================================
-- SEED DATA CONTOH (nilai & isi HARUS divalidasi oleh pakar/dokter hewan)
-- =====================================================================

-- Akun awal. GANTI password dengan hash bcrypt hasil aplikasi Anda.
INSERT INTO `users` (`name`, `email`, `password`, `role`) VALUES
('Administrator', 'admin@axionvet.test', 'GANTI_DENGAN_HASH_BCRYPT', 'admin'),
('Dokter Hewan', 'pakar@axionvet.test', 'GANTI_DENGAN_HASH_BCRYPT', 'pakar');

INSERT INTO `kategori_hewan` (`nama_kategori`, `slug`, `deskripsi`) VALUES
('Kucing', 'kucing', 'Kucing peliharaan'),
('Anjing', 'anjing', 'Anjing peliharaan'),
('Hewan Ternak', 'hewan-ternak', 'Sapi, kambing, domba, dan sejenisnya');

INSERT INTO `bobot_keyakinan` (`label`, `nilai_cf`, `urutan`) VALUES
('Tidak', 0.00, 1),
('Tidak tahu', 0.20, 2),
('Sedikit yakin', 0.40, 3),
('Cukup yakin', 0.60, 4),
('Yakin', 0.80, 5),
('Sangat yakin', 1.00, 6);

INSERT INTO `gejala` (`kategori_id`, `kode_gejala`, `nama_gejala`) VALUES
((SELECT id FROM kategori_hewan WHERE slug='kucing'), 'G001', 'Gatal hebat dan sering menggaruk'),
((SELECT id FROM kategori_hewan WHERE slug='kucing'), 'G002', 'Bulu rontok dan muncul area botak'),
((SELECT id FROM kategori_hewan WHERE slug='kucing'), 'G003', 'Keropeng atau kerak pada telinga/wajah'),
(NULL, 'G004', 'Muntah berulang'),
(NULL, 'G005', 'Diare'),
(NULL, 'G006', 'Nafsu makan hilang'),
(NULL, 'G007', 'Lesu dan lemas'),
(NULL, 'G008', 'Demam'),
((SELECT id FROM kategori_hewan WHERE slug='anjing'), 'G009', 'Batuk'),
((SELECT id FROM kategori_hewan WHERE slug='anjing'), 'G010', 'Keluar cairan/ingus dari mata dan hidung');

INSERT INTO `penyakit` (`kategori_id`, `kode_penyakit`, `nama_penyakit`, `deskripsi`, `solusi`) VALUES
((SELECT id FROM kategori_hewan WHERE slug='kucing'), 'P001', 'Scabies (Kudis)',
 'Infestasi tungau pada kulit yang menimbulkan gatal dan kerontokan bulu.',
 'Segera konsultasikan ke dokter hewan untuk pemberian obat anti-tungau; pisahkan dari hewan lain dan bersihkan lingkungan.'),
((SELECT id FROM kategori_hewan WHERE slug='kucing'), 'P002', 'Feline Panleukopenia',
 'Infeksi virus pada kucing yang menyerang saluran cerna dan sistem imun.',
 'Kondisi serius, segera bawa ke dokter hewan; pisahkan dari kucing lain dan pastikan vaksinasi lengkap.'),
((SELECT id FROM kategori_hewan WHERE slug='anjing'), 'P003', 'Canine Distemper',
 'Infeksi virus pada anjing yang menyerang saluran napas, cerna, dan saraf.',
 'Kondisi serius, segera bawa ke dokter hewan; isolasi hewan dan lengkapi vaksinasi.');

INSERT INTO `basis_pengetahuan` (`penyakit_id`, `gejala_id`, `cf_pakar`)
SELECT p.id, g.id, v.cf
FROM (
    SELECT 'P001' AS kp, 'G001' AS kg, 0.80 AS cf UNION ALL
    SELECT 'P001', 'G002', 0.60 UNION ALL
    SELECT 'P001', 'G003', 0.80 UNION ALL
    SELECT 'P002', 'G004', 0.60 UNION ALL
    SELECT 'P002', 'G005', 0.60 UNION ALL
    SELECT 'P002', 'G006', 0.40 UNION ALL
    SELECT 'P002', 'G007', 0.40 UNION ALL
    SELECT 'P002', 'G008', 0.60 UNION ALL
    SELECT 'P003', 'G005', 0.40 UNION ALL
    SELECT 'P003', 'G006', 0.40 UNION ALL
    SELECT 'P003', 'G008', 0.40 UNION ALL
    SELECT 'P003', 'G009', 0.60 UNION ALL
    SELECT 'P003', 'G010', 0.80
) v
JOIN penyakit p ON p.kode_penyakit = v.kp
JOIN gejala g ON g.kode_gejala = v.kg;
