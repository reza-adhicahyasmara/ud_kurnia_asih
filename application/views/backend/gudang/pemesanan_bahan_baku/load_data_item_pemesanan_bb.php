<table style="width:100%" id="dataTable11" class="table table-bordered table-striped">
    <caption>
        Keterangan
        <ul>
            <li>Pastikan item yang diterima dalam kondisi baik.</li>
            <li>Apabila item dalam kondisi yang buruk maka dapat dibuatkan retur.</li>
            <li>Item yang diretur diserahkan langsung kepada pihak supplier pada saat pengiriman barang.</li>
            <li>Petugas akan langsung mengkroscek item dan membawa kembali item yang diretur.</li>
            <li>Status pemesanan dan stok item masuk akan pending jika ada retur item.</li>
        </ul>
    </caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; width:10%">Tanggal Kadaluwarsa</th>
            <th id="" style="text-align: center; vertical-align: middle; width:15%">Kode</th>
            <th id="" style="text-align: center; vertical-align: middle; width:15%">Bahan Baku</th>
            <th id="" style="text-align: center; vertical-align: middle; width:10%">Harga (Rp.)</th>
            <th id="" style="text-align: center; vertical-align: middle; width:10%">Jumlah</th>
            <th id="" style="text-align: center; vertical-align: middle; width:10%">Subtotal (Rp.)</th>
            <th id="" style="text-align: center; vertical-align: middle; width:20%">Status Item</th>
            <?php if($status_pemesanan_bb == 4){ ?>
                <th id="" style="text-align: center; vertical-align: middle; width:10%">Kondisi Porduk</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            $subtotal_ipemesanan_bb = 0;
            foreach($list_bahan_baku->result() as $row) {
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td style="text-align: left; vertical-align: middle;">
                <?php 
                    $tanggal_kadaluwarsa = $row->tanggal_kadaluwarsa_ipemesanan_bb;
                    if($tanggal_kadaluwarsa == ""){
                        echo "-";
                    }else{
                        echo $tanggal_kadaluwarsa;
                    }
                ?>
            </td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_bb;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_bb;?></td>
            <td style="text-align: center; vertical-align: middle;"><?php echo number_format($row->harga_ipemesanan_bb, 2, ",", ".")."/".$row->nama_satuan;?></td>
            <td style="text-align: center; vertical-align: middle;"><?php echo number_format($row->jumlah_ipemesanan_bb, 0, ".", ".")." ".$row->nama_satuan;?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($subtotal_ipemesanan_bb += $row->subtotal_ipemesanan_bb, 2, ",", ".");?></td>
            <td style="text-align: left; vertical-align: middle;">
                <?php 
                    $status_ipemesanan_bb = $row->status_ipemesanan_bb;
                    if($status_ipemesanan_bb == 2 || $status_ipemesanan_bb == 3){
                        echo "Proses";
                        if($row->jumlah_retur_ipemesanan_bb != ""){
                            echo "<br>Retur<br>Jumlah : ".$row->jumlah_retur_ipemesanan_bb."<br>Ket : ".$row->keterangan_retur_ipemesanan_bb;
                        }
                    }elseif($status_ipemesanan_bb == 3){
                        echo "Dikirim";
                    }elseif($status_ipemesanan_bb == 4){
                        echo "Baik";
                    }elseif($status_ipemesanan_bb == 5){
                        echo "Retur<br>Jumlah : ".$row->jumlah_retur_ipemesanan_bb."<br>Ket : ".$row->keterangan_retur_ipemesanan_bb;
                    }elseif($status_ipemesanan_bb == 6){
                        echo "Selesai";
                    }
                ?>
            </td>
            <?php if($status_pemesanan_bb == 4){ ?>
                <td style="text-align: center; vertical-align: middle;">
                    <a class='btn btn-success btn-sm btn-rounded btn_edit_item_bb_terima' kode_ipemesanan_bb="<?php echo $row->kode_ipemesanan_bb; ?>" jumlah_ipemesanan_bb="<?php echo $row->jumlah_ipemesanan_bb; ?>"><span class="bx bx-fw bx-check"></span></a>
                    <a class='btn btn-danger btn-sm btn-rounded btn_edit_item_bb_retur' kode_ipemesanan_bb="<?php echo $row->kode_ipemesanan_bb; ?>" jumlah_ipemesanan_bb="<?php echo $row->jumlah_ipemesanan_bb; ?>"><span class="bx bx-fw bx-x"></span></a>
                </td>
            <?php } ?> 
        </tr>
            <?php $no++; } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6" style="text-align: right; vertical-align: middle;">Ongkos Kirim</td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($total_pby_pemesanan_bb - $subtotal_ipemesanan_bb, 2, ",", "."); ?></td>
        </tr>
        <tr>
            <td colspan="6" style="text-align: right; vertical-align: middle;">Total</td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($total_pby_pemesanan_bb, 2, ",", "."); ?></td>
        </tr>
    </tfoot>
</table>


<script src="<?php echo base_url(); ?>assets/plugins/datetimepicker/build/jquery.datetimepicker.full.js"></script>
<script>
    $('.btn_edit_item_bb_terima').on("click",function(){
        var kode_ipemesanan_bb = $(this).attr("kode_ipemesanan_bb");
        var jumlah_ipemesanan_bb = "";
        var jumlah_retur_ipemesanan_bb = "";
        var keterangan_retur_ipemesanan_bb = "";
        var status_ipemesanan_bb = "4";

        Swal.fire({
            title: 'Kondisi Item Baik',
            text: 'Pastikan item diterima dengan kondisi baik',
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
                    url: '<?php echo base_url('gudang/pemesanan_bahan_baku/update_status_item_bb'); ?>',
                    method: 'POST',
                    data: {
                        kode_ipemesanan_bb:kode_ipemesanan_bb,
                        jumlah_ipemesanan_bb:jumlah_ipemesanan_bb,
                        jumlah_retur_ipemesanan_bb:jumlah_retur_ipemesanan_bb,
                        keterangan_retur_ipemesanan_bb:keterangan_retur_ipemesanan_bb,
                        status_ipemesanan_bb:status_ipemesanan_bb
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
                                load_data_item_pemesanan_bb();
                            })
                        }else{
                            Swal.fire({
                                icon: 'warning',
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

    $('.btn_edit_item_bb_retur').on("click",function(){
        var kode_ipemesanan_bb = $(this).attr("kode_ipemesanan_bb");
        var jumlah_ipemesanan_bb = $(this).attr("jumlah_ipemesanan_bb");
        var status_ipemesanan_bb = "5";

        Swal.fire({
            title: 'Kondisi Item Rusak',
            text: 'Buat laporan untuk menindaklanjuti item rusak',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6f42c1',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Ya, simpan',
            cancelButtonText: "Tidak, batalkan",
            showLoaderOnConfirm: true,
            onOpen: function() {
                $("#jumlah_retur_ipemesanan_bb").on("input", function(){
                    var regexp = /[^0-9]/g;
                    if($(this).val().match(regexp)){
                        $(this).val( $(this).val().replace(regexp,'') );
                    }
                });
            },
            html:
                '<input type="text" id="jumlah_retur_ipemesanan_bb" class="swal2-input" placeholder="Jumlah Retur">'+
                '<textarea id="keterangan_retur_ipemesanan_bb" class="swal2-input" placeholder="Keterangan Retur" style="height: 200px"></textarea>',

            preConfirm: (response) => {                 
                const jumlah_retur_ipemesanan_bb = Swal.getPopup().querySelector('#jumlah_retur_ipemesanan_bb').value;
                const keterangan_retur_ipemesanan_bb = Swal.getPopup().querySelector('#keterangan_retur_ipemesanan_bb').value;
                
                if (!jumlah_retur_ipemesanan_bb) {
                    Swal.showValidationMessage('Jumlah harus diisi');
                }else if (!keterangan_retur_ipemesanan_bb) {
                    Swal.showValidationMessage('Keterangan harus diisi');
                }else{
                    $.ajax({
                        url: '<?php echo base_url('gudang/pemesanan_bahan_baku/update_status_item_bb'); ?>',
                        method: 'POST',
                        data: {
                            kode_ipemesanan_bb:kode_ipemesanan_bb,
                            jumlah_ipemesanan_bb:jumlah_ipemesanan_bb,
                            jumlah_retur_ipemesanan_bb:jumlah_retur_ipemesanan_bb,
                            keterangan_retur_ipemesanan_bb:keterangan_retur_ipemesanan_bb,
                            status_ipemesanan_bb:status_ipemesanan_bb
                        },   
                        success: function(response){
                            if(response==1){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Data telah diupdate',
                                    confirmButtonColor: '#6f42c1',
                                    showConfirmButton: true,
                                    timer: 3000
                                }).then(function(){
                                    load_data_item_pemesanan_bb();
                                });
                            }else{
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Peringatan',
                                    text: response,
                                    showConfirmButton: true,
                                    confirmButtonColor: '#6f42c1',
                                    timer: 3000
                                });
                            }
                        }
                    }) 
                }
            }
        });
    });

</script>