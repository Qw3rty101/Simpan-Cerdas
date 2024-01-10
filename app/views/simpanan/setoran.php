<div class="pagetitle">
    <h1>Titipkan uang anda pada kami</h1>
</div>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Saldo Anda</h5>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-group">
                    <li class="list-group-item active" aria-current="true" style="font-size:40px"><b>Rp</b><?= $data['saldo']['jml_simpanan'];?></li>
                </ul>
            </div>
            <div class="col-lg-6"></div>

            <div class="col-lg-12 mt-4">
            <h5 class="card-title">Setoran</h5>
            <form action="<?=BASEURL;?>/Simpanan/setor" method="POST">
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
                    <button type="submit" class="btn btn-primary">Setor Sekarang</button>
                  </div>
                </div>

              </form>
            </div>
        </div>
    </div>
</div>