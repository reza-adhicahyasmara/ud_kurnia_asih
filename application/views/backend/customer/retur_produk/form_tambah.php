<?php foreach($data->result() as $row) { ?>
    <div class="form-group">
        <label>Produk</label>
        <input type="hidden" class="form-control" name="kode_produk" id="kode_produk" value="<?php echo $row->kode_produk; ?>" readonly>
        <input type="text" class="form-control" name="nama_produk" id="nama_produk" value="<?php echo $row->nama_produk; ?>" readonly>
    </div>
    <div class="form-group">
        <label>Jumlah Retur (<?php echo $row->nama_satuan; ?>)</label>
        <input type="text" class="form-control" name="jumlah_iretur_produk" id="jumlah_iretur_produk" placeholder="<?php echo $row->nama_satuan; ?>">
    </div>
    <div class="form-group">
        <label>Gambar</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="text" class="custom-file-input drop_retur dz-clickable" name="gambar_iretur_produk" id="gambar_iretur_produk">
                <label class="custom-file-label " id="label_gambar" for="gambar_iretur_produk">Bukti gambar retur</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>Keterangan Retur</label>
        <textarea type="text" class="form-control" name="keterangan_iretur_produk" id="keterangan_iretur_produk" placeholder="Keterangan" minlength="1" ></textarea>
    </div>
<?php } ?>

<script>  
    $("#jumlah_iretur_produk").on("input", function(){
        var regexp = /[^0-9]/g;
        if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
        }
    });  
</script>

<script>
    //Oploadna ditembak
    var url_save = "<?php echo base_url('customer/retur_produk/save_image'); ?>";
    var url_delete = "<?php echo base_url('customer/retur_produk/delete_image'); ?>";
    var gambar_iretur_produk1 = new Dropzone(".drop_retur",{ 
        url: url_save,
        autoDiscover : false,
        acceptedFiles : 'image/*',
        dictInvalidFileType:"Type file ini tidak dizinkan",
        dictMaxFilesExceeded: "Hanya dapat unggah satu gambar",
        dictRemoveFile: "Hapus",
        addRemoveLinks:true,
        init: function(){  
            var foto = $('#gambar_iretur_produk').val();
            if(foto == null){
                this.on("success",function(file,response){
                    $('#gambar_iretur_produk').val(response);
                    $('label#label_gambar').text(response);
                }); 
            }else{
                this.on("success",function(file,response){
                    $('#gambar_iretur_produk').val(response);
                    $('label#label_gambar').text(response);
                    $.ajax({
                        url: url_delete,
                        type: "post",
                        data: {gambar_iretur_produk:foto},
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
    gambar_iretur_produk1.on("removedfile",function(){
        var gambar_iretur_produk = $('#gambar_iretur_produk').val();
        $.ajax({
            url: url_delete,
            type: "post",
            data: {gambar_iretur_produk:gambar_iretur_produk},
            cache: false,
            dataType: 'json',
            success: function(response){
                if(response == 1){
                    $("#gambar_iretur_produk").val("");
                    $("label#label_gambar").text("");
                }
            }
        });
    });
</script>