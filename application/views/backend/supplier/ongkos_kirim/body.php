<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-1 text-dark"><span class="nav-icon bx bx-fw bxs-truck"></span>Ongkos Kirim</h1>
                </div>
                <div class="col-sm-6 float-sm-right">
                    <ol class="breadcrumb float-sm-right m-2">
                        <span class="breadcrumb-item"><a href="<?php echo base_url('supplier/dashboard'); ?>">Dashboard</a></span>
                        <span class="breadcrumb-item active">Ongkos Kirim</span>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-md-center">
                <div class="col-lg-4 col-12">
                    <div class="card card-outline">
                        <div class="card-body">
                            <div id="alert_edit"></div>
                            <input type="hidden" id="jenis" value="Edit">
                                <?php foreach($edit->result() as $edit) { ?>
                                    <form role="form" id="form_ongkir" method="post">
                                        <div class="form-group">
                                            <label>Biaya Ongkir per Truk</label>
                                            <input type="hidden" class="form-control" name="id_supplier" id="id_supplier" value="<?php echo $edit->id_supplier; ?>" placeholder="NIK" readonly>
                                            <input type="text" class="form-control" name="ongkir_supplier" id="ongkir_supplier" value="<?php echo $edit->ongkir_supplier; ?>" placeholder="Rp">
                                        </div>
                                        <div class="form-group">
                                            <label>Berat Muatan per Truk</label>
                                            <input type="text" class="form-control" name="berat_ongkir_supplier" id="berat_ongkir_supplier" value="<?php echo $edit->berat_ongkir_supplier; ?>" placeholder="Kg">
                                        </div>
                                        <div class="form-group" style="text-align:center">
                                            <button type="submit" class="btn bg-purple" id="btn_simpan_ongkir" style="margin-right:5px"><i class="bx bx-fw bx-save"></i> Simpan</button>
                                        </div>
                                    </form>
                                <?php } ?>
                            <caption>
                                Keterangan
                                <ul>
                                    <li>Biaya ongkos kirim seusai kebijakan dari pihak supplier dari alamat pengirim sampai alamat penerima</li>
                                    <li>Biaya sudah termasuk tol, bbm dan biaya operasional lainnya</li>
                                    <li>Berat muatan truk seberapa banyak berat bahan baku yang dapat ditampung oleh truk</li>
                                </ul>
                            </caption>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>