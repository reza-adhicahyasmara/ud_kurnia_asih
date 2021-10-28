<input type="hidden" id="jenis" value="Tambah">
<span id="alert"></span>
<div class="form-group mb-3">
    <label>Kode Bank</label>
    <input type="text" class="form-control" name="kode_bank_baru" id="kode_bank_baru" placeholder="Nama Bank">
</div>
<div class="form-group mb-3">
    <label>Nama Bank</label>
    <input type="text" class="form-control" name="nama_bank" id="nama_bank" placeholder="Nama Bank">
</div>

<script src="<?php echo base_url(); ?>assets/plugins/select2/js/select2.min.js"></script>
<script>
    $("#kode_bank_baru").on("input", function(){
        var regexp = /[^0-9]/g;
        if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
        }
    });
</script>