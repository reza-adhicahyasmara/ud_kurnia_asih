<div id="alert_edit"></div>
<input type="hidden" id="jenis" value="Edit">
<?php foreach($edit->result() as $edit) { ?>
    <div class="form-group">
    <label>Kode</label>
    <input type="text" class="form-control" name="kode_bb" id="kode_bb" value="<?php echo $edit->kode_bb; ?>" readonly>
</div>
<div class="form-group">
    <label>Bahan Baku</label>
    <input type="text" class="form-control" name="nama_bb" id="nama_bb" value="<?php echo $edit->nama_bb; ?>" readonly>
</div>
<div class="form-group">
    <label>Harga Jual (Rp)</label>
    <input type="text" class="form-control" name="harga_bb" id="harga_bb" value="<?php echo $edit->harga_bb; ?>" placeholder="Rupiah">
</div>
<div class="form-group">
    <label>Stok Gudang Supplier (<?php echo $edit->nama_satuan; ?>)</label>
    <input type="text" class="form-control" name="stok_gudang_sup_bb" id="stok_gudang_sup_bb" value="<?php echo $edit->stok_gudang_sup_bb; ?>" placeholder="<?php echo $edit->nama_satuan; ?>">
</div>
<div class="form-group">
    <label>Stok Limit Supplier (<?php echo $edit->nama_satuan; ?>)</label>
    <input type="text" class="form-control" name="stok_limit_sup_bb" id="stok_limit_sup_bb" value="<?php echo $edit->stok_limit_sup_bb; ?>" placeholder="<?php echo $edit->nama_satuan; ?>">
</div>
<caption>
    Keterangan
    <ul>
        <li>Stok limit gudang akan memberikan pemberitahuan apabila stok akan mendekati batas limit.</li>
        <li>Pastikan update selalu stok gudang dan harga jual. Agar tidak terjadi kendala pada saat pabrik memesan produk</li>
    </ul>
</caption>
<?php } ?>


<script>
    $("#harga_bb").on("input", function(){
        var regexp = /[^0-9]/g;
        if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
        }
    });

    $("#stok_gudang_sup_bb").on("input", function(){
        var regexp = /[^0-9]/g;
        if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
        }
    });

    $("#stok_limit_sup_bb").on("input", function(){
        var regexp = /[^0-9]/g;
        if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
        }
    });
</script>