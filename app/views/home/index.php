<div class="pagetitle">
    <h1>Selamat Datang di Simpan Cerdas</h1>
</div>

<section class="section dashboard">
    <div class="row">
        <div class="col-lg-6">
            <div class="col">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                    <h5 class="card-title">Saldo Keseluruhan <span>| Sekarang</span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-currency-dollar"></i>
                        </div>
                        <div class="ps-3">
                        <h6>Rp<?= $data['anggota'][0]['total_simpanan']; ?></h6>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="col">
                <div class="card info-card customers-card">
                    <div class="card-body">
                    <h5 class="card-title">Pengguna <span>| Keseluruhan</span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                        <h6><?= $data['anggota'][0]['total_anggota']; ?></h6>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>