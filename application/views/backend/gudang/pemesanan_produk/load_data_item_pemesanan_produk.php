<table style="width:100%" id="dataTable11" class="table table-bordered table-striped">
    <caption></caption>
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
            <?php if($status_pemesanan_produk == 3) { ?>
                <th id="" style="text-align: center; vertical-align: middle; width:7%">Aksi</th>
            <?php }elseif($status_pemesanan_produk == 7){ ?>
                <th id="" style="text-align: center; vertical-align: middle; width:7%">Verifikasi Retur</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            $subtotal_ipemesanan_produk = 0;
            foreach($list_produk->result() as $row) {
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td style="text-align: left; vertical-align: middle;">
                <?php 
                    $tanggal_kadaluwarsa = $row->tanggal_kadaluwarsa_ipemesanan_produk;
                    if($tanggal_kadaluwarsa == ""){
                        echo "-";
                    }else{
                        echo $tanggal_kadaluwarsa;
                    }
                ?>
            </td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_produk;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_produk;?></td>
            <td style="text-align: center; vertical-align: middle;"><?php echo number_format($row->harga_ipemesanan_produk, 2, ",", ".")."/".$row->nama_satuan;?></td>
            <td style="text-align: center; vertical-align: middle;"><?php echo number_format($row->jumlah_ipemesanan_produk, 0, ".", ".")." ".$row->nama_satuan;?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($subtotal_ipemesanan_produk += $row->subtotal_ipemesanan_produk, 2, ",", ".");?></td>
            <td style="text-align: ledt; vertical-align: middle;">
                <?php 
                    $status_ipemesanan_produk = $row->status_ipemesanan_produk;
                    if($status_ipemesanan_produk == 2 || $status_ipemesanan_produk == 3){
                        echo "Proses";
                        if($row->jumlah_retur_ipemesanan_produk != ""){
                            echo "<br>Retur<br>Jumlah : ".$row->jumlah_retur_ipemesanan_produk."<br>Ket : ".$row->keterangan_retur_ipemesanan_produk;
                        }
                    }elseif($status_ipemesanan_produk == 3){
                        echo "Dikirim";
                    }elseif($status_ipemesanan_produk == 4){
                        echo "Baik";
                    }elseif($status_ipemesanan_produk == 5){
                        echo "Retur<br>Jumlah : ".$row->jumlah_retur_ipemesanan_produk."<br>Ket : ".$row->keterangan_retur_ipemesanan_produk;
                    }elseif($status_ipemesanan_produk == 6){
                        echo "Selesai";
                    }
                ?>
            </td>
            <?php if($status_pemesanan_produk == 3){ ?>
                <td style="text-align: center; vertical-align: middle;">
                    <a class='btn btn-info btn-sm btn-rounded btn_edit_item_produk' kode_ipemesanan_produk="<?php echo $row->kode_ipemesanan_produk; ?>"><span class="bx bx-fw bx-calendar-edit"></span></a>
                </td>
            <?php }else if($status_pemesanan_produk == 7){ ?> 
                <td style="text-align: center; vertical-align: middle;">
                    <?php  if($status_ipemesanan_produk == 5){ ?>
                        <a class='btn btn-success btn-sm btn-rounded btn_edit_item_produk_terima_retur' kode_ipemesanan_produk="<?php echo $row->kode_ipemesanan_produk; ?>" jumlah_retur_ipemesanan_produk="<?php echo $row->jumlah_retur_ipemesanan_produk; ?>"  keterangan_retur_ipemesanan_produk="<?php echo $row->keterangan_retur_ipemesanan_produk; ?>"><span class="bx bx-fw bx-check"></span></a>
                    <?php } ?>
                </td>
            <?php } ?>
        </tr>
            <?php $no++; } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6" style="text-align: right; vertical-align: middle;">Ongkos Kirim</td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($total_pby_pemesanan_produk - $subtotal_ipemesanan_produk, 2, ",", "."); ?></td>
        </tr>
        <tr>
            <td colspan="6" style="text-align: right; vertical-align: middle;">Total</td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($total_pby_pemesanan_produk, 2, ",", "."); ?></td>
        </tr>
    </tfoot>
</table>


<script src="<?php echo base_url(); ?>assets/plugins/datetimepicker/build/jquery.datetimepicker.full.js"></script>
<script>
    $('.btn_edit_item_produk').on("click",function(){
        var kode_ipemesanan_produk = $(this).attr("kode_ipemesanan_produk");

        Swal.fire({
            title: 'Tanggal Kadaluwarsa',
            text: 'Apakah anda yakin akan menyetujui pengajuan pinjaman',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6f42c1',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Ya, simpan',
            cancelButtonText: "Tidak, batalkan",
            showLoaderOnConfirm: true,
            onOpen: function() {
                $('#tanggal_kadaluwarsa_ipemesanan_produk').datetimepicker({
                    //inline:true,
                    minDateTime: new Date(),
                    format: 'Y-m-d',
                    timepicker:false,
                    autoclose: true
                });
            },
            html: '<input type="text" id="tanggal_kadaluwarsa_ipemesanan_produk" class="swal2-input"  autocomplete="off" style="background-color: #fff; color:#000" readonly>',

            preConfirm: (response) => {                 
                const tanggal_kadaluwarsa_ipemesanan_produk = Swal.getPopup().querySelector('#tanggal_kadaluwarsa_ipemesanan_produk').value;
                
                if (!tanggal_kadaluwarsa_ipemesanan_produk) {
                    Swal.showValidationMessage('Tanggal tidak boleh kosong')
                }else{     
                    $.ajax({
                        url: '<?php echo base_url('gudang/pemesanan_produk/insert_tanggal_kadaluwarsa'); ?>',
                        method: 'POST',
                        data: {
                            kode_ipemesanan_produk:kode_ipemesanan_produk,
                            tanggal_kadaluwarsa_ipemesanan_produk:tanggal_kadaluwarsa_ipemesanan_produk
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
                                    load_data_item_pemesanan_produk();
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

    $('.btn_edit_item_produk_terima_retur').on("click",function(){
        var kode_ipemesanan_produk = $(this).attr("kode_ipemesanan_produk");
        var jumlah_retur_ipemesanan_produk = $(this).attr("jumlah_retur_ipemesanan_produk");
        var keterangan_retur_ipemesanan_produk = $(this).attr("keterangan_retur_ipemesanan_produk");
        var status_ipemesanan_produk = "3";

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
                    url: '<?php echo base_url('customer/pemesanan_produk/update_status_item_produk'); ?>',
                    method: 'POST',
                    data: {
                        kode_ipemesanan_produk:kode_ipemesanan_produk,
                        jumlah_retur_ipemesanan_produk:jumlah_retur_ipemesanan_produk,
                        keterangan_retur_ipemesanan_produk:keterangan_retur_ipemesanan_produk,
                        status_ipemesanan_produk:status_ipemesanan_produk
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
                                load_data_item_pemesanan_produk();
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
</script>