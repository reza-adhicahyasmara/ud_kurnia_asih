<input type="hidden" id="jenis" value="Edit">
<span id="alert"></span>
<?php foreach($edit->result() as $edit) { ?>
    <div class="form-group mb-3">
        <label>Nama Bank</label>
        <input type="hidden" class="form-control" name="kode_bank_lama" id="kode_bank_lama" value="<?php echo $edit->kode_bank; ?>" placeholder="Kode Bank">
        <input type="text" class="form-control" name="kode_bank_baru" id="kode_bank_baru" value="<?php echo $edit->kode_bank; ?>" placeholder="Kode Bank">
    <div class="form-group mb-3">
        <label>Nama Bank</label>
        <input type="text" class="form-control" name="nama_bank" id="nama_bank" value="<?php echo $edit->nama_bank; ?>" placeholder="Nama Bank">
    </div>
<?php } ?>

<script>
    $("#kode_bank_baru").on("input", function(){
        var regexp = /[^0-9]/g;
        if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
        }
    });
</script>