<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header neu-brutalism-border">
            <h1><?= $title; ?></h1>
        </div>

        <?= $this->session->flashdata('message'); ?>

        <div class="card p-4">
            <h5 class="mb-3">Data Pendaftaran Pasien</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Nama</th>
                            <th>Tgl Kunjungan</th>
                            <th>Jam</th>
                            <th>Dokter</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pendaftaran as $p): ?>
                            <tr>
                                <td><?= $p['nama']; ?></td>
                                <td><?= $p['tanggal_kunjungan']; ?></td>
                                <td><?= $p['jam_kunjungan']; ?></td>
                                <td><?= $p['dokter_spesialis']; ?></td>
                                <td>
                                    <?php
                                    if ($p['status'] == 'disetujui') {
                                        echo '<span class="badge badge-success">Disetujui</span>';
                                    } elseif ($p['status'] == 'ditolak') {
                                        echo '<span class="badge badge-danger">Ditolak</span>';
                                    } else {
                                        echo '<span class="badge badge-warning">Menunggu</span>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/ubah_status/' . $p['id'] . '/disetujui'); ?>" class="btn btn-success btn-sm">Setujui</a>
                                    <a href="<?= base_url('admin/ubah_status/' . $p['id'] . '/ditolak'); ?>" class="btn btn-danger btn-sm">Tolak</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($pendaftaran)): ?>
                            <tr>
                                <td colspan="6" class="text-center">Belum ada pendaftaran.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
