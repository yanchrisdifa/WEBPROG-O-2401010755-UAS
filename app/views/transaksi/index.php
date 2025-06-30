<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Catatan Keuangan Harian</title>
  <link rel="stylesheet" href="public/style.css">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body class="flex flex-col items-center justify-center">
  <h2 class="text-3xl mb-4">Daftar Transaksi</h2>

  <!-- *************** MODAL FORM *************** -->
  <div id="formModal" class="fixed inset-0 bg-[#00000050] bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-[#101828] p-6 rounded-lg w-full max-w-xl relative">
      <button id="closeModalBtn" class="absolute top-2 right-2 text-xl cursor-pointer">&times;</button>
      <h2 class="text-center mb-4 text-2xl">Catatan Keuangan Harian</h2>

      <form method="POST" action="index.php" class="flex flex-col gap-4">
        <input type="hidden" name="id" value="<?= $data['editData']['id'] ?? '' ?>">

        <div class="flex gap-4">
          <div class="flex-1">
            <label>Tanggal:</label>
            <input type="date" name="tanggal" required value="<?= $data['editData']['tanggal'] ?? '' ?>" class="w-full border p-2">
          </div>
          <div class="flex-1">
            <label>Tipe:</label>
            <select name="tipe" required class="w-full border p-2">
              <option value="pemasukan" <?= ($data['editData']['tipe'] ?? '') === 'pemasukan' ? 'selected' : '' ?>>Pemasukan</option>
              <option value="pengeluaran" <?= ($data['editData']['tipe'] ?? '') === 'pengeluaran' ? 'selected' : '' ?>>Pengeluaran</option>
            </select>
          </div>
        </div>

        <div class="flex gap-4">
          <div class="flex-1">
            <label>Jumlah:</label>
            <input type="number" name="jumlah" required value="<?= $data['editData']['jumlah'] ?? '' ?>" class="w-full border p-2">
          </div>
          <div class="flex-1">
            <label>Deskripsi:</label>
            <input type="text" name="deskripsi" required value="<?= $data['editData']['deskripsi'] ?? '' ?>" class="w-full border p-2">
          </div>
        </div>

        <button type="submit" class="tw-bg-green-500 tw-text-white tw-px-4 tw-py-2 tw-rounded">Simpan</button>
      </form>
    </div>
  </div>

  <!-- *************** TOMBOL "TAMBAH TRANSAKSI" *************** -->
  <button id="openModalBtn" class="tw-px-4 tw-rounded mb-4 cursor-pointer self-start" type="button">+ Tambah Transaksi</button>

  <!-- *************** CHART TRANSAKSI *************** -->
  <canvas id="transaksiChart" height="80px" class="mb-8"></canvas>

  <!-- *************** TABEL TRANSAKSI *************** -->
  <div class="w-full">
    <table border="1" class="w-full">
      <thead>
        <tr>
          <th>Tanggal</th>
          <th>Tipe</th>
          <th>Jumlah</th>
          <th>Deskripsi</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $data['transaksi'] ->fetch_assoc()): ?>
        <tr>
          <td><?= $row['tanggal'] ?></td>
          <td><?= $row['tipe'] ?></td>
          <td><?= number_format($row['jumlah']) ?></td>
          <td><?= $row['deskripsi'] ?></td>
          <td>
            <a href="?edit=<?= $row['id'] ?>">Edit</a> |
            <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

  <script src="public/script.js"></script>

  <?php if (!empty($data['editData'])): ?>
  <script>
    $(document).ready(() => $('#formModal').removeClass('hidden'));
  </script>
  <?php endif; ?>
</body>
</html>
