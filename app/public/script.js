$(document).ready(function () {
  // Buka modal
  $('#openModalBtn').click(function () {
    $('#formModal form')[0].reset();
    $('#formModal input[name="id"]').val('');
    $('#formModal').removeClass('hidden');
  });

  // Tutup modal
  $('#closeModalBtn').click(function () {
    $('#formModal').addClass('hidden');
    window.location.href = 'index.php';
  });

  // Ambil data chart
  $.ajax({
    url: 'index.php?chart',
    method: 'GET',
    dataType: 'json',
    success: function (data) {
      const labels = data.map(item => item.tanggal);
      const pemasukan = data.map(item => parseInt(item.pemasukan));
      const pengeluaran = data.map(item => parseInt(item.pengeluaran));

      const ctx = document.getElementById('transaksiChart').getContext('2d');
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: labels,
          datasets: [
            {
              label: 'Pemasukan',
              data: pemasukan,
              borderColor: 'green',
              backgroundColor: 'rgba(0, 128, 0, 0.2)',
              fill: true
            },
            {
              label: 'Pengeluaran',
              data: pengeluaran,
              borderColor: 'red',
              backgroundColor: 'rgba(255, 0, 0, 0.2)',
              fill: true
            }
          ]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'top',
            },
            title: {
              display: true,
            }
          }
        },
      });
    }
  });
});
