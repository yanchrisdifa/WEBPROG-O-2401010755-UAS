CREATE DATABASE finance_app;

USE finance_app;

CREATE TABLE transaksi (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  tanggal DATE,
  tipe ENUM('pemasukan', 'pengeluaran'),
  jumlah INT,
  deskripsi VARCHAR(255)
);
