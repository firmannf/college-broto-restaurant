CREATE TABLE IF NOT EXISTS pegawai(
    nik VARCHAR(21) PRIMARY KEY,
    nama VARCHAR(31) NOT NULL,
    pekerjaan ENUM('Admin', 'Customer Service', 'Kasir', 'Koki', 'Pantry', 'Pelayan') DEFAULT 'Pelayan' NOT NULL,
    password VARCHAR(101) NOT NULL
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS bahanbaku(
    bahanbaku_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(31) NOT NULL,
    total_qty FLOAT NOT NULL,
    satuan VARCHAR(31) NOT NULL,
    harga_per_satuan DOUBLE NOT NULL
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS bahanbaku_detail(
    bahanbaku_detail_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    bahanbaku_id INT(11) NOT NULL,
    qty FLOAT NOT NULL,
    tgl_kadaluarsa DATE NOT NULL,

    CONSTRAINT fk_bahan_baku_detail FOREIGN KEY(bahanbaku_id) REFERENCES bahanbaku(bahanbaku_id) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE=INNODB;