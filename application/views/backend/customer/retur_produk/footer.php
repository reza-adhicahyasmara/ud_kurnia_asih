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
<!-- page script -->

<!-----------------------FUNGSI----------------------->
<script type="text/javascript">
    var url_outlet =  "<?php echo base_url('customer/retur_produk'); ?>";
    var url = url_outlet ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');

    $("#jumlah_iretur_produk").on("input", function(){
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
        $('.kode_produk').select2({
            theme: 'bootstrap4',
        })
    });

    $(function () {
        $("#dataTable1").DataTable({
        "responsive": true,
        "autoWidth": true,
        });
    });

    $(function () {
        $("#dataTable2").DataTable({
        "responsive": true,
        "autoWidth": true,
        });
    });

    $(function () {
        $("#dataTable3").DataTable({
        "scrollX": false,
        "autoWidth": true,
        });
    });

    $(function () {
        $("#dataTable4").DataTable({
        "scrollX": false,
        "autoWidth": true,
        });
    });

    $(function () {
        $("#dataTable5").DataTable({
        "scrollX": false,
        "autoWidth": true,
        });
    });

    $(function () {
        $("#dataTable6").DataTable({
        "scrollX": false,
        "autoWidth": true,
        });
    });

    $(function () {
        $("#dataTable7").DataTable({
        "scrollX": false,
        "autoWidth": true,
        });
    });

    $(function () {
        $("#dataTable8").DataTable({
        "scrollX": false,
        "autoWidth": true,
        });
    });

    $(function () {
        $("#dataTable9").DataTable({
        "scrollX": false,
        "autoWidth": true,
        });
    });
</script>


<!-----------------------PENGAJUAN RETUR----------------------->
<script type="text/javascript">

    load_data_item_retur_produk();
	function load_data_item_retur_produk(){
		$.ajax({
			method : "GET",
			url : '<?php echo base_url('customer/retur_produk/load_data_item_retur_produk'); ?>',
			beforeSend : function(){
				$('#content_item_retur_produk').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_item_retur_produk').html(response);
			}
		});
    };
    

    $(document).on('click', '.btn_retur', function() {
        var kode_produk = $(this).attr("kode_produk");
        var url = "<?php echo base_url('customer/retur_produk/form_tambah'); ?>";

        $('#modal_item_retur_produk').modal('show');
        $('.modal-title').text('Tambah Daftar Retur');
        $('.isi_item').load(url,{kode_produk : kode_produk});
    }); 

    $(document).ready(function() {
        $('#btn_tambah_item_retur_produk').on("click",function(){
            $('#form_item_retur_produk').validate({
                rules: {
                    jumlah_iretur_produk: {
                        required: true,
                    },
                    gambar_iretur_produk: {
                        required: true,
                    },
                    keterangan_iretur_produk: {
                        required: true,
                    },
                },
                messages: {
                    jumlah_iretur_produk: {
                        required: "Jumlah harus diisi",
                    },
                    gambar_iretur_produk: {
                        required: "Gambar harus diisi",
                    },
                    keterangan_iretur_produk: {
                        required: "Keterangan harus diisi",
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
                        url : '<?php echo base_url('customer/retur_produk/insert_item_retur_produk'); ?>',
                        method: 'POST',
                        data: $('#form_item_retur_produk').serialize(),
                        success: function(response){
                            if(response==1){
                                load_data_item_retur_produk();
                                $('#modal_item_retur_produk').modal('hide');
                            }else{
                                Swal.fire({
                                    icon: 'warning',
                                    text: response,
                                    showConfirmButton: true,
                                    confirmButtonColor: '#6f42c1',
                                    timer: 3000
                                })
                            }
                        }
                    }); 
                }
            })
        })
    })

    $('body').on('click', '.btn_hapus_item_retur_produk', function(){
        var kode_iretur_produk = $(this).attr('kode_iretur_produk');
        var gambar_iretur_produk = $(this).attr('gambar_iretur_produk');
        var kode_produk = $(this).attr('kode_produk');
        var jumlah_iretur_produk = $(this).attr('jumlah_iretur_produk');

        $.ajax({
            url : '<?php echo base_url('customer/retur_produk/delete_item_retur_produk'); ?>', 
            method : 'POST',
            data: {
                kode_iretur_produk:kode_iretur_produk,
                gambar_iretur_produk:gambar_iretur_produk,
                kode_produk:kode_produk,
                jumlah_iretur_produk:jumlah_iretur_produk
            },
            cache:false,
            success:function(hasil){
                load_data_item_retur_produk();
            }
        })   
    }); 

</script>


<!-----------------------RETUR DITERIMA----------------------->
<script>
    $(document).on('click', '#btn_retur_diterima', function(e) {
        var kode_retur_produk = $(this).attr("kode_retur_produk");
        var status_retur_produk = 3;

        Swal.fire({
            title: 'Verifikasi Pengajuan Retur',
            text: 'Pastikan bahan baku diperiksa dengan benar',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6f42c1',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Ya, simpan',
            cancelButtonText: "Tidak, batalkan",
            showLoaderOnConfirm: true,

            preConfirm: (response) => {       
                $.ajax({
                    url: '<?php echo base_url('customer/retur_produk/update_retur_produk');?>',
                    method: 'POST',
                    data: {
                        kode_retur_produk:kode_retur_produk,
                        status_retur_produk:status_retur_produk,
                    },   
                    success: function(response){ 
                        if(response==1){
                            Swal.fire({
                                icon: 'success',
                                title: 'Data telah diupdate!',
                                showConfirmButton: true,
                                confirmButtonColor: '#6f42c1',
                                timer: 3000
                            }).then(function(){
                                window.location.reload();
                            })
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: response,
                                showConfirmButton: true,
                                confirmButtonColor: '#6f42c1',
                                timer: 3000
                            })
                        }    
                    }
                })
            },
        });
    });
</script>

</body>
</html>