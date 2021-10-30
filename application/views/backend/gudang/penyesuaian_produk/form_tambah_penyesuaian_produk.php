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
    <label>Jumlah Selisih</label>
    <input type="number" class="form-control" name="jumlah_penyesuaian_produk" id="jumlah_penyesuaian_produk" placeholder="Jumlah">
    <input type="hidden" class="form-control" name="stok_gudang_produk" id="stok_gudang_produk" placeholder="Jumlah">
</div>
<div class="form-group mb-3">
    <label>Keterangan</label>
    <textarea class="form-control" name="keterangan_penyesuaian_produk" id="keterangan_penyesuaian_produk" placeholder="Keterangan"></textarea>
</div>
<div class="form-group mb-3">
    <label>Tanggal</label>
    <input type="text" class="form-control" name="tanggal_penyesuaian_produk" id="tanggal_penyesuaian_produk" placeholder="Tanggal">
</div>
<div class="form-group">
    <label>Bukti Gambar</label>
    <div class="form-group">
        <div class="d-flex justify-content-center mb-5">
            <div class="dropzone dz-clickable" id="my_drop" style="border-radius:50%; border:1px solid #ced4da; width: 150px; height: 150px">
                <div class="dz-default dz-message" data-dz-message="">
                    <img src="<?php echo base_url('assets/img/banner/image_add.svg');?>" class="product-image" id="teks_produk" alt="Image" style="width:100px; height:100px; margin-left: -20px; margin-right: -20px; margin-top: -30px; vertical-align: top;">   
                </div>
            </div>
        </div>
        <input type="hidden" class="form-control" name="gambar_penyesuaian_produk" id="gambar_penyesuaian_produk">
    </div>
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
        $('#tanggal_penyesuaian_produk').datetimepicker({
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


<!-----------------------DROPZONE----------------------->
<script>
    //Oploadna ditembak
    Dropzone.autoDiscover = false;
    var url_delete = "<?php echo base_url('gudang/penyesuaian_produk/hapus_foto'); ?>";
    var url_save = "<?php echo base_url('gudang/penyesuaian_produk/simpan_foto'); ?>";

    var gambar1 = new Dropzone("#my_drop",{ 
        url: url_save,
        maxFiles : 1,
        acceptedFiles : 'image/*',
        dictInvalidFileType:"Type file ini tidak dizinkan",
        dictMaxFilesExceeded: "Hanya dapat unggah satu gambar",
        dictRemoveFile: "Hapus",
        addRemoveLinks:true,
        init: function(){  
            var foto = $('#gambar_penyesuaian_produk').val();
            if(foto == null){
                this.on("success",function(file,response){
                    $('#gambar_penyesuaian_produk').val(response);
                }); 
            }else{
                this.on("success",function(file,response){
                    $('#gambar_penyesuaian_produk').val(response);
                    $.ajax({
                        url: url_delete,
                        type: "post",
                        data: {gambar_penyesuaian_produk:foto},
                        cache: false,
                        dataType: 'json',
                        success: function(response){
                            if(response == 1){
                            }
                        }
                    });
                });
            }
        }
    });

    //Teu jadi upload
    gambar1.on("removedfile",function(){
        var gambar_penyesuaian_produk = $('#gambar_penyesuaian_produk').val();
        $.ajax({
            url: url_delete,
            type: "post",
            data: {gambar_penyesuaian_produk:gambar_penyesuaian_produk},
            cache: false,
            dataType: 'json',
            success: function(response){
                if(response == 1){
                    $("#gambar_penyesuaian_produk").val("");
                }
            }
        });
    });

     //Ngahapus gambar
     $('#hapus_gambar_penyesuaian_produk').on("click",function(){
        var gambar_penyesuaian_produk = $('#gambar_penyesuaian_produk').val();
        $.ajax({
            url: url_delete,
            type: "post",
            data: {gambar_penyesuaian_produk:gambar_penyesuaian_produk},
            cache: false,
            dataType: 'json',
            success: function(response){
                if(response == 1){
                    $("#gambar_penyesuaian_produk").val("");
                    $("img#assets_produk").show(500); 
                    $("img#foto").hide(500); 
                    $("a#teks_produk").hide(500); 
                }
            }
        });
    });
</script>