<aside class="control-sidebar control-sidebar-dark"></aside>
</div>

<!-----------------------VENDOR JS FILES----------------------->
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>

<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-4/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.bundle.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datetimepicker/build/jquery.datetimepicker.full.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/dropzone/dropzone.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/select2/js/select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/sparklines/sparkline.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>

<script src="<?php echo base_url(); ?>assets/dist/backend/js/adminlte.js"></script>

<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
    var url_produk_masuk =  "<?php echo base_url('gudang/produk_masuk'); ?>";
    var url = url_produk_masuk ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>


<script type="text/javascript">

    load_data_produk_masuk();
	function load_data_produk_masuk(){
		$.ajax({
			method : "GET",
			url : '<?php echo base_url('gudang/produk_masuk/load_data_produk_masuk'); ?>',
			beforeSend : function(){
				$('#content_data_produk_masuk').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_data_produk_masuk').html(response);
			}
		});
    };

    $('#btn_tambah_produk_masuk').on("click",function(){
        var url = "<?php echo base_url('gudang/produk_masuk/form_tambah_produk_masuk'); ?>";

        $('#modal_produk_masuk').modal('show');
        $('.modal-title').text('Produksi Barang');
        $('.modal-body').load(url);
    });

    $(document).ready(function() {
        $('#btn_simpan_produk_masuk').on("click",function(){
            $('#form_produk_masuk').validate({
                rules: {
                    kode_produk: {
                        required: true,
                    },
                    jumlah_produk_masuk: {
                        required: true,
                    },
                    tanggal_produk_masuk: {
                        required: true,
                    },
                },
                messages: {
                    kode_produk: {
                        required: "Produk harus diisi",
                    },
                    jumlah_produk_masuk: {
                        required: "Jumlah harus diisi",
                    },
                    tanggal_produk_masuk: {
                        required: "Tanggal harus diisi",
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
                        url : '<?php echo base_url('gudang/produk_masuk/tambah_produk_masuk'); ?>',
                        method: 'POST',
                        data: $('#form_produk_masuk').serialize(),
                        success: function(response){
                            if(response==1){
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: 'Ada stok di gudang yang kurang, cek lagi',
                                    showConfirmButton: true,
                                    confirmButtonColor: '#6f42c1',
                                    timer: 3000
                                })
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Data telah ditambahkan',
                                    showConfirmButton: true,
                                    confirmButtonColor: '#6f42c1',
                                    timer: 3000
                                }).then(function(){
                                    load_data_produk_masuk();
                                    $('#modal_produk_masuk').modal('hide');
                                });
                            }
                        }
                    }); 
                }
            });
        });
    });

    $(document).on('click', '.btn_hapus_produk_masuk', function(e) {
        var kode_produk_masuk=$(this).attr("kode_produk_masuk");
        var jumlah_produk_masuk=$(this).attr("jumlah_produk_masuk");
        var kode_produk=$(this).attr("kode_produk");
        var stok_gudang_produk=$(this).attr("stok_gudang_produk");
        var nama_produk=$(this).attr("nama_produk");
        
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Akan menghapus data"' + nama_produk + '"!',
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
                        url: '<?php echo base_url('gudang/produk_masuk/hapus_produk_masuk'); ?>',
                        method: 'POST',
                        data: {
                            kode_produk_masuk:kode_produk_masuk,
                            jumlah_produk_masuk:jumlah_produk_masuk,
                            kode_produk:kode_produk,
                            stok_gudang_produk:stok_gudang_produk
                        },                
                    })
                    .done(function(response) {
                        load_data_produk_masuk();
                        $('#modal_produk_masuk').modal('hide');
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

</body>
</html>