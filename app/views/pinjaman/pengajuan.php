<div class="pagetitle">
    <h1>Titipkan uang anda pada kami</h1>
</div>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Total Pinjaman Anda</h5>
        <div class="row">
            <div class="col-lg-6">
            <ul class="list-group">
                <li class="list-group-item active" aria-current="true" style="font-size:40px"><b>Rp</b><?php if (!isset($data['saldo']['total_pinjaman'])) { echo "0"; } else { echo $data['saldo']['total_pinjaman']; } ?></li>
            </ul>

            </div>
            <div class="col-lg-6"></div>

            <div class="col-lg-6 mt-4">
                <h5 class="card-title">Ajukan Pinjaman</h5>
                <form action="<?=BASEURL;?>/Pinjaman/pinjam" method="POST">
                    <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Nominal</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="nominal" aria-label="Default select example">
                        <option value="0" selected="">Pilih Nominal</option>
                        <option value="50000">Rp 50000</option>
                        <option value="100000">Rp 100000</option>
                        <option value="250000">Rp 250000</option>
                        <option value="500000">Rp 500000</option>
                        <option value="1000000">Rp 1000000</option>
                        </select>
                    </div>
                    </div>

                    <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Pinjam Sekarang</button>
                    </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-6 mt-4">
                <h5 class="card-title">Pinjaman Anda</h5>
                <!-- Default Table -->
                <table class="table">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Jumlah Pengajuan</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Status</th>
            <th scope="col">Opsi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['pinjaman'] as $index => $pinjaman) : ?>
            <tr>
                <th scope="row"><?= $index + 1; ?></th>
                <td>Rp<?= $pinjaman['jml_pinjaman']; ?></td>
                <td><?= $pinjaman['tgl_pinjaman']; ?></td>
                <td>
                    <span class="badge bg-warning text-dark"><?= $pinjaman['status_pinjaman']; ?></span>
                </td>
                <td>
                    <?php if ($pinjaman['status_pinjaman'] == 'Diproses') : ?>
                        <button type="button" class="btn btn-warning"><i class="bi bi-cash-coin"></i>Diproses</button>
                    <?php else : ?>
                        <button type="button" class="btn btn-success"><i class="bi bi-cash-stack"></i> Bayar</button>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


            </div>
        </div>
    </div>
</div>