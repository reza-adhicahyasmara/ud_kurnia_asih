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


<!-- perencanaan script -->
<script type="text/javascript">

    $(document).ready(function() {
        $('#btn_cari').on("click",function(){
            $("#quickForm").valid();
        });

        $('#quickForm').validate({
            rules: {
                tanggal_awal: {
                    required: true,
                },
                tanggal_akhir: {
                    required: true,
                },
            },
            messages: {
                tanggal_awal: {
                    required: "Tanggal awal harus diisi",
                },
                tanggal_akhir: {
                    required: "Tanggal akhir harus diisi",
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
                var tanggal_awal = $('#tanggal_awal').val();
                var tanggal_akhir = $('#tanggal_akhir').val();


                $.ajax({
                    url : "<?php echo base_url('pimpinan/laporan_produk/laporan_data_masuk'); ?>",
                    method: 'POST',
                    data: {
                        tanggal_awal:tanggal_awal,
                        tanggal_akhir:tanggal_akhir
                    },
                    beforeSend : function(){
				        $('#content_laporan').html('<div style="text-align:center"><i class="fa fa-refresh fa-3x fa-spin" style="margin-top: 30px; margin-bottom: 30px;" aria-hidden="true"></i></div>');
                    },
                    success : function(response){
                        $('#content_laporan').html(response);
                    }
                });  
            }
        });
    });
</script>

<!--fungsi-->
<script type="text/javascript">

    var url = window.location;
    $('ul.nav-sidebar a').filter(function() {
        return this.href == url;
    }).addClass('active ');
    $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
    
    $(document).ready(function(){   
        $('#tanggal_awal').datetimepicker({
            //inline:true,
            autoclose: true,
            timepicker:false,
            format:'Y-m-d'
        });
    });
    $(document).ready(function(){   
        $('#tanggal_akhir').datetimepicker({
            //inline:true,
            autoclose: true,
            timepicker:false,
            format:'Y-m-d'
        });
    });

</script>

</body>
</html>