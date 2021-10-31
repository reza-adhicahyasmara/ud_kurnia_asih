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
    var url_customer =  "<?php echo base_url('customer/pemesanan_produk'); ?>";
    var url = url_customer ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');

    $("#jumlah_ipemesanan_produk").on("input", function(){
        var regexp = /[^0-9]/g;
        if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
        }
    });

    $("#kontak_outlet").on("input", function(){
        var regexp = /[^0-9]/g;
        if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
        }
    });

    $("#pic_outlet").on("input", function(){
        var regexp = /[^a-z A-Z]/g;
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

<!-----------------------PENGAJUAN PRODUK----------------------->
<script type="text/javascript">
   load_data_item_produk();
	function load_data_item_produk(){
		$.ajax({
			method : "GET",
			url : '<?php echo base_url('customer/pemesanan_produk/load_data_item_produk'); ?>',
			beforeSend : function(){
				$('#content_item_pemesanan_produk').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_item_pemesanan_produk').html(response);
			}
		});
    };

    $(document).on('click', '.btn_keranjang', function() {
        var kode_produk = $(this).attr("kode_produk");
        var url = "<?php echo base_url('customer/pemesanan_produk/form_tambah'); ?>";

        $('#modal_item_pemesanan_produk').modal('show');
        $('.modal-title').text('Tambah Daftar Pemesanan');
        $('.isi_item').load(url,{kode_produk : kode_produk});
    }); 

    $(document).ready(function() {
        $('#btn_tambah_item_pemesanan_produk').on("click",function(){
            $.ajax({
                url : '<?php echo base_url('customer/pemesanan_produk/insert_item_pemesanan_produk'); ?>',
                method : 'POST',
                data: $('#form_item_pemesanan_produk').serialize(),
                success: function(response){
                    if(response==1){            
                        load_data_item_produk();
                        $('#modal_item_pemesanan_produk').modal('hide');
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
            })
        })
    })

    $('body').on('click', '.btn_hapus_item_pemesanan_produk', function(){
        var kode_ipemesanan_produk = $(this).attr('kode_ipemesanan_produk');
        $.ajax({
            url : '<?php echo base_url('customer/pemesanan_produk/delete_item_pemesanan_produk'); ?>',
            method : 'POST',
            data: {kode_ipemesanan_produk : kode_ipemesanan_produk},
            cache:false,
            success:function(hasil){
                load_data_item_produk();
            }
        })   
    }); 
    
    $(document).ready(function() {
        $('#btn_simpan_checkout').on("click",function(){
            var kode_rekening = $('#kode_rekening').val();
            var total_pby_pemesanan_produk = $('#total_pby_pemesanan_produk').val();
            $.ajax({
                url : '<?php echo base_url('customer/pemesanan_produk/insert_pemesanan_produk'); ?>',
                method: 'POST',
                data : {
                    kode_rekening:kode_rekening,
                    total_pby_pemesanan_produk:total_pby_pemesanan_produk
                },
                success: function(response){
                    if(response==1){
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data telah diupdate',
                            showConfirmButton: true,
                            confirmButtonColor: '#6f42c1',
                            timer: 3000
                        }).then(function(){
                            window.location.replace(url_customer);
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
        });
    });

</script>

</body>
</html>