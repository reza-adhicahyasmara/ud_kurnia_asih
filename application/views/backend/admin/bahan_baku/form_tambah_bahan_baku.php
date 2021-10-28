<div id="alert_edit"></div>
<input type="hidden" id="jenis" value="Tambah">
<div class="form-group">
    <label>Kode Bahan Baku</label>
    <input type="text" class="form-control" name="kode_bahan_baku_baru" id="kode_bahan_baku_baru" placeholder="Kode">
</div>
<div class="form-group">
    <label>Nama Bahan Baku</label>
    <input type="text" class="form-control" name="nama_bahan_baku_baru" id="nama_bahan_baku_baru" placeholder="Nama / Merek Bahan Baku">
</div>
<div class="form-group">
    <label>Supplier</label>
    <select class="form-control id_supplier" name="id_supplier" id="id_supplier">
        <option value="">Pilih</option>
        <?php foreach($supplier->result() as $row){ ?>
        <option value="<?php echo $row->id_supplier; ?>"><?php echo $row->nama_supplier; ?></option>
        <?php } ?> 
    </select>
</div>
<div class="form-group">
    <label>Kategori</label>
    <select class="form-control kode_kategori" name="kode_kategori" id="kode_kategori">
        <option value="">Pilih</option>
        <?php foreach($kategori->result() as $row){ ?>
        <option value="<?php echo $row->kode_kategori; ?>"><?php echo $row->nama_kategori; ?></option>
        <?php } ?> 
    </select>
</div>
<div class="form-group">
    <label>Satuan</label>
    <select class="form-control kode_satuan" name="kode_satuan" id="kode_satuan">
        <option value="">Pilih</option>
        <?php foreach($satuan->result() as $row){ ?>
        <option value="<?php echo $row->kode_satuan; ?>"><?php echo $row->nama_satuan; ?></option>
        <?php } ?> 
    </select>
</div>
<div class="form-group">
    <label>Stok Limit</label>
    <input type="text" class="form-control" name="stok_limit_bahan_baku" id="stok_limit_bahan_baku" placeholder="Batas jumlah limit untuk menjaga stok gudang">
</div>
    
<script>
    $("#stok_limit_bahan_baku").on("input", function(){
        var regexp = /[^0-9]/g;
        if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
        }
    });
    
    $(document).ready(function() {
        $('.id_supplier').select2({
            theme: 'bootstrap4',
        })
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