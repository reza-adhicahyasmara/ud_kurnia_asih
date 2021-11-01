<table style="width:100%" id="dataTableSupplier" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Foto</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Nama Supplier</th>
            <th id="" style="text-align: center; vertical-align: middle; ">PIC</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Alamat</th>
            <th id="" style="text-align: center; vertical-align: middle; ">No. Telp / HP</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Username</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Password</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($supplier->result() as $row) {
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
            <td style="text-align: center; vertical-align: middle;">
                <?php if($row->foto_supplier != "") { ?>
                    <div class="d-flex justify-content-center">
                        <div class=" img-circle elevation-1" style="width: 80px; height: 80px; border:1px solid #ced4da;">
                            <img src="<?php echo base_url('assets/img/supplier/'.$row->foto_supplier);?>" alt="Image" class="img-circle elevation-1" style="width:80px; height:80px; object-fit:cover; background:white;">
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
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_supplier;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->pic_supplier;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->alamat_supplier;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->kontak_supplier;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->username_supplier;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->password_supplier;?></td>
            <td style="text-align: center; vertical-align: middle;" >
                <a class='btn btn-info btn-sm btn-rounded btn_detail_supplier' href="<?php echo base_url('pimpinan/supplier/detail/'). $row->id_supplier; ?>" style="margin:3px"><span class="bx bx-fw bx-show"></span></a>
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
        $("#dataTableSupplier").DataTable({
        "responsive": true,
        "autoWidth": false,
        });
    });
</script>