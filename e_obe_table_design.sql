
-- Tabel Program Studi
CREATE TABLE Program_Studi (
    id_prodi INT PRIMARY KEY,
    nama_prodi VARCHAR(255)
);

-- Tabel Profil Lulusan
CREATE TABLE Profil_Lulusan (
    id_profil INT PRIMARY KEY,
    nama_profil VARCHAR(255),
    deskripsi_profil TEXT,
    id_prodi INT,
    FOREIGN KEY (id_prodi) REFERENCES Program_Studi(id_prodi)
);

-- Tabel CPL (Capaian Pembelajaran Lulusan)
CREATE TABLE CPL (
    id_cpl INT PRIMARY KEY,
    kode_cpl VARCHAR(100),
    isi_cpl VARCHAR(1000),
    deskripsi_cpl TEXT,
    kategori_cpl ENUM('sikap', 'pengetahuan', 'keterampilan_umum', 'keterampilan_khusus'),
    id_prodi INT,
    FOREIGN KEY (id_prodi) REFERENCES Program_Studi(id_prodi)
);

-- Tabel Bahan Kajian
CREATE TABLE Bahan_Kajian (
    id_bahan_kajian INT PRIMARY KEY,
    nama_bahan_kajian VARCHAR(255),
    deskripsi_bahan_kajian TEXT
);

-- Tabel Mata Kuliah
CREATE TABLE Mata_Kuliah (
    id_mk INT PRIMARY KEY,
    kode_mk VARCHAR(20),
    nama_mk VARCHAR(255),
    deskripsi_mk TEXT,
    sks_teori INT,
    sks_praktik INT,
    rumpun_mk VARCHAR(100),
    kategori_mk ENUM('wajib', 'pilihan'),
    semester_mk INT,
    id_prodi INT,
    FOREIGN KEY (id_prodi) REFERENCES Program_Studi(id_prodi)
);

-- Tabel CPMK (Capaian Pembelajaran Mata Kuliah)
CREATE TABLE CPMK (
    id_cpmk INT PRIMARY KEY,
    id_mk INT,
    konten_cpmk TEXT,
    FOREIGN KEY (id_mk) REFERENCES Mata_Kuliah(id_mk)
);

-- Tabel Sub-CPMK
CREATE TABLE Sub_CPMK (
    id_subcpmk INT PRIMARY KEY,
    id_cpmk INT,
    konten_subcpmk TEXT,
    FOREIGN KEY (id_cpmk) REFERENCES CPMK(id_cpmk)
);

-- Tabel Dosen
CREATE TABLE Dosen (
    id_dosen INT PRIMARY KEY,
    nama_dosen VARCHAR(255),
    id_prodi INT,
    FOREIGN KEY (id_prodi) REFERENCES Program_Studi(id_prodi)
);

-- Tabel Matrik CPL dan Profil Lulusan
CREATE TABLE Matrik_CPL_Profil (
    id_matrik_cpl_profil INT PRIMARY KEY,
    id_cpl INT,
    id_profil INT,
    FOREIGN KEY (id_cpl) REFERENCES CPL(id_cpl),
    FOREIGN KEY (id_profil) REFERENCES Profil_Lulusan(id_profil)
);

-- Tabel Matrik CPL dan Bahan Kajian
CREATE TABLE Matrik_CPL_BK (
    id_matrik_cpl_bk INT PRIMARY KEY,
    id_cpl INT,
    id_bahan_kajian INT,
    FOREIGN KEY (id_cpl) REFERENCES CPL(id_cpl),
    FOREIGN KEY (id_bahan_kajian) REFERENCES Bahan_Kajian(id_bahan_kajian)
);

-- Tabel Matrik CPL dan Mata Kuliah
CREATE TABLE Matrik_CPL_MK (
    id_matrik_cpl_mk INT PRIMARY KEY,
    id_cpl INT,
    id_mk INT,
    FOREIGN KEY (id_cpl) REFERENCES CPL(id_cpl),
    FOREIGN KEY (id_mk) REFERENCES Mata_Kuliah(id_mk)
);

-- Tabel Matrik Bahan Kajian dan Mata Kuliah
CREATE TABLE Matrik_BK_MK (
    id_matrik_bk_mk INT PRIMARY KEY,
    id_bahan_kajian INT,
    id_mk INT,
    FOREIGN KEY (id_bahan_kajian) REFERENCES Bahan_Kajian(id_bahan_kajian),
    FOREIGN KEY (id_mk) REFERENCES Mata_Kuliah(id_mk)
);

-- Tabel Mata Kuliah & Dosen (Pengampu)
CREATE TABLE MK_Dosen (
    id_mk_dosen INT PRIMARY KEY,
    id_mk INT,
    id_dosen INT,
    FOREIGN KEY (id_mk) REFERENCES Mata_Kuliah(id_mk),
    FOREIGN KEY (id_dosen) REFERENCES Dosen(id_dosen)
);

-- Tabel Tahapan Pembelajaran
CREATE TABLE Tahapan_Pembelajaran (
    id_tahapan INT PRIMARY KEY,
    minggu_ke INT,
    id_subcpmk INT,
    indikator TEXT,
    kriteria TEXT,
    metode_pembelajaran VARCHAR(100),
    materi_pembelajaran TEXT,
    bobot_penilaian DECIMAL(5,2),
    FOREIGN KEY (id_subcpmk) REFERENCES Sub_CPMK(id_subcpmk)
);
CREATE TABLE MBKM (
    id_mbkm INT PRIMARY KEY,
    nama_mbkm VARCHAR(255),
    jenis_mbkm ENUM('dalam_PT', 'luar_PT', 'non_PT'),
    deskripsi_mbkm TEXT,
    id_prodi INT,
    FOREIGN KEY (id_prodi) REFERENCES Program_Studi(id_prodi)
);

CREATE TABLE Matrik_MBKM_CPL (
    id_matrik_mbkm_cpl INT PRIMARY KEY,
    id_mbkm INT,
    id_cpl INT,
    FOREIGN KEY (id_mbkm) REFERENCES MBKM(id_mbkm),
    FOREIGN KEY (id_cpl) REFERENCES CPL(id_cpl)
);

CREATE TABLE RPS (
    id_rps INT PRIMARY KEY,
    id_mk INT,
    id_dosen INT,
    deskripsi_rps TEXT,
    FOREIGN KEY (id_mk) REFERENCES Mata_Kuliah(id_mk),
    FOREIGN KEY (id_dosen) REFERENCES Dosen(id_dosen)
);

CREATE TABLE Statistik_Aktivitas (
    id_aktivitas INT PRIMARY KEY,
    id_dosen INT,
    aktivitas VARCHAR(255),
    tanggal DATE,
    FOREIGN KEY (id_dosen) REFERENCES Dosen(id_dosen)
);

CREATE TABLE Pustaka (
    id_pustaka INT PRIMARY KEY,
    judul VARCHAR(255),
    jenis ENUM('utama', 'pendukung'),
    id_mk INT,
    FOREIGN KEY (id_mk) REFERENCES Mata_Kuliah(id_mk)
);

CREATE TABLE Materi_Pembelajaran (
    id_materi INT PRIMARY KEY,
    id_rps INT,
    nama_materi VARCHAR(255),
    FOREIGN KEY (id_rps) REFERENCES RPS(id_rps)
);