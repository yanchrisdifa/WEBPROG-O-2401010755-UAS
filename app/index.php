<?php
require_once 'controllers/TransaksiController.php';

$controller = new TransaksiController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $controller->store();
} elseif (isset($_GET['delete'])) {
  $controller->delete();
} elseif (isset($_GET['chart'])) {
  $controller->chartData();
} else {
  $controller->index();
}
