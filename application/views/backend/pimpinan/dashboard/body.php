<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-1 text-dark"><span class="nav-icon bx bx-fw bx-grid-alt"></span>Dashboard</h1>
                </div>
                <div class="col-sm-6 float-sm-right">
                    <ol class="breadcrumb float-sm-right m-2">
                        <span class="breadcrumb-item active">Dashboard</span>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <section class="content">
        <div class="container-fluid">         
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Stok Bahan Baku Akan Habis</h3>
                </div>
                <div class="card-body">
                    <table style="width:100%" id="dataTable1" class="table table-bordered table-striped">
                    <caption></caption>
                        <thead>
                            <tr>
                                <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Kode</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Nama</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Kategori</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Supplier</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Harga (Rp.)</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Stok Gudang</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Stok Limit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                foreach($bahan_baku->result() as $row) {
                                    if($row->stok_gudang_pab_bb <= $row->stok_limit_pab_bb + 20){
                            ?>
                            <tr>
                                <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_bb;?></td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_bb;?></td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_kategori;?></td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_supplier;?></td>
                                <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->harga_bb, 0, ".", ".");?></td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo number_format($row->stok_gudang_pab_bb,2,",",".")." ".$row->nama_satuan;?></td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo number_format($row->stok_limit_pab_bb,2, ",", ".")." ".$row->nama_satuan;?></td>
                            </tr>
                            <?php 
                                    $no++; 
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Stok Produk Akan Habis</h3>
                </div>
                <div class="card-body">
                    <table style="width:100%" id="dataTable1" class="table table-bordered table-striped">
                    <caption></caption>
                        <thead>
                            <tr>
                                <th id="" style="text-align: center; vertical-align: middle; width:3%">No.</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Kode</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Nama</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Kategori</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Harga (Rp.)</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Stok Gudang</th>
                                <th id="" style="text-align: center; vertical-align: middle; ">Stok Limit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                foreach($produk->result() as $row) {
                                    if($row->stok_gudang_produk <= $row->stok_limit_produk + 20){
                            ?>
                            <tr>
                                <td style="text-align: center; vertical-align: middle;"><?php echo $no;?></td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo $row->kode_produk;?></td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_produk;?></td>
                                <td style="text-align: left; vertical-align: middle;"><?php echo $row->nama_kategori;?></td>
                                <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->harga_produk, 0, ".", ".");?></td>
                                <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->stok_gudang_produk, 0, ".", ".");?></td>
                                <td style="text-align: right; vertical-align: middle;"><?php echo number_format($row->stok_limit_produk, 0, ".", ".");?></td>
                            </tr>
                            <?php 
                                    $no++; 
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Grafik Transaksi Bahan Baku</h3>
                </div>
                <div class="card-body">
                    <select class="form-control kode_bb col-3" id="kode_bb">
                        <option value="">Pilih Bahan Baku</option>
                        <?php foreach($bahan_baku->result() as $row){ ?>
                            <option value="<?php echo $row->kode_bb; ?>"><?php echo $row->kode_bb." - ".$row->nama_bb; ?></option>
                        <?php } ?>
                    </select>
                    <div class="chart mt-2" style="min-height: 400px; height: 400px; max-height: 400px; max-width: 100%;">
                        <canvas id="chart_bahan_baku"><canvas id="chart"></canvas></canvas>       
                    </div>                      
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Grafik Transaksi Produk</h3>
                </div>
                <div class="card-body">
                    <select class="form-control kode_produk col-3" id="kode_produk">
                        <option value="">Pilih Produk</option>
                        <?php foreach($produk->result() as $row){ ?>
                            <option value="<?php echo $row->kode_produk; ?>"><?php echo $row->kode_produk." - ".$row->nama_produk; ?></option>
                        <?php } ?>
                    </select>
                    <div class="chart mt-2" style="min-height: 400px; height: 400px; max-height: 400px; max-width: 100%;">
                        <canvas id="chart_produk"></canvas>   
                    </div>                      
                </div>
            </div>
        </div>
    </section>   
</div> 

