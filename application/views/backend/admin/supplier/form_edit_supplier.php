<div id="alert_edit"></div>
<input type="hidden" id="jenis" value="Edit">
<?php foreach($edit->result() as $edit) { ?>
<div class="form-group">
    <div class="d-flex justify-content-center mt-3 mb-5"> 
        <div class="dropzone dz-clickable" id="my_drop" style="border-radius:50%; border:1px solid #ced4da; width: 150px; height: 150px">
            <div class="dz-default dz-message" data-dz-message="" style="margin-left: -20px; margin-right: -20px;">
                <?php if($edit->foto_supplier != "") { ?>
                    <img src="<?php echo base_url('assets/img/supplier/'.$edit->foto_supplier);?>" class="product-image" id="foto" alt="Image" style="width:150px; height:150px; margin-left: -50px; margin-right: -50px; margin-top: -50px; vertical-align: top; border-radius: 50%; object-fit: cover; overflow:hidden">
                    <img src="<?php echo base_url('assets/img/banner/image_add.svg');?>" class="product-image"  id="assets_supplier" alt="Image" style="width:100px; height:100px; margin-top: -30px; vertical-align: top; display: none;">   
                    </br>
                    <a href="#" id="teks_supplier" style="color: #007bff; display: block; margin-top: -30px; margin-bottom:15px;">Ganti</a>
                <?php }else{ ?>
                    <img src="<?php echo base_url('assets/img/banner/image_add.svg');?>" class="product-image" alt="Image" style="width:100px; height:100px; margin-top: -30px; vertical-align: top;">
                <?php } ?> 
                <?php if( $edit->foto_supplier != "") { ?>
                    <a href="#" id="hapus_gambar_supplier" style="color: #007bff; display: block; margin-top: 1px; margin-bottom:-16px;">Hapus</a>
                <?php } ?>
            </div>
        </div>
    </div>
    <input type="hidden" id="foto_supplier" name="foto_supplier" value="<?php echo $edit->foto_supplier; ?>"/>
</div>
<div class="form-group">
    <label>Nama Supplier</label>
    <input type="hidden" class="form-control" name="id_supplier" id="id_supplier" value="<?php echo $edit->id_supplier; ?>">
    <input type="text" class="form-control" name="nama_supplier" id="nama_supplier" value="<?php echo $edit->nama_supplier; ?>" placeholder="Nama Supplier" readonly>
</div>
<div class="form-group">
    <label>PIC</label>
    <input type="text" class="form-control" name="pic_supplier" id="pic_supplier" value="<?php echo $edit->pic_supplier; ?>" placeholder="PIC">
</div>
<div class="form-group">
    <label>Alamat</label>
    <textarea type="text" class="form-control" name="alamat_supplier" id="alamat_supplier" placeholder="Alamat" style="height:100px;"><?php echo $edit->alamat_supplier; ?></textarea>
</div>
<div class="form-group">
    <label>No. Telepon / HP</label>
    <input type="text" class="form-control" name="kontak_supplier" id="kontak_supplier" value="<?php echo $edit->kontak_supplier; ?>" placeholder="No. Telepon / HP">
</div>
<div class="form-group">
    <label>Username</label>
    <input type="hidden" class="form-control" name="username_supplier_lama" id="username_supplier_lama" value="<?php echo $edit->username_supplier; ?>" placeholder="Password">
    <input type="text" class="form-control" name="username_supplier_baru" id="username_supplier_baru" value="<?php echo $edit->username_supplier; ?>" placeholder="Password">
</div>
<div class="form-group">
    <label>Password</label>
    <input type="text" class="form-control" name="password_supplier" id="password_supplier" value="<?php echo $edit->password_supplier; ?>" placeholder="Password">
</div>
<?php } ?>

<script>
    $("#kontak_supplier").on("input", function(){
        var regexp = /[^0-9]/g;
        if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
        }
    });

    $("#pic_supplier").on("input", function(){
        var regexp = /[^a-z A-Z]/g;
        if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
        }
    });
</script>

<!-----------------------DROPZONE----------------------->
<script src="<?php echo base_url(); ?>assets/plugins/dropzone/dropzone.js"></script>
<script>
    //Oploadna ditembak
    Dropzone.autoDiscover = false;
    var url_delete = "<?php echo base_url('admin/supplier/hapus_foto'); ?>";
    var url_save = "<?php echo base_url('admin/supplier/simpan_foto'); ?>";

    var foto_supplier1 = new Dropzone("#my_drop",{ 
        url: url_save,
        maxFiles : 1,
        acceptedFiles : 'image/*',
        dictInvalidFileType:"Type file ini tidak dizinkan",
        dictMaxFilesExceeded: "Hanya dapat unggah satu gambar",
        dictRemoveFile: "Hapus",
        addRemoveLinks:true,
        init: function(){  
            var foto = $('#foto_supplier').val();
            if(foto == null){
                this.on("success",function(file,response){
                    $('#foto_supplier').val(response);
                }); 
            }else{
                this.on("success",function(file,response){
                    $('#foto_supplier').val(response);
                    $.ajax({
                        url: url_delete,
                        type: "post",
                        data: {foto_supplier:foto},
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
    foto_supplier1.on("removedfile",function(){
        var foto_supplier = $('#foto_supplier').val();
        $.ajax({
            url: url_delete,
            type: "post",
            data: {foto_supplier:foto_supplier},
            cache: false,
            dataType: 'json',
            success: function(response){
                if(response == 1){
                    $("#foto_supplier").val("");
                }
            }
        });
    });

     //Ngahapus gambar
     $('#hapus_gambar_supplier').on("click",function(){
        var foto_supplier = $('#foto_supplier').val();
        $.ajax({
            url: url_delete,
            type: "post",
            data: {foto_supplier:foto_supplier},
            cache: false,
            dataType: 'json',
            success: function(response){
                if(response == 1){
                    $("#foto_supplier").val("");
                    $("img#assets_supplier").show(500); 
                    $("img#foto").hide(500); 
                    $("a#teks_supplier").hide(500); 
                }
            }
        });
    });
</script>
