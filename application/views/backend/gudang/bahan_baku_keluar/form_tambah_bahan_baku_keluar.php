<input type="hidden" id="jenis" value="Tambah">
<span id="alert"></span>
<div class="form-group">
    <label>Bahan Baku</label>
    <select class="form-control kode_bb" name="kode_bb" id="kode_bb">
        <option value="">Pilih</option>
        <?php foreach($bahan_baku->result() as $row){ ?>
        <option value="<?php echo $row->kode_bb; ?>" stok_gudang_pab_bb = <?php echo $row->stok_gudang_pab_bb; ?>><?php echo $row->nama_bb; ?></option>
        <?php } ?> 
    </select>
</div>
<div class="form-group mb-3">
    <label>Jumlah</label>
    <input type="number" class="form-control" name="jumlah_bb_keluar" id="jumlah_bb_keluar" min="0" placeholder="Jumlah">
    <input type="hidden" class="form-control" name="stok_gudang_pab_bb" id="stok_gudang_pab_bb" placeholder="Jumlah">
</div>
<div class="form-group mb-3">
    <label>Keterangan</label>
    <textarea class="form-control" name="keterangan_bb_keluar" id="keterangan_bb_keluar"></textarea>
</div>
<div class="form-group mb-3">
    <label>Tanggal</label>
    <input type="text" class="form-control" name="tanggal_bb_keluar" id="tanggal_bb_keluar" placeholder="Tanggal">
</div>

<script src="<?php echo base_url(); ?>assets/plugins/dropzone/dropzone.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datetimepicker/build/jquery.datetimepicker.full.js"></script>

<!-----------------------FUNGSI----------------------->
<script type="text/javascript">

    $(document).ready(function() {
        $('.kode_bb').select2({
            theme: 'bootstrap4',
        })
    });

    $(document).ready(function(){   
        $('#tanggal_bb_keluar').datetimepicker({
            //inline:true,
            autoclose: true,
            timepicker:false,
            format:'Y-m-d h:i:s',
        });
    });

    $('.kode_bb').on('change', function() {
        var stok_gudang_pab_bb = $('option:selected', this).attr('stok_gudang_pab_bb');
        $("#stok_gudang_pab_bb").val(stok_gudang_pab_bb);
    });    

</script>