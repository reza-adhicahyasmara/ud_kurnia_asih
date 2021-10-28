<input type="hidden" id="jenis" value="Edit">
<span id="alert"></span>
<?php foreach($edit->result() as $edit) { ?>
    <div class="form-group mb-3">
        <label>Nama Kategori</label>
        <input type="hidden" class="form-control" name="kode_kategori" id="kode_kategori" value="<?php echo $edit->kode_kategori; ?>" placeholder="Nama Kategori">
        <input type="hidden" class="form-control" name="nama_kategori_lama" id="nama_kategori_lama" value="<?php echo $edit->nama_kategori; ?>" placeholder="Nama Kategori">
        <input type="text" class="form-control" name="nama_kategori_baru" id="nama_kategori_baru" value="<?php echo $edit->nama_kategori; ?>" placeholder="Nama Kategori">
    </div>
<?php } ?>