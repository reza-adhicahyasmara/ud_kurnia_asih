<table style="width:100%" id="dataTable11" class="table table-bordered table-striped">
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
            <td style="text-align: center; vertical-align: middle;">
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
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($total_pby_pemesanan_bb - $subtotal_ipemesanan_bb, 2, ",", "."); ?></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="6" style="text-align: right; vertical-align: middle;">Total</td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($total_pby_pemesanan_bb, 2, ",", "."); ?></td>
            <td></td>
        </tr>
    </tfoot>
</table>

