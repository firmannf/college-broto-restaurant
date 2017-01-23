CREATE TABLE IF NOT EXISTS pegawai(
    nik VARCHAR(21) PRIMARY KEY,
    nama VARCHAR(31) NOT NULL,
    pekerjaan ENUM('Admin', 'Customer Service', 'Kasir', 'Koki', 'Pantry', 'Pelayan') DEFAULT 'Pelayan' NOT NULL,
    password VARCHAR(101) NOT NULL
)ENGINE=INNODB;