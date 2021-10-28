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
        <input type="hidden" class="form-control" name="foto_customer" id="foto_customer">
    </div>
</div>
<div class="form-group">
    <label>Nama Customer</label>
    <input type="text" class="form-control" name="nama_customer" id="nama_customer" placeholder="Nama customer">
</div>
<div class="form-group">
    <label>PIC</label>
    <input type="text" class="form-control" name="pic_customer" id="pic_customer" placeholder="PIC">
</div>
<div class="form-group">
    <label>Alamat</label>
    <textarea type="text" class="form-control" name="alamat_customer" id="alamat_customer" placeholder="Alamat" style="height:100px;"></textarea>
</div>
<div class="form-group">
    <label>No. Telepon / HP</label>
    <input type="text" class="form-control" name="kontak_customer" id="kontak_customer" placeholder="No. Telepon / HP">
</div>
<div class="form-group">
    <label>Username</label>
    <input type="text" class="form-control" name="username_customer_baru" id="username_customer_baru" placeholder="Username">
</div>
<div class="form-group">
    <label>Password</label>
    <input type="text" class="form-control" name="password_customer" id="password_customer" placeholder="Password">
</div>

<script>
    $("#kontak_customer").on("input", function(){
        var regexp = /[^0-9]/g;
        if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
        }
    });

    $("#pic_customer").on("input", function(){
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
    var url_delete = "<?php echo base_url('admin/customer/hapus_foto'); ?>";
    var url_save = "<?php echo base_url('admin/customer/simpan_foto'); ?>";

    var foto_customer1 = new Dropzone("#my_drop",{ 
        url: url_save,
        maxFiles : 1,
        acceptedFiles : 'image/*',
        dictInvalidFileType:"Type file ini tidak dizinkan",
        dictMaxFilesExceeded: "Hanya dapat unggah satu gambar",
        dictRemoveFile: "Hapus",
        addRemoveLinks:true,
        init: function(){  
            var foto = $('#foto_customer').val();
            if(foto == null){
                this.on("success",function(file,response){
                    $('#foto_customer').val(response);
                }); 
            }else{
                this.on("success",function(file,response){
                    $('#foto_customer').val(response);
                    $.ajax({
                        url: url_delete,
                        type: "post",
                        data: {foto_customer:foto},
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
    foto_customer1.on("removedfile",function(){
        var foto_customer = $('#foto_customer').val();
        $.ajax({
            url: url_delete,
            type: "post",
            data: {foto_customer:foto_customer},
            cache: false,
            dataType: 'json',
            success: function(response){
                if(response == 1){
                    $("#foto_customer").val("");
                }
            }
        });
    });

     //Ngahapus gambar
     $('#hapus_gambar_customer').on("click",function(){
        var foto_customer = $('#foto_customer').val();
        $.ajax({
            url: url_delete,
            type: "post",
            data: {foto_customer:foto_customer},
            cache: false,
            dataType: 'json',
            success: function(response){
                if(response == 1){
                    $("#foto_customer").val("");
                    $("img#assets_customer").show(500); 
                    $("img#foto").hide(500); 
                    $("a#teks_customer").hide(500); 
                }
            }
        });
    });
</script>