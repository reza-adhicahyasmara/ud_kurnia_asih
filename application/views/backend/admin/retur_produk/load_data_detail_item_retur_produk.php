<table style="width:100%" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; width:10%">Gambar</th>
            <th id="" style="text-align: center; vertical-align: middle; width:15%">Kode</th>
            <th id="" style="text-align: center; vertical-align: middle; width:15%">Produk</th>
            <th id="" style="text-align: center; vertical-align: middle; width:10%">Jumlah</th>
            <th id="" style="text-align: center; vertical-align: middle; width:25%">Keterangan Retur</th>
            <th id="" style="text-align: center; vertical-align: middle; width:25%">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($list_produk->result() as $row) {
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td style="text-align: center; vertical-align: middle;">
                <?php if($row->gambar_iretur_produk != "") { ?>
                    <img style="margin:-5px;" class="img-thumbnail" alt="Image" src="<?php echo base_url('assets/img/retur_produk/'.$row->gambar_iretur_produk);?>" width="100px" height="100px">
                <?php }else{ ?>
                    <img src="<?php echo base_url('assets/img/banner/image_alt.svg');?>" alt="Image" width="100px" height="100px">
                <?php } ?> 
            </td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_produk;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_produk;?></td>
            <td style="text-align: center; vertical-align: middle;"><?php echo number_format($row->jumlah_iretur_produk, 0, ".", ".")." ".$row->nama_satuan;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->keterangan_iretur_produk;?></td>
            <td style="text-align: left; vertical-align: middle;">  
                <?php 
                    $status = $row->status_iretur_produk;
                    if($status == 2){
                        echo "Proses";
                    }else if($status == 3){
                        echo "Diterima";
                    }else if($status == 4){
                        echo "Ditolak<br>"."Keterangan : ".$row->keterangan_batal_iretur_produk;
                    }
                ?>                     
            </td>
        </tr>
            <?php $no++; } ?>
    </tbody>
</table>
