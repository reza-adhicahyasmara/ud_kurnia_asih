<h4 class="mb-4"><?php echo $produk['nama_produk']." - ".$produk['kode_produk']?></h4>
<form role="form" id="form_resep" method="post">
    <input type="hidden" class="form-control" name="kode_produk" id="kode_produk" value="<?php echo $produk['kode_produk']; ?>" placeholder="Kg">
    <div class="row">
        <div class="col-7">
            <div class="form-group">
                <select class="form-control kode_bb" name="kode_bb" id="kode_bb">
                    <?php foreach($bahan_baku->result() as $row){ ?>
                    <option value="<?php echo $row->kode_bb; ?>"><?php echo $row->nama_bb; ?></option>
                    <?php } ?> 
                </select>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <input type="text" class="form-control" name="qty_resep" id="qty_resep" placeholder="Qty">
            </div>
        </div>
        <div class="col-2">      
            <div class="form-group">
                <button type="submit" id="btn_tambah_resep" class="btn bg-purple"><span class="bx bx-fw bx-plus"></span></button>
            </div>
        </div>
    </div>
</form>
<br>
<br>
<br>
<div id="content_resep">
    <!--LOAD DATA-->
</div>

<script type="text/javascript">
    load_data_resep();
	function load_data_resep(){
        var kode_produk = '<?php echo $produk['kode_produk'];?>';
		$.ajax({
			url : '<?php echo base_url('admin/produk/load_data_resep'); ?>',
			method : "POST",
            data : {kode_produk:kode_produk},
			beforeSend : function(){
				$('div#content_resep').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('div#content_resep').html(response);
			}
		});
    };
    
    $(document).ready(function() {
        $('button#btn_tambah_resep').on("click",function(){
            $('form#form_resep').validate({
                rules: {
                    qty_resep: {
                        required: true,
                    },
                },
                messages: {
                    qty_resep: {
                        required: "Harus diisi",
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
                        url : '<?php echo base_url('admin/produk/tambah_resep'); ?>',
                        method: 'POST',
                        data : $('form#form_resep').serialize(),
                        success: function(response){
                            if(response==1){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Data telah ditambahkan',
                                    showConfirmButton: true,
                                    confirmButtonColor: '#6f42c1',
                                    timer: 3000
                                }).then(function(){
                                    load_data_resep();
                                    $('input#qty_resep').val('');
                                });
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

    $(document).on('click', 'a.btn_hapus_resep', function(e) {
        var kode_resep = $(this).attr("kode_resep");
        var nama_bb = $(this).attr("nama_bb");
        
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Akan menghapus data"' + nama_bb + '"!',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6f42c1',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: "Tidak, batalkan",
            showLoaderOnConfirm: true,
            customClass: 'animated tada',
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                        url: '<?php echo base_url('admin/produk/hapus_resep'); ?>',
                        method: 'POST',
                        data: {kode_resep : kode_resep},                
                    })
                    .done(function(response) {
                        load_data_resep();
                        Swal.fire({
                            title: 'Data Berhasil Dihapus',
                            icon: 'success',
                            showConfirmButton: true,
                            confirmButtonColor: '#6f42c1',
                        })
                    })
                    .fail(function() {
                        Swal.fire({
                            title: 'Terjadi Kesalahan',
                            icon: 'error',
                            showConfirmButton: true,
                            confirmButtonColor: '#6f42c1',
                        })
                    });
                });
            },
        });
    });  
</script>