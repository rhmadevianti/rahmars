<div class="main-content">
    <section class="section">
        <div class="section-header neu-brutalism-border">
            <h1><?= $title; ?></h1>
        </div>

        <div class="card p-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Kunjungan</th>
                        <th>Jam</th>
                        <th>Dokter</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($pendaftaran as $p): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $p['tanggal_kunjungan']; ?></td>
                            <td><?= $p['jam_kunjungan']; ?></td>
                            <td><?= $p['dokter_spesialis']; ?></td>
                            <td>
                                <?php if ($p['status'] == 'menunggu'): ?>
                                    <span class="badge badge-warning">Menunggu</span>
                                <?php elseif ($p['status'] == 'disetujui'): ?>
                                    <span class="badge badge-success">Disetujui</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">Ditolak</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($pendaftaran)) : ?>
                        <tr>
                            <td colspan="5" class="text-center">Belum ada pendaftaran.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>
