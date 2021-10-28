<input type="hidden" id="jenis" value="Tambah">
<span id="alert"></span>
<div class="form-group mb-3">
    <label>Judul</label>
    <input type="text" class="form-control" name="judul_proposal" id="judul_proposal" placeholder="Judul">
</div>
<div class="form-group">
    <label>Unggah Proposal Penawaran (.pdf)</label> 
    <div class="row">   
        <div class="form-group col-md-9 col-sm-9 col-9">                           
            <input type="text" class="form-control" name="berkas_proposal" id="berkas_proposal" placeholder=".pdf" style="background-color : #ffffff;" readonly/>    
        </div>
        <div class="form-group col-md-3 col-sm-3 col-3">  
            <input type="text" class="form-control btn btn-outline-primary" id="btn_berkas_proposal" placeholder="Pilih" readonly/>
        </div>
    </div>
</div>
<small class="text-secondary">*Pastikan data di atas diisi dengan benar</small>


<script>
    
    var berkas_proposal = new Dropzone("input#btn_berkas_proposal",{ 
        url: "<?php echo base_url('supplier/proposal/save_pdf'); ?>",
        maxFiles : 1,
        acceptedFiles : '.pdf',
        dictRemoveFile: "Hapus",
        addRemoveLinks:true,
        init: function(){   
            this.on("success",function(file,response){
                $('#berkas_proposal').val(response);
            }); 
        }
    });

</script>