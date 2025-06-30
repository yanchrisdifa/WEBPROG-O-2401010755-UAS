<?php
require_once __DIR__ . '/../models/Transaksi.php';

class TransaksiController {
  private $model;

  public function __construct() {
    $this->model = new Transaksi();
  }

  public function index() {
    $data['transaksi'] = $this->model->getAll();
    $data['editData'] = isset($_GET['edit']) ? $this->model->getById($_GET['edit']) : null;
    include __DIR__ . '/../views/transaksi/index.php';
  }

  public function store() {
    $this->model->save($_POST);
    header('Location: index.php');
  }

  public function delete() {
    $this->model->delete($_GET['delete']);
    header('Location: index.php');
  }

  public function chartData() {
    $result = $this->model->getChartData();
    $data = [];
    while ($row = $result->fetch_assoc()) {
      $data[] = $row;
    }
    echo json_encode($data);
  }
}
