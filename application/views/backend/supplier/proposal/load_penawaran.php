<table style="width:100%" id="dataTablePenawaran" class="table table-bordered table-striped">
    <caption></caption>
    <thead>
        <tr>
            <th id="" style="text-align: center; vertical-align: middle; ">No.</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Tanggal</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Nama Supplier</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Poposal</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Berkas</th>
            <th id="" style="text-align: center; vertical-align: middle; ">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no = 1;
            foreach($penawaran->result() as $row) {
                if($row->id_supplier != ""){
        ?>
        <tr>
            <td style="text-align: center; vertical-align: middle;"><?php echo $no;?>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->tanggal_proposal;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_supplier;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->judul_proposal;?></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $row->berkas_proposal;?></td>
            <td style="text-align: center; vertical-align: middle;" >
                <a class='btn btn-outline-info btn-sm btn-rounded view_pdf_proposal' berkas_proposal="<?php echo $row->berkas_proposal; ?>" kode_proposal="<?php echo $row->kode_proposal; ?>"><span class="bx bx-fw bxs-file-pdf"></span></a>
                <a class='btn btn-outline-danger btn-sm btn-rounded btn_hapus_proposal' judul_proposal="<?php echo $row->judul_proposal; ?>" kode_proposal="<?php echo $row->kode_proposal; ?>" berkas_proposal="<?php echo $row->berkas_proposal; ?>"><span class="bx bx-fw bx-trash"></span></a>
            </td>
        </tr>
        <?php
                    $no++;
                }
            } 
        ?>
    </tbody>
</table>

<script>
    $(function () {
        $("#dataTablePenawaran").DataTable({
            responsive: true,
        });
    });
    
    $('.view_pdf_proposal').on("click",function(){ 
        var kode_proposal = $(this).attr("kode_proposal");
        var berkas_proposal = $(this).attr("berkas_proposal");
        var aaa = kode_proposal + "|" + berkas_proposal;
        var url = '<?php echo base_url('admin/proposal/view_pdf_proposal'); ?>';

        $('#modal_view_pdf').modal('show');
        $('.modal-title').text('PDF');
        $('.modal-body').load(url, {aaa:aaa});

        
        load_data_proposal();
    });

</script>