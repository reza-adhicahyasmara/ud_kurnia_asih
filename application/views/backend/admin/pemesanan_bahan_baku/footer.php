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
    var url_outlet =  "<?php echo base_url('admin/pemesanan_bahan_baku'); ?>";
    var url = url_outlet ;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');

    $("#jumlah_ipemesanan_bb").on("input", function(){
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
        $('.kode_bb').select2({
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
    $(document).ready(function(){
        $("#id_supplier").change(function() {
            var id_supplier = $(this).val();
            $("#ongkir_supplier").val($('option:selected', this).attr('ongkir_supplier'));
            $("#berat_ongkir_supplier").val($('option:selected', this).attr('berat_ongkir_supplier'));

            $.ajax({
                url : '<?php echo base_url('admin/pemesanan_bahan_baku/select_bahan_baku_supplier'); ?>',
                method: 'POST',
                data: {id_supplier:id_supplier},
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].kode_bb+' harga_bb = '+data[i].harga_bb+' stok_gudang_sup_bb = '+data[i].stok_gudang_sup_bb+'>'+data[i].kode_bb+' - '+data[i].nama_bb+' ('+data[i].nama_satuan+')'+'</option>';
                        var harga_bb = data[0].harga_bb; //default nilai
                        var stok_gudang_sup_bb = data[0].stok_gudang_sup_bb; //default nilai
                    }
                    $('#kode_bb').html(html);
                    var number1 = new Number(harga_bb).toLocaleString("id-ID");
                    $('#harga_ipemesanan_bb_view').val(number1);
                    $("#harga_ipemesanan_bb").val(harga_bb);

                    var number2 = new Number(stok_gudang_sup_bb).toLocaleString("id-ID");
                    $('#stok_gudang_sup_bb_view').val(number2);
                    $("#stok_gudang_sup_bb").val(stok_gudang_sup_bb);
                }
            });     
        });    
    });

    $('.kode_bb').on('change', function() {
        var harga_bb = $('option:selected', this).attr('harga_bb');
        var number = new Number(harga_bb).toLocaleString("id-ID");
        $('#harga_ipemesanan_bb_view').val(number);
        $("#harga_ipemesanan_bb").val(harga_bb);

        var stok_gudang_sup_bb = $('option:selected', this).attr('stok_gudang_sup_bb');
        var number = new Number(stok_gudang_sup_bb).toLocaleString("id-ID");
        $('#stok_gudang_sup_bb_view').val(number);
        $("#stok_gudang_sup_bb").val(stok_gudang_sup_bb);
    });    


    load_data_item_bb();
	function load_data_item_bb(){
		$.ajax({
			method : "GET",
			url : '<?php echo base_url('admin/pemesanan_bahan_baku/load_data_item_bb'); ?>',
			beforeSend : function(){
				$('#content_item_pemesanan_bb').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
			},
			success : function(response){
				$('#content_item_pemesanan_bb').html(response);
			}
		});
    };

    function kosongkan_form(){  
        $("#kode_bb").val("");
        $("#harga_ipemesanan_bb").val("");
        $("#harga_ipemesanan_bb_view").val("");
        $("#stok_gudang_sup_bb").val("");
        $("#stok_gudang_sup_bb_view").val("");
        $("#jumlah_ipemesanan_bb").val("");
    }

    $(document).ready(function() {
        $('#btn_tambah_item_pemesanan_bb').on("click",function(){
            $.ajax({
                url : '<?php echo base_url('admin/pemesanan_bahan_baku/insert_item_pemesanan_bb'); ?>',
                method : 'POST',
                data: $('#form_item_pemesanan_bb').serialize(),
                success: function(response){
                    if(response==1){            
                        load_data_item_bb();
                        kosongkan_form();
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

    $('body').on('click', '.btn_hapus_item_pemesanan_bb', function(){
        var kode_ipemesanan_bb = $(this).attr('kode_ipemesanan_bb');
        $.ajax({
            url : '<?php echo base_url('admin/pemesanan_bahan_baku/delete_item_pemesanan_bb'); ?>',
            method : 'POST',
            data: {kode_ipemesanan_bb : kode_ipemesanan_bb},
            cache:false,
            success:function(hasil){
                load_data_item_bb();
            }
        })   
    }); 


    $(document).ready(function() {
        $('#btn_simpan_checkout').on("click",function(){
            var id_supplier = $('#id_supplier').val();
            var kode_rekening = $('#kode_rekening').val();
            var total_pby_pemesanan_bb = $('#total_pby_pemesanan_bb').val();
            $.ajax({
                url : '<?php echo base_url('admin/pemesanan_bahan_baku/insert_pemesanan_bb'); ?>',
                method: 'POST',
                data : {
                    id_supplier:id_supplier,
                    kode_rekening:kode_rekening,
                    total_pby_pemesanan_bb:total_pby_pemesanan_bb
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
                            window.location.replace(url_outlet);
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