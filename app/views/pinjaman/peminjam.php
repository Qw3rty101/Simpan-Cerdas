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
                    <?php if($pinjaman['status_pinjaman'] == "Diproses" ):?>
                    <tr>
                        <th scope="row"><?= $index + 1; ?></th>
                        <td><?= $pinjaman['nama_anggota']; ?></td>
                        <td>Rp<?= $pinjaman['jml_pinjaman']; ?></td>
                        <td><?= $pinjaman['tgl_pinjaman']; ?></td>
                        <td>
                        <a href="<?= BASEURL; ?>/Pinjaman/terima/<?= $pinjaman['id_pinjaman']; ?>" class="btn btn-success">
                        <i class="bi bi-cash-stack"></i> Terima
                        </a>
                        <a href="<?= BASEURL; ?>/Pinjaman/tolak/<?= $pinjaman['id_pinjaman']; ?>" class="btn btn-danger">
                            <i class="bi bi-cash-stack"></i> Tolak
                        </a>
                        </td>
                    </tr>
                    <?php endif ?>
                <?php endforeach; ?>

            </tbody>
        </table>

        </div>
    </div>
</div>

