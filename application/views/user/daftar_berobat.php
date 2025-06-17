<div class="main-content">
    <section class="section">
        <div class="section-header neu-brutalism-border">
            <h1><?= $title; ?></h1>
        </div>

        <?= $this->session->flashdata('message'); ?>

        <div class="card p-4">
            <form method="post" action="">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" value="<?= set_value('nama'); ?>">
                    <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" value="<?= set_value('tanggal_lahir'); ?>">
                    <?= form_error('tanggal_lahir', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control"><?= set_value('alamat'); ?></textarea>
                    <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label>No. Telepon</label>
                    <input type="text" name="no_telepon" class="form-control" value="<?= set_value('no_telepon'); ?>">
                    <?= form_error('no_telepon', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label>Keluhan Penyakit</label>
                    <textarea name="keluhan" class="form-control"><?= set_value('keluhan'); ?></textarea>
                    <?= form_error('keluhan', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label>Tanggal Kunjungan</label>
                    <input type="date" name="tanggal_kunjungan" class="form-control" value="<?= set_value('tanggal_kunjungan'); ?>">
                    <?= form_error('tanggal_kunjungan', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label>Jam Kunjungan</label>
                    <input type="time" name="jam_kunjungan" class="form-control" value="<?= set_value('jam_kunjungan'); ?>">
                    <?= form_error('jam_kunjungan', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label>Dokter Spesialis</label>
                    <select name="dokter_spesialis" class="form-control">
                        <option value="">-- Pilih Dokter --</option>
                        <option value="Umum" <?= set_select('dokter_spesialis', 'Umum'); ?>>Umum</option>
                        <option value="Anak" <?= set_select('dokter_spesialis', 'Anak'); ?>>Anak</option>
                        <option value="Saraf" <?= set_select('dokter_spesialis', 'Saraf'); ?>>Saraf</option>
                        <option value="Mata" <?= set_select('dokter_spesialis', 'Mata'); ?>>Mata</option>
                        <option value="Gigi" <?= set_select('dokter_spesialis', 'Gigi'); ?>>Gigi</option>
                    </select>
                    <?= form_error('dokter_spesialis', '<small class="text-danger">', '</small>'); ?>
                </div>

                <button type="submit" class="btn btn-primary">Kirim Pendaftaran</button>
            </form>
        </div>
    </section>
</div>
