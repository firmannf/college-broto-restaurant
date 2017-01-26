CREATE TABLE IF NOT EXISTS pegawai(
    nik VARCHAR(21) PRIMARY KEY,
    nama_pegawai VARCHAR(31) NOT NULL,
    password VARCHAR(101) NOT NULL,
    pekerjaan ENUM('Admin', 'Customer Service', 'Kasir', 'Koki', 'Pantry', 'Pelayan') DEFAULT 'Pelayan' NOT NULL
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS meja(
    id_meja INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama_meja VARCHAR(11) NOT NULL,
    status ENUM('Kosong', 'Terisi', 'Siap Saji', 'Bayar') DEFAULT 'Kosong' NOT NULL
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS pesanan(
    id_pesanan INT(11) AUTO_INCREMENT PRIMARY KEY,
    nik VARCHAR(21) NOT NULL,
    id_meja INT(11) NOT NULL,
    nama_pelanggan VARCHAR(51) NOT NULL,
    tgl_order DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    total_bayar DOUBLE DEFAULT 0,
    uang_bayar DOUBLE DEFAULT 0,
    status ENUM('Bayar', 'Belum Bayar') DEFAULT 'Belum Bayar' NOT NULL,
    
    CONSTRAINT fk_pesanan_pegawai FOREIGN KEY(nik) REFERENCES pegawai(nik) ON UPDATE CASCADE,
    CONSTRAINT fk_pesanan_meja FOREIGN KEY(id_meja) REFERENCES meja(id_meja) ON UPDATE CASCADE
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS kuesioner(
    id_kuesioner INT(11) AUTO_INCREMENT PRIMARY KEY,
    id_pesanan INT(11) NOT NULL,
    pelayanan TINYINT NOT NULL,
    harga TINYINT NOT NULL,
    makanan TINYINT NOT NULL,
    minuman TINYINT NOT NULL,
    review VARCHAR(401),
    
    CONSTRAINT fk_kuesioner_pesanan FOREIGN KEY(id_pesanan) REFERENCES pesanan(id_pesanan) ON UPDATE CASCADE
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS bahanbaku(
    id_bahanbaku INT(11) AUTO_INCREMENT PRIMARY KEY,
    nik VARCHAR(21) NOT NULL,
    nama_bahanbaku VARCHAR(51) NOT NULL,
    satuan VARCHAR(31) NOT NULL,
    
    CONSTRAINT fk_bahanbaku_pegawai FOREIGN KEY(nik) REFERENCES pegawai(nik) ON UPDATE CASCADE
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS bahanbaku_detail(
    id_detail_bahanbaku INT(11) AUTO_INCREMENT PRIMARY KEY,
    id_bahanbaku INT(11) NOT NULL,
    qty FLOAT NOT NULL,
    tgl_masuk DATE NOT NULL,
    tgl_kadaluarsa DATE NOT NULL,

    CONSTRAINT fk_detail_bahanbaku FOREIGN KEY(id_bahanbaku) REFERENCES bahanbaku(id_bahanbaku) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS menu(
    id_menu INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama_menu VARCHAR(51) NOT NULL,
    foto VARCHAR(51) NOT NULL,
    kategori ENUM('Makanan', 'Minuman') DEFAULT 'makanan' NOT NULL,
    estimasi_penyajian TINYINT NOT NULL,
    harga DOUBLE NOT NULL,
    diskon ENUM('Ya', 'Tidak') DEFAULT 'Tidak' NOT NULL,
    status ENUM('Ya', 'Tidak') DEFAULT 'TIDAK' NOT NULL
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS menu_detail(
    id_detail_menu INT(11) AUTO_INCREMENT PRIMARY KEY,
    id_menu INT(11) NOT NULL,
    id_bahanbaku INT(11) NOT NULL,

    CONSTRAINT fk_detail_menu FOREIGN KEY(id_menu) REFERENCES menu(id_menu) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_detail_menu_bahanbaku FOREIGN KEY(id_bahanbaku) REFERENCES bahanbaku(id_bahanbaku) ON UPDATE CASCADE
)ENGINE=INNODB;