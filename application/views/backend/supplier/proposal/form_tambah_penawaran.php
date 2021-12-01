<input type="hidden" id="jenis" value="Tambah">
<span id="alert"></span>
<h4>Data Proposal</h4>
<div class="form-group mb-3">
    <label>Judul</label>
    <input type="text" class="form-control" name="judul_proposal" id="judul_proposal" placeholder="Judul">
</div>
<div class="form-group">
    <label>Unggah Proposal Penawaran (.pdf)</label> 
    <div class="row">   
        <div class="form-group col-md-9 col-sm-9 col-9">                           
            <input type="text" class="form-control" name="berkas_proposal" id="berkas_proposal" placeholder=".pdf" style="background-color : #ffffff;" readonly/>    
        </div>
        <div class="form-group col-md-3 col-sm-3 col-3">  
            <input type="text" class="form-control btn btn-outline-primary" id="btn_berkas_proposal" placeholder="Pilih" readonly/>
        </div>
    </div>
</div>
<hr>
<h4>Daftar Bahan Baku</h4>
<form role="form" id="form_bahan_baku" method="post">
    <input type="hidden" id="jenis" value="Tambah">
    <div class="form-group">
        <label>Kode Bahan Baku</label>
        <input type="text" class="form-control" name="kode_bb_baru" id="kode_bb_baru" placeholder="Kode">
    </div>
    <div class="form-group">
        <label>Nama Bahan Baku</label>
        <input type="text" class="form-control" name="nama_bb_baru" id="nama_bb_baru" placeholder="Nama / Merek Bahan Baku">
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
        <label>Harga (Rp)</label>
        <input type="text" class="form-control" name="harga_bb" id="harga_bb" placeholder="Harga jual supplier">
    </div>
    <div class="form-group">
        <label>Stok Limit</label>
        <input type="text" class="form-control" name="stok_limit_pab_bb" id="stok_limit_pab_bb" placeholder="Batas jumlah limit untuk menjaga stok gudang">
    </div>
    <div class="form-group">
        <button type="submit" id="btn_simpan_bahan_baku" class="btn bg-purple"><span class="bx bx-fw bx-save"></span> Tambah Daftar</button>
    </div>
</form>
<div id="content_bahan_baku">
    <!--LOAD DATA-->
</div>
<small class="text-secondary">*Pastikan data di atas diisi dengan benar</small>


<script>
    $("#stok_limit_pab_bb").on("input", function(){
        var regexp = /[^0-9]/g;
        if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
        }
    });

    $("#harga_bb").on("input", function(){
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
    
    var berkas_proposal = new Dropzone("input#btn_berkas_proposal",{ 
        url: "<?php echo base_url('supplier/proposal/save_pdf'); ?>",
        maxFiles : 1,
        acceptedFiles : '.pdf',
        dictRemoveFile: "Hapus",
        addRemoveLinks:true,
        init: function(){   
            this.on("success",function(file,response){
                $('#berkas_proposal').val(response);
            }); 
        }
    });

</script>

<!-----------------------PENAWARAN----------------------->
<Script type="text/javascript">
    load_data_bahan_baku();
	function load_data_bahan_baku(){
		$.ajax({
			method : "GET",
			url : '<?php echo base_url('supplier/proposal/load_data_bahan_baku'); ?>',
			beforeSend : function(){
				$('#content_bahan_baku').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_bahan_baku').html(response);
			}
		});
    };

    $(document).ready(function() {
        $('#btn_simpan_bahan_baku').on("click",function(){
            $('#form_bahan_baku').validate({
                rules: {
                    kode_bb_baru: {
                        required: true,
                    },
                    nama_bb_baru: {
                        required: true,
                    },
                    harga_bb: {
                        required: true,
                        minlength: 5,
                    },
                    kode_kategori: {
                        required: true,
                    },
                    kode_satuan: {
                        required: true,
                    },
                    stok_limit_pab_bb: {
                        required: true,
                    },
                },
                messages: {
                    kode_bb_baru: {
                        required: "Kode harus diisi",
                    },
                    nama_bb_baru: {
                        required: "Bahan baku harus diisi",
                    },
                    harga_bb: {
                        required: "Harga harus diisi",
                        minlength: "Minimal 5 digit",
                    },
                    kode_kategori: {
                        required: "Kategori harus diisi",
                    },
                    kode_satuan: {
                        required: "Satuan harus diisi",
                    },
                    stok_limit_pab_bb: {
                        required: "Stok limit harus diisi",
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function() {
                    $.ajax({
                        url : '<?php echo base_url('supplier/proposal/tambah_bahan_baku'); ?>',
                        method: 'POST',
                        data : $('#form_bahan_baku').serialize(),
                        success: function(response){
                            if(response==1){
                                load_data_bahan_baku();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: response,
                                    showConfirmButton: true,
                                    confirmButtonColor: '#6f42c1',
                                    timer: 3000
                                })
                            }
                        }
                    }); 
                }
            });
        });
    });

    $(document).on('click', '.btn_hapus_bahan_baku', function(e) {
        var kode_bb = $(this).attr("kode_bb");

        $.ajax({
            url: '<?php echo base_url('supplier/proposal/hapus_bahan_baku'); ?>',
            method: 'POST',
            data: {kode_bb : kode_bb},  
            success: function(response){
                load_data_bahan_baku();
            }          
        })
    });  
</Script>