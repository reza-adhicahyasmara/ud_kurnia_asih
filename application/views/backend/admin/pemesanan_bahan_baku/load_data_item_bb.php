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
        $total_harga_ipemesanan_bb = 0;
        $total_berat = 0;
        $no = 1;
        foreach($tmp->result() as $tmp){
            if($tmp->status_ipemesanan_bb == 1){
    ?>
    <tr>
        <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
        <td style="text-align: left; vertical-align: middle;"><?php echo $tmp->nama_bb;?></td>
        <td style="text-align: center; vertical-align: middle;"><?php echo number_format($tmp->harga_ipemesanan_bb, 2, ",", ".")."/".$tmp->nama_satuan;?></td>
        <td style="text-align: center; vertical-align: middle;"><?php echo number_format($tmp->jumlah_ipemesanan_bb, 0, ".", ".")." ".$tmp->nama_satuan;?></td>
        <td style="text-align: right; vertical-align: middle;"><?php echo number_format($tmp->subtotal_ipemesanan_bb, 2, ",", ".");?></td>
        <td style="text-align: center; vertical-align: middle;">
            <a class='btn btn-danger btn-sm btn-rounded btn_hapus_item_pemesanan_bb' kode_ipemesanan_bb="<?php echo $tmp->kode_ipemesanan_bb; ?>"><i class="bx bx-fw bx-trash"></i></a>
        </td>
    </tr>
    <?php
                $total_harga_ipemesanan_bb += $tmp->subtotal_ipemesanan_bb;
                $total_berat += $tmp->jumlah_ipemesanan_bb;
                $no++;
            }
        }
    ?>
    <tr>
        <td colspan="4"><b style="text-align: right;">Total</b></td>
        <td colspan="1">
            <input type="text" style="text-align: right;" readonly="readonly" value="<?php echo number_format($total_harga_ipemesanan_bb, 2, ",", "."); ?>" class="form-control">
            <input type="hidden" style="text-align: right;" id="total_belanja" readonly="readonly" value="<?php echo $total_harga_ipemesanan_bb; ?>" class="form-control">
            <input type="hidden" style="text-align: right;" id="total_berat" readonly="readonly" value="<?php echo $total_berat; ?>" class="form-control">
        </td>
        <td></td>
    </tr>
</table>

<?php if($total_harga_ipemesanan_bb != 0){?>
<div class="panel-footer" alignment="right"><button id="btn_checkout" class="btn bg-purple"><i class="bx bx-fw bx-check"></i> Ajukan</button></div>
<?php } ?>

<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script>

    $('button#btn_checkout').on("click",function(){
        var id_supplier = $('#id_supplier').val();
        var ongkir_supplier = $('#ongkir_supplier').val();
        var berat_ongkir_supplier = $('#berat_ongkir_supplier').val();
        var total_belanja = $('#total_belanja').val();
        var total_berat = $('#total_berat').val();
        
        var ongkir = parseFloat(total_berat) / parseFloat(berat_ongkir_supplier);
        var jumlah_ongkir =  Math.ceil(parseFloat(ongkir)) * parseFloat(ongkir_supplier);
        var total_pembayaran = parseFloat(jumlah_ongkir) + parseFloat(total_belanja);
        $('span#total_belanja').text(new Number(total_belanja).toLocaleString("id-ID"));
        $('span#jumlah_ongkir').text(new Number(jumlah_ongkir).toLocaleString("id-ID"));
        $('span#total_pembayaran').text(new Number(total_pembayaran).toLocaleString("id-ID"));
        $('#total_pby_pemesanan_bb').val(total_pembayaran);

        if(id_supplier == ""){
            Swal.fire({
                icon: 'error',
                title: 'Supplier Kosong',
                showConfirmButton: true,
                timer: 3000
            })
        }else{
            $.ajax({
                url : '<?php echo base_url('admin/pemesanan_bahan_baku/select_rekening_bank'); ?>',
                method: 'POST',
                data: {id_supplier:id_supplier},
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].kode_rekening+'>'+data[i].no_rekening+' AN '+data[i].an_rekening+' ('+data[i].nama_bank+')'+'</option>';
                    }
                    $('#kode_rekening').html(html);
                }
            });     

            $('#modal_pemesanan').modal('show');
            $('.modal-title').text('Pengajuan Pembelian');
        }
    });
</script>