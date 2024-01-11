<div class="pagetitle">
    <h1>Pinjam Uang</h1>
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
                        <?php if ($pinjaman['status_pinjaman'] != 'Lunas') : ?>
                            <tr>
                                <th scope="row"><?= $index + 1; ?></th>
                                <td>Rp<?= $pinjaman['jml_pinjaman']; ?></td>
                                <td><?= $pinjaman['tgl_pinjaman']; ?></td>
                                <td>
                                    <span class="badge bg-warning text-dark"><?= $pinjaman['status_pinjaman']; ?></span>
                                </td>
                                <td>
                                    <?php if ($pinjaman['status_pinjaman'] == 'Diproses') : ?>
                                        <button type="button" class="btn btn-warning"></button>
                                    <?php else : ?>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#basicModal" data-id-pinjaman="<?= $pinjaman['id_pinjaman']; ?>"><i class="bi bi-cash-stack"></i> Bayar</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    </tbody>
                </table>


              <!-- Basic Modal -->
              <div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Bayar dari <b>setoran</b> anda</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?=BASEURL;?>/Pinjaman/bayar" method="POST">
                            <div class="mb-3">
                            <label class="col-sm-2 col-form-label">Nominal</label>
                            <input type="hidden" name="id_pinjaman" value="<?= $pinjaman['id_pinjaman']; ?>">
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
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-success">Bayar</button>
                            </div>
                        </form>
                  </div>
                </div>
              </div><!-- End Basic Modal-->

            </div>
        </div>
    </div>
</div>