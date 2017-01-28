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

CREATE TABLE IF NOT EXISTS bahanbaku(
    id_bahanbaku INT(11) AUTO_INCREMENT PRIMARY KEY,
    nik VARCHAR(21) NOT NULL,
    nama_bahanbaku VARCHAR(51) NOT NULL,
    stok FLOAT NOT NULL,
    satuan VARCHAR(31) NOT NULL,
    tgl_masuk DATE NOT NULL,
    tgl_kadaluarsa DATE NOT NULL,
    
    CONSTRAINT fk_bahanbaku_pegawai FOREIGN KEY(nik) REFERENCES pegawai(nik) ON UPDATE CASCADE
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS menu(
    id_menu INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama_menu VARCHAR(51) NOT NULL,
    foto VARCHAR(51) NOT NULL,
    kategori ENUM('Makanan', 'Minuman') DEFAULT 'makanan' NOT NULL,
    estimasi_penyajian TINYINT NOT NULL,
    harga DOUBLE NOT NULL,
    status ENUM('Ya', 'Tidak') DEFAULT 'TIDAK' NOT NULL
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS menu_detail(
    id_detail_menu INT(11) AUTO_INCREMENT PRIMARY KEY,
    id_menu INT(11) NOT NULL,
    id_bahanbaku INT(11) NOT NULL,
    qty FLOAT NOT NULL,

    CONSTRAINT fk_detail_menu FOREIGN KEY(id_menu) REFERENCES menu(id_menu) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_detail_menu_bahanbaku FOREIGN KEY(id_bahanbaku) REFERENCES bahanbaku(id_bahanbaku) ON UPDATE CASCADE
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS pesanan(
    id_pesanan INT(11) AUTO_INCREMENT PRIMARY KEY,
    nik VARCHAR(21),
    id_meja INT(11) NOT NULL,
    nama_pelanggan VARCHAR(51) NOT NULL,
    tgl_order DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    total_bayar DOUBLE DEFAULT 0,
    uang_bayar DOUBLE DEFAULT 0,
    status ENUM('Bayar', 'Belum Bayar') DEFAULT 'Belum Bayar' NOT NULL,
    
    CONSTRAINT fk_pesanan_pegawai FOREIGN KEY(nik) REFERENCES pegawai(nik) ON UPDATE CASCADE,
    CONSTRAINT fk_pesanan_meja FOREIGN KEY(id_meja) REFERENCES meja(id_meja) ON UPDATE CASCADE
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS pesanan_detail(
    id_detail_pesanan INT(11) AUTO_INCREMENT PRIMARY KEY,
    id_pesanan INT(11) NOT NULL,
    id_menu INT(11) NOT NULL,
    qty TINYINT NOT NULL,
    status ENUM('Sudah', 'Belum') DEFAULT 'Belum' NOT NULL,
    
    CONSTRAINT fk_detail_pesanan FOREIGN KEY(id_pesanan) REFERENCES pesanan(id_pesanan) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_detail_pesanan_menu FOREIGN KEY(id_menu) REFERENCES menu(id_menu) ON UPDATE CASCADE
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

LOCK TABLES `pegawai` WRITE;
INSERT INTO `pegawai` VALUES ('10114003','Evan Gilang R','9935d767dccd8afff816e5984b792130','Koki'),('10114037','Berry Baltschun','dd3ac120bddd494cd007475d3fa4bd14','Customer Service'),('10114426','Taufiq Nugraha','249b7c75a418dcb7e65f23e2e66ffe10','Kasir'),('10114474','Faisal Ishak','16e3ec72e9cc88a1104bad58da4b26fc','Pantry'),('10119999','Diego Costa','30c9644542fcf608ec266b876d587cd1','Pelayan'),('12345','Broto','827ccb0eea8a706c4c34a16891f84e7b','Admin');
UNLOCK TABLES;

LOCK TABLES `meja` WRITE;
INSERT INTO `meja` VALUES (1,'Meja 1','Kosong');
UNLOCK TABLES;

LOCK TABLES `bahanbaku` WRITE;
INSERT INTO `bahanbaku` VALUES (13,'10114474','Gula', '12', 'kilogram', '0000-00-00', '0000-00-00');
UNLOCK TABLES;

LOCK TABLES `menu` WRITE;
INSERT INTO `menu` VALUES (1,'Nasi Goreng','bbqribs.jpg','Makanan',13,20000,'Ya'),(2,'Nasi Kuning','bbqribs.jpg','Makanan',13,10000,'Ya');
UNLOCK TABLES;

LOCK TABLES `menu_detail` WRITE;
INSERT INTO `menu_detail` VALUES (1,1,13,0.3);
UNLOCK TABLES;

LOCK TABLES `pesanan` WRITE;
INSERT INTO `pesanan` VALUES (1,'10114426',1,'Andrew','2017-01-27 00:00:00',36000,39000,'Bayar'),(2,'10114426',1,'Gerrrard','2017-02-15 00:00:00',0,0,'Bayar'),(3,'10114426',1,'Steve','2017-01-28 00:00:00',0,0,'Bayar');
UNLOCK TABLES;

LOCK TABLES `pesanan_detail` WRITE;
INSERT INTO `pesanan_detail` VALUES (1,1,1,2,2);
UNLOCK TABLES;

LOCK TABLES `kuesioner` WRITE;
INSERT INTO `kuesioner` VALUES (1,1,5,3,5,5,'Mantap banget'),(2,2,3,3,3,3,NULL),(3,3,4,4,4,4,NULL);
UNLOCK TABLES;