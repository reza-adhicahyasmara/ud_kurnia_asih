<div id="alert_edit"></div>
<input type="hidden" id="jenis" value="Tambah">
<div class="form-group">
    <div class="form-group mb-3">
        <div class="d-flex justify-content-center mt-5 mb-5">
            <div class="dropzone dz-clickable" id="my_drop" style="border-radius:50%; border:1px solid #ced4da; width: 150px; height: 150px">
                <div class="dz-default dz-message" data-dz-message="">
                    <img src="<?php echo base_url('assets/img/banner/image_add.svg');?>" class="product-image" id="teks_member" alt="Image" style="width:100px; height:100px; margin-left: -20px; margin-right: -20px; margin-top: -30px; vertical-align: top;">   
                </div>
            </div>
        </div>
        <input type="hidden" class="form-control" name="foto_supplier" id="foto_supplier">
    </div>
</div>
<div class="form-group">
    <label>Nama Supplier</label>
    <input type="text" class="form-control" name="nama_supplier" id="nama_supplier" placeholder="Nama Supplier">
</div>
<div class="form-group">
    <label>PIC</label>
    <input type="text" class="form-control" name="pic_supplier" id="pic_supplier" placeholder="PIC">
</div>
<div class="form-group">
    <label>Alamat</label>
    <textarea type="text" class="form-control" name="alamat_supplier" id="alamat_supplier" placeholder="Alamat" style="height:100px;"></textarea>
</div>
<div class="form-group">
    <label>No. Telepon / HP</label>
    <input type="text" class="form-control" name="kontak_supplier" id="kontak_supplier" placeholder="No. Telepon / HP">
</div>
<div class="form-group">
    <label>Username</label>
    <input type="text" class="form-control" name="username_supplier_baru" id="username_supplier_baru" placeholder="Username">
</div>
<div class="form-group">
    <label>Password</label>
    <input type="text" class="form-control" name="password_supplier" id="password_supplier" placeholder="Password">
</div>

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