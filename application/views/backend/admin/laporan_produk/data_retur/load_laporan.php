<div style="text-align: center">
    <h3><strong> CV Mustika Flamboyan</strong></h3>
    <span>JL. Raya Siliwangi, No. 193, Ciawigebang, Cigintung, Kec. Kuningan, Kabupaten Kuningan, Jawa Barat 45517</span>
    </br>
    <span>(0232) 878333</span>
    <hr>
    <strong>Laporan Data Retur Produk</strong>     
    </br>
    <span><?php echo $tanggal_awal." - ".$tanggal_akhir; ?></span>
    </br>
    <span>
        <?php 
            echo "Status : ";
            if($status == "'1'"){
                echo "Menunggu Konfirmasi";
            }
            elseif($status == "'2'"){
                echo "Dikirim";
            }
            elseif($status == "'3'"){
                echo "Retur Diterima";
            }
            elseif($status == "'4'"){
                echo "Retur Ditolak";
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
            <th id="" style="text-align: center; vertical-align: middle;">Tanggal</br>Retur</th>
            <th id="" style="text-align: center; vertical-align: middle;">Kode Retur </th>
            <th id="" style="text-align: center; vertical-align: middle;">Nama Customer </th>
            <th id="" style="text-align: center; vertical-align: middle;">Status</th>
            <th id="" style="text-align: center; vertical-align: middle;">Kode Produk </th>
            <th id="" style="text-align: center; vertical-align: middle;">Produk</th>
            <th id="" style="text-align: center; vertical-align: middle;">Kategori</th>
            <th id="" style="text-align: center; vertical-align: middle;">Jumlah Item</th>
            <th id="" style="text-align: center; vertical-align: middle;">Keterangan Item</th>
            <th id="" style="text-align: center; vertical-align: middle;">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            
            foreach($data->result() as $row) {
                $baris  = 0;
                foreach($retur_produk->result() as $row1) {   
                    if($row->kode_retur_produk == $row1->kode_retur_produk){
                        $baris += 1;
                    }
                }

        ?>
        
        <tr>
            <td rowspan="<?php echo $baris;?>" class="text-sm" style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td rowspan="<?php echo $baris;?>" class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo date('d-m-Y h:m', strtotime($row->tanggal_retur_produk));?></td>
            <td rowspan="<?php echo $baris;?>" class="text-sm" style="text-align: left; vertical-align: middle;"><a href="<?php echo base_url('admin/retur_produk/detail/').$row->kode_retur_produk;?>"><?php echo $row->kode_retur_produk;?></a></td>
            <td rowspan="<?php echo $baris;?>" class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo $row->nama_customer;?></td>
            <td rowspan="<?php echo $baris;?>" class="text-sm" style="text-align: left; vertical-align: middle;">
                <?php 
                    $status_retur_produk = $row->status_retur_produk;
                    if($status_retur_produk == "1"){
                        echo "Menunggu Konfirmasi";
                    }
                    elseif($status_retur_produk == "2"){
                        echo "Dikirim";
                    }
                    elseif($status_retur_produk == "3"){
                        echo "Retur Diterima";
                    }
                    elseif($status_retur_produk == "4"){
                        echo "Retur Ditolak";
                    }  
                 ?>
            </td>
            <?php
                foreach($retur_produk->result() as $row1) {   
                    if($row1->kode_retur_produk == $row->kode_retur_produk){?>
                        <td class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo $row1->kode_produk;?></td>
                        <td class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo $row1->nama_produk."<br>";?></td> 
                        <td class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo $row1->nama_kategori;?></td> 
                        <td class="text-sm" style="text-align: right; vertical-align: middle;"><?php echo number_format($row1->jumlah_iretur_produk, 2, ',', '.')." ".$row1->nama_satuan;?></td>
                        <td class="text-sm" style="text-align: left; vertical-align: middle;"><?php echo $row1->keterangan_iretur_produk."<br>";?></td>
                        <td style="text-align: left; vertical-align: middle;">  
                            <?php 
                                $status = $row1->status_iretur_produk;
                                if($status == 2){
                                    echo "Proses";
                                }else if($status == 3){
                                    echo "Diterima";
                                }else if($status == 4){
                                    echo "Ditolak<br>"."Keterangan : ".$row1->keterangan_iretur_produk;
                                }
                            ?>                      
                        </td>
        </tr>
            <?php 
                        }
                    } 
                ?>
            <?php   
                $no++; 
            }
        ?>
    </tbody>
</table>
