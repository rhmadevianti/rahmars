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
                        <th>Nama Pasien</th>
                        <th>Dokter Spesialis</th>
                        <th>Tanggal Kunjungan</th>
                        <th>Jam Kunjungan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($jadwal as $j) : ?>
                        <tr>
                            <td><?= htmlspecialchars($j['nama']); ?></td>
                            <td><?= htmlspecialchars($j['dokter_spesialis']); ?></td>
                            <td><?= date('d-m-Y', strtotime($j['tanggal_kunjungan'])); ?></td>
                            <td><?= date('H:i', strtotime($j['jam_kunjungan'])); ?></td>
                            <td><?= ucfirst($j['status']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
