<table style="width:100%" id="dataTable" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Kode</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Nama</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Qty</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($resep->result() as $row) {
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_bb;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_bb;?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->qty_resep, 2, ".", ".")." ".$row->nama_satuan;?></td>
            <td style="text-align: center; vertical-align: middle;" >
                <a class='btn btn-danger btn-sm btn-rounded btn_hapus_resep' kode_resep="<?php echo $row->kode_resep; ?>" nama_bb="<?php echo $row->nama_bb; ?>"><span class="bx bx-fw bx-trash"></span></a>
            </td>
        </tr>
        <?php
            $no++;
             } 
        ?>
    </tbody>
</table>