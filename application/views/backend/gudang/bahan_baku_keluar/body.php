<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-1 text-dark"><span class="nav-icon bx bx-fw bx-up-arrow-alt"></span> Data Bahan Baku Keluar</h1>
                </div>
                <div class="col-sm-6 float-sm-right">
                    <ol class="breadcrumb float-sm-right m-2">
                        <span class="breadcrumb-item"><a href="<?php echo base_url('gudang/dashboard'); ?>">Dashboard</a></span>
                        <span class="breadcrumb-item active">Data Bahan Baku Keluar</span>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <section class="content">
        <div class="container-fluid">
            <div class="card card-secondary card-outline card-outline-tabs">
                <div class="card-body">
                    <div class="float-right">
                    <button type="button" class="btn bg-purple" id="btn_tambah_bahan_baku_keluar"><span class="bx bx-fw bx-plus"></span> Tambah Data </a>
                    </div>
                    <br>
                    <br>
                    <br>
                    <div id="content_data_bahan_baku_keluar">
                        <!--LOAD DATA-->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<form role="form" id="form_bahan_baku_keluar" method="post">
    <div id="modal_bahan_baku_keluar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><span class="modal-title text-lg" id="myModalLabel"></span></strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- FORM -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="bx bx-fw bx-x"></span> Batal</button>
                    <button type="submit" id="btn_simpan_bahan_baku_keluar" class="btn bg-purple"><span class="bx bx-fw bx-save"></span> Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>


