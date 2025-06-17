<div class="main-content">
    <section class="section">
        <div class="section-header neu-brutalism-border">
            <h1><?= $title; ?></h1>
            <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th, table td {
            border: 1px solid #444;
            padding: 6px;
            text-align: left;
        }

        table th {
            background-color: #eee;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 10px;
        }
        
    </style>
        </div>
    
        <?= $this->session->flashdata('message'); ?>

        <div class="card p-4">
            <h5 class="mb-3">Laporan Pendaftaran Pasien</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Dokter</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($pendaftaran) && count($pendaftaran) > 0): ?>
                <?php foreach ($pendaftaran as $p): ?>
                    <tr>
                        <td><?= $p['nama'] ?></td>
                        <td><?= $p['dokter_spesialis'] ?></td>
                        <td><?= date('d-m-Y', strtotime($p['tanggal_kunjungan'])) ?></td>
                        <td><?= date('H:i', strtotime($p['jam_kunjungan'])) ?></td>
                        <td><?= ucfirst($p['status']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5">Tidak ada data</td></tr>
            <?php endif; ?>
</a>

        </tbody>
    </table>
</body>
</html>
