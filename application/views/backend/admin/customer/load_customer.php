<table style="width:100%" id="dataTableCustomer" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Foto</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Nama Customer</th>
            <th id="" style="text-align: center; vertical-align: middle; ">PIC</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Alamat</th>
            <th id="" style="text-align: center; vertical-align: middle; ">No. Telp / HP</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Ongkir / Truk (Rp)</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Berat / Truk (Kg)</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Username</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Password</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($customer->result() as $row) {
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td style="text-align: center; vertical-align: middle;">
                <?php if($row->foto_customer != "") { ?>
                    <div class="d-flex justify-content-center">
                        <div class=" img-circle elevation-1" style="width: 80px; height: 80px; border:1px solid #ced4da;">
                            <img src="<?php echo base_url('assets/img/customer/'.$row->foto_customer);?>" alt="Image" class="img-circle elevation-1" style="width:80px; height:80px; object-fit:cover; background:white;">
                        </div>
                    </div>
                <?php }else{ ?>
                    <div class="d-flex justify-content-center">
                        <div class=" img-circle elevation-1" style="width: 80px; height: 80px; border:1px solid #ced4da;">
                            <img src="<?php echo base_url('assets/img/banner/image_alt.svg');?>" alt="Image" alt="Image" style="width:60px; height:60px; margin-top: 9px; object-fit:cover;">
                        </div>
                    </div>
                <?php } ?>
            </td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_customer;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->pic_customer;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->alamat_customer;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->kontak_customer;?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->ongkir_customer, 0, ".", ".");?></td>
            <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->berat_ongkir_customer, 0, ".", ".");?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->username_customer;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->password_customer;?></td>
            <td style="text-align: center; vertical-align: middle;" >
                <a class='btn btn-info btn-sm btn-rounded btn_edit_customer' id_customer = "<?php echo $row->id_customer; ?>" ><span class="bx bx-fw bx-pencil"></span></a>
                <a class='btn btn-danger btn-sm btn-rounded btn_hapus_customer' nama_customer="<?php echo $row->nama_customer; ?>" id_customer="<?php echo $row->id_customer; ?>"><span class="bx bx-fw bx-trash"></span></a>
            </td>
        </tr>
        <?php
            $no++;
             } 
        ?>
    </tbody>
</table>

<script>
    $(function () {
        $("#dataTableCustomer").DataTable({
        "responsive": true,
        "autoWidth": false,
        });
    });
</script>