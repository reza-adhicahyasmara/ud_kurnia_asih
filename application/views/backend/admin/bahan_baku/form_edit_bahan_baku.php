<div id="alert_edit"></div>
<input type="hidden" id="jenis" value="Edit">
<?php foreach($edit->result() as $edit) { ?>
<div class="form-group">
    <label>Kode Bahan Baku</label>
    <input type="hidden" class="form-control" name="kode_bb_lama" id="kode_bb_lama" value="<?php echo $edit->kode_bb; ?>" readonly placeholder="Kode">
    <input type="text" class="form-control" name="kode_bb_baru" id="kode_bb_baru" value="<?php echo $edit->kode_bb; ?>" readonly placeholder="Kode">
</div>
<div class="form-group">
    <label>Nama Bahan Baku</label>
    <input type="hidden" class="form-control" name="nama_bb_lama" id="nama_bb_lama" value="<?php echo $edit->nama_bb; ?>" placeholder="Nama / Merek Bahan Baku">
    <input type="text" class="form-control" name="nama_bb_baru" id="nama_bb_baru" value="<?php echo $edit->nama_bb; ?>" placeholder="Nama / Merek Bahan Baku">
</div>
<div class="form-group">
    <label>Supplier</label>
    <select class="form-control id_supplier" name="id_supplier" id="id_supplier">
        <option value="">Pilih</option>
        <?php foreach($supplier->result() as $row){ ?>
        <option value="<?php echo $row->id_supplier; ?>" <?php if($edit->id_supplier == $row->id_supplier){echo "selected";} ?>><?php echo $row->nama_supplier; ?></option>
        <?php } ?> 
    </select>
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
    <label>Stok Limit</label>
    <input type="text" class="form-control" name="stok_limit_pab_bb" id="stok_limit_pab_bb" value="<?php echo $edit->stok_limit_pab_bb; ?>" placeholder="Batas jumlah limit untuk menjaga stok gudang">
</div>
<?php } ?>
    
<script>
    $("#stok_limit_pab_bb").on("input", function(){
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