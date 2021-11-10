<input type="hidden" id="jenis" value="Edit">
<?php foreach($edit->result() as $edit) { ?> 
<div class="form-group">
    <div class="d-flex justify-content-center mt-3 mb-5"> 
        <div class="dropzone dz-clickable" id="my_drop" style="border-radius:50%; border:1px solid #ced4da; width: 150px; height: 150px">
            <div class="dz-default dz-message" data-dz-message="" style="margin-left: -20px; margin-right: -20px;">
                <?php if($edit->foto_karyawan != "") { ?>
                    <img src="<?php echo base_url('assets/img/karyawan/'.$edit->foto_karyawan);?>" class="product-image" id="foto" alt="Image" style="width:150px; height:150px; margin-left: -50px; margin-right: -50px; margin-top: -50px; vertical-align: top; border-radius: 50%; object-fit: cover; overflow:hidden">
                    <img src="<?php echo base_url('assets/img/banner/user.svg');?>" class="product-image"  id="assets_karyawan" alt="Image" style="width:100px; height:100px; margin-top: -30px; vertical-align: top; display: none;">   
                    </br>
                    <a href="#" id="teks_karyawan" style="color: #007bff; display: block; margin-top: -30px; margin-bottom:15px;">Ganti</a>
                <?php }else{ ?>
                    <img src="<?php echo base_url('assets/img/banner/user.svg');?>" class="product-image" alt="Image" style="width:100px; height:100px; margin-top: -30px; vertical-align: top;">
                <?php } ?> 
                <?php if( $edit->foto_karyawan != "") { ?>
                    <a href="#" id="hapus_gambar_karyawan" style="color: #007bff; display: block; margin-top: 1px; margin-bottom:-16px;">Hapus</a>
                <?php } ?>
            </div>
        </div>
    </div>
    <input type="hidden" id="foto_karyawan" name="foto_karyawan" value="<?php echo $edit->foto_karyawan; ?>"/>
</div>
<div class="form-group">
    <label for="nik_karyawan">NIK</label>
    <input type="text" class="form-control" name="nik_karyawan" id="nik_karyawan" value="<?php echo $edit->nik_karyawan; ?>" placeholder="NIK" readonly>
</div>
<div class="form-group">
    <label for="level_karyawan">Level</label>
    <select type="text" class="form-control" name="level_karyawan" id="level_karyawan" placeholder="Nama Lengkap">
        <option value="Admin" <?php if($edit->level_karyawan == "Admin"){echo "selected";} ?>>Admin</option>
        <option value="Gudang" <?php if($edit->level_karyawan == "Gudang"){echo "selected";} ?>>Gudang</option>
        <option value="Pimpinan" <?php if($edit->level_karyawan == "Pimpinan"){echo "selected";} ?>>Pimpinan</option>
    </select>
</div>
<div class="form-group">
    <label for="nama_karyawan">Nama</label>
    <input type="text" class="form-control" name="nama_karyawan" id="nama_karyawan" value="<?php echo $edit->nama_karyawan; ?>" placeholder="Nama">
</div>
<div class="form-group">
    <label for="alamat_karyawan">Alamat</label>
    <textarea type="text" class="form-control" name="alamat_karyawan" id="alamat_karyawan" placeholder="Alamat" style="height:100px;"><?php echo $edit->alamat_karyawan; ?></textarea>
</div>
<div class="form-group">
    <label for="kontak_karyawan">Kontak</label>
    <input type="text" class="form-control" name="kontak_karyawan" id="kontak_karyawan" value="<?php echo $edit->kontak_karyawan; ?>" placeholder="Kontak">
</div>
<div class="form-group">
    <label for="password_karyawan">Password</label>
    <input type="text" class="form-control" name="password_karyawan" id="password_karyawan" value="<?php echo $edit->password_karyawan; ?>" placeholder="Password">
</div>
<div class="form-group">
    <label for="username_karyawan_baru">Username</label>
    <input type="text" class="form-control" name="username_karyawan_baru" id="username_karyawan_baru" value="<?php echo $edit->username_karyawan; ?>" placeholder="Password">
    <input type="hidden" class="form-control" name="username_karyawan_lama" id="username_karyawan_lama" value="<?php echo $edit->username_karyawan; ?>" placeholder="Password">
</div>
<?php } ?>
      
<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
    $("#kontak_karyawan").on("input", function(){
        var regexp = /[^0-9]/g;
        if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
        }
    });

    $("#nama_karyawan").on("input", function(){
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
    var url_delete = "<?php echo base_url('pimpinan/karyawan/hapus_foto'); ?>";
    var url_save = "<?php echo base_url('pimpinan/karyawan/simpan_foto'); ?>";

    var foto_karyawan1 = new Dropzone("#my_drop",{ 
        url: url_save,
        maxFiles : 1,
        acceptedFiles : 'image/*',
        dictInvalidFileType:"Type file ini tidak dizinkan",
        dictMaxFilesExceeded: "Hanya dapat unggah satu gambar",
        dictRemoveFile: "Hapus",
        addRemoveLinks:true,
        init: function(){  
            var foto = $('#foto_karyawan').val();
            if(foto == null){
                this.on("success",function(file,response){
                    $('#foto_karyawan').val(response);
                }); 
            }else{
                this.on("success",function(file,response){
                    $('#foto_karyawan').val(response);
                    $.ajax({
                        url: url_delete,
                        type: "post",
                        data: {foto_karyawan:foto},
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
    foto_karyawan1.on("removedfile",function(){
        var foto_karyawan = $('#foto_karyawan').val();
        $.ajax({
            url: url_delete,
            type: "post",
            data: {foto_karyawan:foto_karyawan},
            cache: false,
            dataType: 'json',
            success: function(response){
                if(response == 1){
                    $("#foto_karyawan").val("");
                }
            }
        });
    });

     //Ngahapus gambar
     $('#hapus_gambar_karyawan').on("click",function(){
        var foto_karyawan = $('#foto_karyawan').val();
        $.ajax({
            url: url_delete,
            type: "post",
            data: {foto_karyawan:foto_karyawan},
            cache: false,
            dataType: 'json',
            success: function(response){
                if(response == 1){
                    $("#foto_karyawan").val("");
                    $("img#assets_karyawan").show(500); 
                    $("img#foto").hide(500); 
                    $("a#teks_karyawan").hide(500); 
                }
            }
        });
    });
</script>