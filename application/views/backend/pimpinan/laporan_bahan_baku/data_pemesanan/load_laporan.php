<div style="text-align: center">
    <h3><strong> CV Mustika Flamboyan</strong></h3>
    <span>JL. Raya Siliwangi, No. 193, Ciawigebang, Cigintung, Kec. Kuningan, Kabupaten Kuningan, Jawa Barat 45517</span>
    </br>
    <span>(0232) 878333</span>
    <hr>
    <strong>Laporan Data Pemesanan Bahan Baku</strong>     
    </br>
    <span><?php echo $tanggal_awal." - ".$tanggal_akhir; ?></span>
    </br>
    <span>
        <?php 
            echo "Status : ";
            if($status == "'1'"){
                echo "Menunggu pby";
            }
            elseif($status == "'2'"){
                echo "Verifikasi pby";
            }
            elseif($status == "'3'"){
                echo "Proses Produk";
            }
            elseif($status == "'4'"){
                echo "Produk Dikirim";
            }
            elseif($status == "'5'"){
                echo "Selesai";
            }
            elseif($status == "'6'"){
                echo "Batal";
            }
            elseif($status == "'7'"){
                echo "Retur";
            }
            else{
                echo "Semua";
            }        
        ?>
    </span> 
</div>
</br>
<table style="width:100%" id="tableMasuk" class="table table-bordered">
<caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle;">No.</th>
            <th id="" style="text-align: center; vertical-align: middle;">Tanggal</br>Pemesanan</th>
            <th id="" style="text-align: center; vertical-align: middle;">Kode</br>Pemesanan</th>
            <th id="" style="text-align: center; vertical-align: middle;">Supplier</th>
            <th id="" style="text-align: center; vertical-align: middle;">PIC</th>
            <th id="" style="text-align: center; vertical-align: middle;">Status</br>Pemesanan</th>
            <th id="" style="text-align: center; vertical-align: middle;">Keterangan</th>
            <th id="" style="text-align: center; vertical-align: middle;">Transfer</th>
            <th id="" style="text-align: center; vertical-align: middle;">Status</br>Pembyaran</th>
            <th id="" style="text-align: center; vertical-align: middle;">Total<br>Pembelanjaan (Rp.)</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $total_sudah_dibayarkan = 0; 
            $total_lunas = 0; 
            $total_dikembalikan = 0; 
            $no = 1;
            foreach($data->result() as $row) {
        ?>
        <tr>
            <td class="text-sm" style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo date('d-m-Y h:m', strtotime($row->tanggal_pemesanan_bb));?></td>
            <td class="text-sm" style="text-align: left; vertical-align: middle;"><a href="<?php echo base_url('pimpinan/pemesanan_bahan_baku/detail/').$row->kode_pemesanan_bb;?>"><?php echo $row->kode_pemesanan_bb;?></a></td>
            <td class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo $row->nama_supplier;?></td>
            <td class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo $row->pic_supplier." (".$row->kontak_supplier.")";?></td>
            <td class="text-sm" style="text-align: center; vertical-align: middle;"><?php
                                                                    $status_pemesanan_bb = $row->status_pemesanan_bb;
                                                                    if($status_pemesanan_bb==1){
                                                                        echo "Menunggu pby";
                                                                    } elseif($status_pemesanan_bb==2){
                                                                        echo "Verifikasi pby";
                                                                    } elseif($status_pemesanan_bb==3){
                                                                        echo "Pesanan Diproses";
                                                                    } elseif($status_pemesanan_bb==4){
                                                                        echo "Pesanan Dikirim";
                                                                    } elseif($status_pemesanan_bb==5){
                                                                        echo "Pesanan Selesai";
                                                                    } elseif($status_pemesanan_bb==6){
                                                                        echo "Pesanan Dibatalkan";
                                                                    } elseif($status_pemesanan_bb==7){
                                                                        echo "Pesanan Diretur";
                                                                    } 
                                                                    ?>
            </td>
            <td class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo $row->keterangan_batal_pemesanan_bb; ?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->no_rekening." AN ".$row->an_rekening." (".$row->nama_bank.")";?></td>
            <td class="text-sm" style="text-align: center; vertical-align: middle;"><?php
                                                                    $status_pby_pemesanan_bb = $row->status_pby_pemesanan_bb;
                                                                    if($status_pby_pemesanan_bb==1){
                                                                        echo "Belum Dibayarkan";
                                                                    } elseif($status_pby_pemesanan_bb==2){
                                                                        echo "Verifikasi pby";
                                                                    } elseif($status_pby_pemesanan_bb==3){
                                                                        echo "Lunas";
                                                                    } elseif($status_pby_pemesanan_bb==4){
                                                                        echo "pby Dikembalikan";
                                                                    } 
                                                                    ?>
            </td>
            <td class="text-sm" style="text-align: right; vertical-align: middle;"><?php echo number_format($total_pby_pemesanan_bb = $row->total_pby_pemesanan_bb, 2, ',', '.');?></td>
        </tr>
        <?php   
                if($status_pby_pemesanan_bb == 2){
                    $total_sudah_dibayarkan += $total_pby_pemesanan_bb; 
                } else if($status_pby_pemesanan_bb == 3){
                    $total_lunas += $total_pby_pemesanan_bb; 
                } else if($status_pby_pemesanan_bb == 4){
                    $total_dikembalikan += $total_pby_pemesanan_bb; 
                }
            $no++; 
            } 
        ?>
    </tbody>
    <tfooter>
        <tr>
            <td colspan="9" style="text-align: right; vertical-align: middle;">Total Verifikasi Pembyaran</td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($total_sudah_dibayarkan, 2, ',', '.'); ?></td>
        </tr>
        <tr>
            <td colspan="9" style="text-align: right; vertical-align: middle;">Total Lunas</td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($total_lunas, 2, ',', '.'); ?></td>
        </tr>
        <tr>
            <td colspan="9" style="text-align: right; vertical-align: middle;">Total Dikembalikan</td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($total_dikembalikan, 2, ',', '.'); ?></td>
        </tr>
    </tfooter>
</table>
