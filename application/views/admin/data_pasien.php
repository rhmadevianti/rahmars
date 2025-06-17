<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><?= $title; ?></h1>
    </div>

    <?= $this->session->flashdata('message'); ?>

    <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahPasienModal">Tambah Pasien</a>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Email</th>
          <th>Alamat</th>
            <th>Tanggal Lahir</th>
            <th>No. Telepon</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($pasien as $p): ?>
          <tr>
            <td><?= $p['nama']; ?></td>
            <td><?= $p['email']; ?></td>
                            <td><?= htmlspecialchars($p['alamat']); ?></td>
                            <td><?= date('d-m-Y', strtotime($p['tanggal_lahir'])); ?></td>
                            <td><?= htmlspecialchars($p['no_telepon']); ?></td>
            <td>
              <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editPasienModal<?= $p['id']; ?>">Edit</a>
              <a href="<?= base_url('admin/hapus_pasien/' . $p['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">Hapus</a>
            </td>
          </tr>

          <!-- Modal Edit -->
          <div class="modal fade" id="editPasienModal<?= $p['id']; ?>" tabindex="-1">
            <div class="modal-dialog">
              <form method="post" action="<?= base_url('admin/edit_pasien/' . $p['id']); ?>">
                <div class="modal-content">
                  <div class="modal-header"><h5>Edit Pasien</h5></div>
                  <div class="modal-body">
                    <input type="text" name="nama" class="form-control mb-2" value="<?= $p['nama']; ?>" required>
                    <input type="email" name="email" class="form-control mb-2" value="<?= $p['email']; ?>" required>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        <?php endforeach; ?>
      </tbody>
    </table>
  </section>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambahPasienModal" tabindex="-1">
  <div class="modal-dialog">
    <form method="post" action="<?= base_url('admin/tambah_pasien'); ?>">
      <div class="modal-content">
        <div class="modal-header"><h5>Tambah Pasien</h5></div>
        <div class="modal-body">
          <input type="text" name="nama" class="form-control mb-2" placeholder="Nama" required>
          <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success" type="submit">Tambah</button>
          <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>


