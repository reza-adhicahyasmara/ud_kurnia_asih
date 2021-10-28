<input type="hidden" id="jenis" value="Edit">
<span id="alert"></span>
<?php foreach($edit->result() as $edit) { ?>
    <div class="form-group mb-3">
        <label>Nama Satuan</label>
        <input type="hidden" class="form-control" name="kode_satuan" id="kode_satuan" value="<?php echo $edit->kode_satuan; ?>" placeholder="Nama Satuan">
        <input type="hidden" class="form-control" name="nama_satuan_lama" id="nama_satuan_lama" value="<?php echo $edit->nama_satuan; ?>" placeholder="Nama Satuan">
        <input type="text" class="form-control" name="nama_satuan_baru" id="nama_satuan_baru" value="<?php echo $edit->nama_satuan; ?>" placeholder="Nama Satuan">
    </div>
<?php } ?>