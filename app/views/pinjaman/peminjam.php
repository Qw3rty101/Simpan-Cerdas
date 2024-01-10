<div class="card">
    <div class="card-body">
        <h5 class="card-title">Data Pinjaman</h5>
    </div>

    <div class="row">
        <div class="col-lg-12">
        <table class="table datatable">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Yang Mengajukan</th>
                    <th scope="col">Nominal Yang Di Ajukan</th>
                    <th scope="col">Tanggal Pengajuan</th>
                    <th scope="col">Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['pinjaman'] as $index => $pinjaman) : ?>
                    <tr>
                        <th scope="row"><?= $index + 1; ?></th>
                        <td><?= $pinjaman['nama_anggota']; ?></td>
                        <td>Rp<?= $pinjaman['jml_pinjaman']; ?></td>
                        <td><?= $pinjaman['tgl_pinjaman']; ?></td>
                        <td>
                        <button type="button" class="btn btn-success" onclick="terimaPinjaman(<?= $pinjaman['id_pinjaman']; ?>)">
                        <i class="bi bi-cash-stack"></i> Terima
                    </button>
                    <button type="button" class="btn btn-danger" onclick="tolakPinjaman(<?= $pinjaman['id_pinjaman']; ?>)">
                        <i class="bi bi-cash-stack"></i> Tolak
                    </button>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>

        </div>
    </div>
</div>

<!-- Pastikan jQuery sudah disertakan -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    function terimaPinjaman(idPinjaman) {
        // Menggunakan jQuery untuk mengirim permintaan AJAX
        $.ajax({
            type: 'POST',
            url: '<?= BASEURL ?>/Pinjaman/terima', // Sesuaikan dengan URL controller Anda
            data: { id_pinjaman: idPinjaman },
            success: function(response) {
                console.log(response); // Tampilkan response dari server (debugging purposes)
                // Refresh halaman atau lakukan aksi lain setelah penerimaan berhasil
                location.reload();
            },
            error: function(error) {
                console.error(error); // Tampilkan error jika terjadi
            }
        });
    }

    function tolakPinjaman(idPinjaman) {
        // Menggunakan jQuery untuk mengirim permintaan AJAX
        $.ajax({
            type: 'POST',
            url: '<?= BASEURL ?>/Pinjaman/tolak', // Sesuaikan dengan URL controller Anda
            data: { id_pinjaman: idPinjaman },
            success: function(response) {
                console.log(response); // Tampilkan response dari server (debugging purposes)
                // Refresh halaman atau lakukan aksi lain setelah penolakan berhasil
                location.reload();
            },
            error: function(error) {
                console.error(error); // Tampilkan error jika terjadi
            }
        });
    }
</script>
