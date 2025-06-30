<?php
require_once __DIR__ . '/../core/db.php';

class Transaksi {
  private $conn;

  public function __construct() {
    $this->conn = connectDB();
  }

  public function getAll() {
    return $this->conn->query("SELECT * FROM transaksi ORDER BY tanggal DESC");
  }

  public function getById($id) {
    $id = (int) $id;
    $res = $this->conn->query("SELECT * FROM transaksi WHERE id=$id");
    return $res->fetch_assoc();
  }

  public function save($data) {
    if (!empty($data['id'])) {
      $stmt = $this->conn->prepare("UPDATE transaksi SET tanggal=?, tipe=?, jumlah=?, deskripsi=? WHERE id=?");
      $stmt->bind_param("ssisi", $data['tanggal'], $data['tipe'], $data['jumlah'], $data['deskripsi'], $data['id']);
    } else {
      $stmt = $this->conn->prepare("INSERT INTO transaksi (tanggal, tipe, jumlah, deskripsi) VALUES (?, ?, ?, ?)");
      $stmt->bind_param("ssis", $data['tanggal'], $data['tipe'], $data['jumlah'], $data['deskripsi']);
    }
    $stmt->execute();
  }

  public function delete($id) {
    $id = (int) $id;
    $this->conn->query("DELETE FROM transaksi WHERE id=$id");
  }

  public function getChartData() {
    $sql = "
      SELECT tanggal,
        SUM(CASE WHEN tipe = 'pemasukan' THEN jumlah ELSE 0 END) AS pemasukan,
        SUM(CASE WHEN tipe = 'pengeluaran' THEN jumlah ELSE 0 END) AS pengeluaran
      FROM transaksi
      GROUP BY tanggal
      ORDER BY tanggal ASC
    ";
    return $this->conn->query($sql);
  }
}
