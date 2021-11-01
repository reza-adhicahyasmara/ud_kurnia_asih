<div style="text-align: center">
    <h3><strong> CV Mustika Flamboyan</strong></h3>
    <span>JL. Raya Siliwangi, No. 193, Ciawigebang, Cigintung, Kec. Kuningan, Kabupaten Kuningan, Jawa Barat 45517</span>
    </br>
    <span>(0232) 878333</span>
    <hr>
    <strong>Laporan Data Bahan Baku Masuk</strong>     
    </br>
    <span><?php echo $tanggal_awal." - ".$tanggal_akhir; ?></span>
</div>
</br>
<table style="width:100%" id="tableMasuk" class="table table-bordered">
<caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle;">No.</th>
            <th id="" style="text-align: center; vertical-align: middle;">Tanggal<br>Masuk </th>
            <th id="" style="text-align: center; vertical-align: middle;">Kode<br>Pemesanan </th>
            <th id="" style="text-align: center; vertical-align: middle;">Supplier</th>
            <th id="" style="text-align: center; vertical-align: middle;">Kode Bahan Baku </th>
            <th id="" style="text-align: center; vertical-align: middle;">Bahan Baku</th>
            <th id="" style="text-align: center; vertical-align: middle;">Kategori</th>
            <th id="" style="text-align: center; vertical-align: middle;">Harga Per Item (Rp.)</th>
            <th id="" style="text-align: center; vertical-align: middle;">Jumlah Item</th>
            <th id="" style="text-align: center; vertical-align: middle;">Subtotal (Rp.)</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $subtotal_item = 0; 
            $subtotal_harga = 0; 
            $no = 1;
            foreach($data->result() as $row) {
                $baris = 0;
                foreach($item_bb->result() as $row1) {   
                    if($row1->kode_pemesanan_bb == $row->kode_pemesanan_bb){
                        $baris += 1;
                    }
                }
        ?>
        <tr>
            <td rowspan="<?php echo $baris;?>" class="text-sm" style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td rowspan="<?php echo $baris;?>" class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo date('d-m-Y h:m', strtotime($row->tanggal_pemesanan_bb));?></td>
            <td rowspan="<?php echo $baris;?>" class="text-sm" style="text-align: left; vertical-align: middle;"><a href="<?php echo base_url('pimpinan/pemesanan_bahan_baku/detail/').$row->kode_pemesanan_bb;?>"><?php echo $row->kode_pemesanan_bb;?></a></td>
            <td rowspan="<?php echo $baris;?>" class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo $row1->nama_supplier;?></td>
            <?php
                foreach($item_bb->result() as $row1) {   
                    if($row1->kode_pemesanan_bb == $row->kode_pemesanan_bb){?>
        </tr>
            <td class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo $row1->kode_bb;?></td>
            <td class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo $row1->nama_bb;?></td>
            <td class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo $row1->nama_kategori;?></td>
            <td class="text-sm" style="text-align: right; vertical-align: middle;"><?php echo number_format($row1->harga_bb, 2, ',', '.');?></td>
            <td class="text-sm" style="text-align: right; vertical-align: middle;"><?php echo number_format($row1->jumlah_ipemesanan_bb, 0, '.', '.')." ".$row1->nama_satuan;?></td>
            <td class="text-sm" style="text-align: right; vertical-align: middle;"><?php echo number_format($row1->subtotal_ipemesanan_bb, 2, ',', '.');?></td>
            </tr>
            <?php 
            $subtotal_item += $row1->jumlah_ipemesanan_bb;
            $subtotal_harga += $row1->subtotal_ipemesanan_bb;
                        }
                    } 
                $no++; 
            } 
        ?>
    </tbody>
    <tfooter>
        <tr>
            <td colspan="9" style="text-align: right; vertical-align: middle;">Total</td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($subtotal_harga, 2, ',', '.'); ?></td>
        </tr>
    </tfooter>
</table>
