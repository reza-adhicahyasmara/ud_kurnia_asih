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
    var url_bahan_baku_keluar =  "<?php echo base_url('gudang/bahan_baku_keluar'); ?>";
    var url = url_bahan_baku_keluar ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>


<script type="text/javascript">

    load_data_bahan_baku_keluar();
	function load_data_bahan_baku_keluar(){
		$.ajax({
			method : "GET",
			url : '<?php echo base_url('gudang/bahan_baku_keluar/load_data_bahan_baku_keluar'); ?>',
			beforeSend : function(){
				$('#content_data_bahan_baku_keluar').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_data_bahan_baku_keluar').html(response);
			}
		});
    };

    $('#btn_tambah_bahan_baku_keluar').on("click",function(){
        var url = "<?php echo base_url('gudang/bahan_baku_keluar/form_tambah_bahan_baku_keluar'); ?>";

        $('#modal_bahan_baku_keluar').modal('show');
        $('.modal-title').text('Tambah Produk Keluar');
        $('.modal-body').load(url);
    });

    $(document).ready(function() {
        $('#btn_simpan_bahan_baku_keluar').on("click",function(){
            $('#form_bahan_baku_keluar').validate({
                rules: {
                    kode_bb: {
                        required: true,
                    },
                    jumlah_bb_keluar: {
                        required: true,
                    },
                    tanggal_bb_keluar: {
                        required: true,
                    },
                },
                messages: {
                    kode_bb: {
                        required: "Produk harus diisi",
                    },
                    jumlah_bb_keluar: {
                        required: "Jumlah harus diisi",
                    },
                    tanggal_bb_keluar: {
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
                        url : '<?php echo base_url('gudang/bahan_baku_keluar/tambah_bahan_baku_keluar'); ?>',
                        method: 'POST',
                        data: $('#form_bahan_baku_keluar').serialize(),
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
                                    load_data_bahan_baku_keluar();
                                    $('#modal_bahan_baku_keluar').modal('hide');
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

    $(document).on('click', '.btn_hapus_bahan_baku_keluar', function(e) {
        var kode_bb_keluar=$(this).attr("kode_bb_keluar");
        var jumlah_bb_keluar=$(this).attr("jumlah_bb_keluar");
        var kode_bb=$(this).attr("kode_bb");
        var stok_gudang_pab_bb=$(this).attr("stok_gudang_pab_bb");
        var nama_bb=$(this).attr("nama_bb");
        
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
                        url: '<?php echo base_url('gudang/bahan_baku_keluar/hapus_bahan_baku_keluar'); ?>',
                        method: 'POST',
                        data: {
                            kode_bb_keluar:kode_bb_keluar,
                            jumlah_bb_keluar:jumlah_bb_keluar,
                            kode_bb:kode_bb,
                            stok_gudang_pab_bb:stok_gudang_pab_bb
                        },                
                    })
                    .done(function(response) {
                        load_data_bahan_baku_keluar();
                        Swal.fire({
                            title: 'Data Barhasil Dihapus',
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