<div id="alert_edit"></div>
<input type="hidden" id="jenis" value="Edit">
<?php foreach($edit->result() as $edit) { ?>
<div class="form-group">
    <label>Kode Produk</label>
    <input type="hidden" class="form-control" name="kode_produk_lama" id="kode_produk_lama" value="<?php echo $edit->kode_produk; ?>" readonly placeholder="Kode">
    <input type="text" class="form-control" name="kode_produk_baru" id="kode_produk_baru" value="<?php echo $edit->kode_produk; ?>" readonly placeholder="Kode">
</div>
<div class="form-group">
    <label>Nama Produk</label>
    <input type="hidden" class="form-control" name="nama_produk_lama" id="nama_produk_lama" value="<?php echo $edit->nama_produk; ?>" placeholder="Nama / Merek Produk">
    <input type="text" class="form-control" name="nama_produk_baru" id="nama_produk_baru" value="<?php echo $edit->nama_produk; ?>" placeholder="Nama / Merek Produk">
</div>
<div class="form-group">
    <label>Kategori</label>
    <select class="form-control kode_kategori" name="kode_kategori" id="kode_kategori">
        <option value="">Pilih</option>
        <?php foreach($kategori->result() as $row){ ?>
        <option value="<?php echo $row->kode_kategori; ?>" <?php if($edit->kode_kategori == $row->kode_kategori){echo "selected";} ?>><?php echo $row->nama_kategori; ?></option>
        <?php } ?> 
    </select>
</div>
<div class="form-group">
    <label>Satuan</label>
    <select class="form-control kode_satuan" name="kode_satuan" id="kode_satuan">
        <option value="">Pilih</option>
        <?php foreach($satuan->result() as $row){ ?>
        <option value="<?php echo $row->kode_satuan; ?>" <?php if($edit->kode_satuan == $row->kode_satuan){echo "selected";} ?>><?php echo $row->nama_satuan; ?></option>
        <?php } ?> 
    </select>
</div>
<div class="form-group">
    <label>Harga</label>
    <input type="text" class="form-control" name="harga_produk" id="harga_produk" value="<?php echo $edit->harga_produk; ?>" placeholder="Rupiah">
</div>
<div class="form-group">
    <label>Stok Limit</label>
    <input type="text" class="form-control" name="stok_limit_produk" id="stok_limit_produk" value="<?php echo $edit->stok_limit_produk; ?>" placeholder="Batas jumlah limit untuk menjaga stok gudang">
</div>
<?php } ?>

<script>
    $("#stok_limit_produk").on("input", function(){
        var regexp = /[^0-9]/g;
        if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
        }
    });

    $("#harga_produk").on("input", function(){
        var regexp = /[^0-9]/g;
        if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
        }
    });
    
    $(document).ready(function() {
        $('.kode_kategori').select2({
            theme: 'bootstrap4',
        })
    });
    
    $(document).ready(function() {
        $('.kode_satuan').select2({
            theme: 'bootstrap4',
        })
    });
</script>