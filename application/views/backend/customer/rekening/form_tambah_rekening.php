<input type="hidden" id="jenis" value="Tambah">
<span id="alert"></span>
<div class="form-group mb-3">
    <label>Bank</label>
    <select class="form-control kode_bank" name="kode_bank" id="kode_bank">
        <option value="">Pilih</option>
        <?php foreach($bank->result() as $row){ ?>
        <option value="<?php echo $row->kode_bank; ?>"><?php echo $row->nama_bank; ?></option>
        <?php } ?> 
    </select>
</div>
<div class="form-group mb-3">
    <label>Atas Nama</label>
    <input type="text" class="form-control" name="an_rekening" id="an_rekening" placeholder="Atas Nama">
</div>
<div class="form-group mb-3">
    <label>No. Rekening</label>
    <input type="text" class="form-control" name="no_rekening" id="no_rekening" placeholder="No. Rekening">
</div>


<script>
    $("#no_rekening").on("input", function(){
        var regexp = /[^0-9]/g;
        if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
        }
    });

    $(document).ready(function() {
        $('.kode_bank').select2({
            theme: 'bootstrap4',
        })
    });
</script>