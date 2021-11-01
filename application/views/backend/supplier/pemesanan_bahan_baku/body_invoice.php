<?php 
    foreach($data_detail->result() as $haha) {
        $status_pemesanan_bb = $haha->status_pemesanan_bb;
        $status_pby_pemesanan_bb = $haha->status_pby_pemesanan_bb;
?>
    <div class="content-wrapper" style="margin-left: 0px;">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline">
                        <div class="card-body">
                            <br>
                            <div style="text-align: center;">
                                <h2>INVOICE</h2>
                                <h4><?php echo $haha->kode_pemesanan_bb ?></h4>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-6">
                                    <h4>Data Pemesanan</h4>
                                </div>  
                                <div class="col-sm-6">
                                    <div class="float-sm-right">    
                                        <?php
                                            if($status_pemesanan_bb==1){
                                                echo "<span class='badge badge-warning text-md'>Menunggu Pembayaran</span>";
                                            } elseif($status_pemesanan_bb==2){
                                                echo "<span class='badge badge-info text-md'>Verifikasi Pembayaran</span>";
                                            } elseif($status_pemesanan_bb==3){
                                                echo "<span class='badge badge-primary text-md'>Pesanan Diproses</span>";
                                            } elseif($status_pemesanan_bb==4){
                                                echo "<span class='badge badge-info text-md'>Pesanan Dikirim</span>";
                                            } elseif($status_pemesanan_bb==5){
                                                echo "<span class='badge badge-success text-md'>Pesanan Selesai</span>";
                                            } elseif($status_pemesanan_bb==6){
                                                echo "<span class='badge badge-danger text-md'>Pesanan Dibatalkan</span>";
                                            } elseif($status_pemesanan_bb==7){
                                                echo "<span class='badge badge-danger text-md'>Diretur</span>";
                                            } 
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <table style="width:100%" class="table">
                                <caption></caption>
                                <tr>
                                    <td>Invoice</td>
                                    <td>:</td>
                                    <td><?php echo $haha->kode_pemesanan_bb;?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Pengajuan</td>
                                    <td>:</td>
                                    <td><?php echo nice_date($haha->tanggal_pemesanan_bb,'d-m-Y H:m:s') ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Terima</td>
                                    <td>:</td>
                                    <td><?php if($haha->tanggal_terima_pemesanan_bb == ""){echo "-";}else{echo nice_date($haha->tanggal_terima_pemesanan_bb,'d-m-Y H:m:s');}?></td>
                                </tr>
                                <tr>
                                    <td>Transfer</td>
                                    <td>:</td>
                                    <td><?php echo $haha->no_rekening." AN ".$haha->an_rekening." (".$haha->nama_bank.")";?></td>
                                </tr>
                                <tr>
                                    <td>Total Pembayaran</td>
                                    <td>:</td>
                                    <td>Rp. <?php echo number_format($haha->total_pby_pemesanan_bb, 2, ",", ".");?></td>
                                </tr>
                                <tr>
                                    <td>Status Pembayaran</td>
                                    <td>:</td>
                                    <td>
                                        <?php
                                            if($status_pby_pemesanan_bb==1){
                                                echo "Belum Dibayarkan";
                                            } elseif($status_pby_pemesanan_bb==2){
                                                echo "Sudah Dibayarkan";
                                            } elseif($status_pby_pemesanan_bb==3){
                                                echo "Lunas";
                                            } elseif($status_pby_pemesanan_bb==4){
                                                echo "Pembayaran Dikembalikan";
                                            } 
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td>:</td>
                                    <td><?php if($haha->keterangan_batal_pemesanan_bb == ""){echo "-";}else{echo $haha->keterangan_batal_pemesanan_bb; } ?></td>
                                </tr>
                            </table>
                            <br>
                            <br>
                            <h4>Item Pemesanan</h4>
                            <table style="width:100%" class="table table-bordered table-striped">
                                <caption></caption>
                                <thead>
                                    <tr>
                                        <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
                                        <th id="" style="text-align: center; vertical-align: middle; width:10%">Tanggal Kadaluwarsa</th>
                                        <th id="" style="text-align: center; vertical-align: middle; width:20%">Kode</th>
                                        <th id="" style="text-align: center; vertical-align: middle; width:20%">Bahan Baku</th>
                                        <th id="" style="text-align: center; vertical-align: middle; width:10%">Harga (Rp.)</th>
                                        <th id="" style="text-align: center; vertical-align: middle; width:10%">Jumlah</th>
                                        <th id="" style="text-align: center; vertical-align: middle; width:20%">Subtotal (Rp.)</th>
                                        <th id="" style="text-align: center; vertical-align: middle; width:20%">Status Item</th>
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
                                    </tr>
                                        <?php $no++; } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6" style="text-align: right; vertical-align: middle;">Ongkos Kirim</td>
                                        <td style="text-align: right; vertical-align: middle;"><?php echo number_format($haha->total_pby_pemesanan_bb - $subtotal_ipemesanan_bb, 2, ",", "."); ?></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" style="text-align: right; vertical-align: middle;">Total</td>
                                        <td style="text-align: right; vertical-align: middle;"><?php echo number_format($haha->total_pby_pemesanan_bb, 2, ",", "."); ?></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php  } ?>
