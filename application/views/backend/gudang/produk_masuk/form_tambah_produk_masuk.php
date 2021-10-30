<input type="hidden" id="jenis" value="Tambah">
<span id="alert"></span>
<div class="form-group">
    <label>Produk</label>
    <select class="form-control kode_produk" name="kode_produk" id="kode_produk">
        <option value="">Pilih</option>
        <?php foreach($produk->result() as $row){ ?>
        <option value="<?php echo $row->kode_produk; ?>" stok_gudang_produk = <?php echo $row->stok_gudang_produk; ?>><?php echo $row->nama_produk; ?></option>
        <?php } ?> 
    </select>
</div>
<div class="form-group mb-3">
    <label>Jumlah</label>
    <input type="number" class="form-control" name="jumlah_produk_masuk" id="jumlah_produk_masuk" min="0" placeholder="Jumlah">
    <input type="hidden" class="form-control" name="stok_gudang_produk" id="stok_gudang_produk" placeholder="Jumlah">
</div>
<div class="form-group mb-3">
    <label>Keterangan</label>
    <textarea class="form-control" name="keterangan_produk_masuk" id="keterangan_produk_masuk"></textarea>
</div>
<div class="form-group mb-3">
    <label>Tanggal</label>
    <input type="text" class="form-control" name="tanggal_produk_masuk" id="tanggal_produk_masuk" placeholder="Tanggal">
</div>

<script src="<?php echo base_url(); ?>assets/plugins/dropzone/dropzone.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datetimepicker/build/jquery.datetimepicker.full.js"></script>

<!-----------------------FUNGSI----------------------->
<script type="text/javascript">

    $(document).ready(function() {
        $('.kode_produk').select2({
            theme: 'bootstrap4',
        })
    });

    $(document).ready(function(){   
        $('#tanggal_produk_masuk').datetimepicker({
            //inline:true,
            autoclose: true,
            timepicker:false,
            format:'Y-m-d h:i:s'
        });
    });

    $('.kode_produk').on('change', function() {
        var stok_gudang_produk = $('option:selected', this).attr('stok_gudang_produk');
        $("#stok_gudang_produk").val(stok_gudang_produk);
    });    

</script>