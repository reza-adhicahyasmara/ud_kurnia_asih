<div style="text-align: center">
    <h3><strong> CV Mustika Flamboyan</strong></h3>
    <span>JL. Raya Siliwangi, No. 193, Ciawigebang, Cigintung, Kec. Kuningan, Kabupaten Kuningan, Jawa Barat 45517</span>
    </br>
    <span>(0232) 878333</span>
    <hr>
    <strong>Laporan Data Pemesanan Produk</strong>     
    </br>
    <span><?php echo $tanggal_awal." - ".$tanggal_akhir; ?></span>
    </br>
    <span>
        <?php 
            echo "Status : ";
            if($status == "'1'"){
                echo "Menunggu Pembayaran";
            }
            elseif($status == "'2'"){
                echo "Verifikasi Pembayaran";
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
            <th id="" style="text-align: center; vertical-align: middle;">Customer</th>
            <th id="" style="text-align: center; vertical-align: middle;">PIC</th>
            <th id="" style="text-align: center; vertical-align: middle;">Status</br>Pemesanan</th>
            <th id="" style="text-align: center; vertical-align: middle;">Keterangan Batal</th>
            <th id="" style="text-align: center; vertical-align: middle;">Transfer</th>
            <th id="" style="text-align: center; vertical-align: middle;">Status</br>Pembayaran</th>
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
            <td class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo date('d-m-Y h:m', strtotime($row->tanggal_pemesanan_produk));?></td>
            <td class="text-sm" style="text-align: left; vertical-align: middle;"><a href="<?php echo base_url('admin/pemesanan_produk/detail/').$row->kode_pemesanan_produk;?>"><?php echo $row->kode_pemesanan_produk;?></a></td>
            <td class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo $row->nama_customer;?></td>
            <td class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo $row->pic_customer." (".$row->kontak_customer.")";?></td>
            <td class="text-sm" style="text-align: center; vertical-align: middle;"><?php
                                                                    $status_pemesanan_produk = $row->status_pemesanan_produk;
                                                                    if($status_pemesanan_produk==1){
                                                                        echo "Menunggu Pembayaran";
                                                                    } elseif($status_pemesanan_produk==2){
                                                                        echo "Verifikasi Pembayaran";
                                                                    } elseif($status_pemesanan_produk==3){
                                                                        echo "Pesanan Diproses";
                                                                    } elseif($status_pemesanan_produk==4){
                                                                        echo "Pesanan Dikirim";
                                                                    } elseif($status_pemesanan_produk==5){
                                                                        echo "Pesanan Selesai";
                                                                    } elseif($status_pemesanan_produk==6){
                                                                        echo "Pesanan Dibatalkan";
                                                                    } 
                                                                    ?>
            </td>
            <td class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo $row->keterangan_batal_pemesanan_produk; ?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_bank." | ".$row->no_rekening." | ".$row->an_rekening;?></td>
            <td class="text-sm" style="text-align: center; vertical-align: middle;"><?php
                                                                    $status_pby_pemesanan_produk = $row->status_pby_pemesanan_produk;
                                                                    if($status_pby_pemesanan_produk==1){
                                                                        echo "Belum Dibayarkan";
                                                                    } elseif($status_pby_pemesanan_produk==2){
                                                                        echo "Verifikasi Pembayaran";
                                                                    } elseif($status_pby_pemesanan_produk==3){
                                                                        echo "Lunas";
                                                                    } elseif($status_pby_pemesanan_produk==4){
                                                                        echo "Pembayaran Dikembalikan";
                                                                    } 
                                                                    ?>
            </td>
            <td class="text-sm" style="text-align: right; vertical-align: middle;"><?php echo number_format($total_pby_pemesanan_produk = $row->total_pby_pemesanan_produk, 2, ',', '.');?></td>
        </tr>
        <?php   
                if($status_pby_pemesanan_produk == 2){
                    $total_sudah_dibayarkan += $total_pby_pemesanan_produk; 
                } else if($status_pby_pemesanan_produk == 3){
                    $total_lunas += $total_pby_pemesanan_produk; 
                } else if($status_pby_pemesanan_produk == 4){
                    $total_dikembalikan += $total_pby_pemesanan_produk; 
                }
            $no++; 
            } 
        ?>
    </tbody>
    <tfooter>
        <tr>
            <td colspan="9" style="text-align: right; vertical-align: middle;">Total Verifikasi Pembayaran</td>
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
