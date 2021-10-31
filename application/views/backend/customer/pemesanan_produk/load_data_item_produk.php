<table style="width:100%;" id="tbl_item_toko" class="table table-bordered table-striped">
<caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; width:15%">Nama</th>
            <th id="" style="text-align: center; vertical-align: middle; width:15%">Harga</th>
            <th id="" style="text-align: center; vertical-align: middle; width:10%">Jumlah</th>
            <th id="" style="text-align: center; vertical-align: middle; width:20%">Subtotal</th>
            <th id="" style="text-align: center; vertical-align: middle; width:7%">Aksi</th>
        </tr>
    </thead>
    <?php
        $total_harga_ipemesanan_produk = 0;
        $total_berat = 0;
        $no = 1;
        foreach($tmp->result() as $tmp){
            if($tmp->status_ipemesanan_produk == 1){
    ?>
    <tr>
        <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
        <td style="text-align: left; vertical-align: middle;"><?php echo $tmp->nama_produk;?></td>
        <td style="text-align: center; vertical-align: middle;"><?php echo number_format($tmp->harga_ipemesanan_produk, 2, ",", ".")."/".$tmp->nama_satuan;?></td>
        <td style="text-align: center; vertical-align: middle;"><?php echo number_format($tmp->jumlah_ipemesanan_produk, 0, ".", ".")." ".$tmp->nama_satuan;?></td>
        <td style="text-align: right; vertical-align: middle;"><?php echo number_format($tmp->subtotal_ipemesanan_produk, 2, ",", ".");?></td>
        <td style="text-align: center; vertical-align: middle;">
            <a class='btn btn-danger btn-sm btn-rounded btn_hapus_item_pemesanan_produk' kode_ipemesanan_produk="<?php echo $tmp->kode_ipemesanan_produk; ?>"><i class="bx bx-fw bx-trash"></i></a>
        </td>
    </tr>
    <?php
                $total_harga_ipemesanan_produk += $tmp->subtotal_ipemesanan_produk;
                $total_berat += $tmp->jumlah_ipemesanan_produk;
                $no++;
            }
        }
    ?>
    <tr>
        <td colspan="4"><b style="text-align: right;">Total</b></td>
        <td colspan="1">
            <input type="text" style="text-align: right;" readonly="readonly" value="<?php echo number_format($total_harga_ipemesanan_produk, 2, ",", "."); ?>" class="form-control">
            <input type="hidden" style="text-align: right;" id="total_belanja" readonly="readonly" value="<?php echo $total_harga_ipemesanan_produk; ?>" class="form-control">
            <input type="hidden" style="text-align: right;" id="total_berat" readonly="readonly" value="<?php echo $total_berat; ?>" class="form-control">
        </td>
        <td></td>
    </tr>
</table>

<?php if($total_harga_ipemesanan_produk != 0){?>
    <div class="panel-footer" alignment="right"><button id="btn_checkout" class="btn bg-purple"><i class="bx bx-fw bx-check"></i> Ajukan</button></div>
<?php } ?>

<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script>
    $(document).on('click', '#btn_checkout', function() {
        var url = "<?php echo base_url('customer/pemesanan_produk/form_checkout'); ?>";
        var total_belanja = $('#total_belanja').val();
        var total_berat = $('#total_berat').val();

        $('#modal_pemesanan').modal('show');
        $('.modal-title').text('Checkout Pemesanan');
        $('.isi_checkout').load(url,{total_belanja:total_belanja, total_berat:total_berat});
    }); 
</script>