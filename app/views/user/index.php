<div class="card">
    <div class="card-body">
        <h5 class="card-title">User</h5>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['anggota'] as $index => $anggota) : ?>
                        <tr>
                            <th scope="row"><?= $index + 1; ?></th>
                            <td><?= $anggota['nama_anggota']; ?></td>
                            <td><?= $anggota['email_anggota']; ?></td>
                            <td><?= $anggota['role_anggota']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

