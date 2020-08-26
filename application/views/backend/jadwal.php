<div class="content-wrapper">
  <!-- Page Title Header Starts-->
    <div class="row page-title-header">
        <div class="col-12">
            <div class="page-header">
                <h4 class="page-title"><?= $title ;?></h4>
            </div>
        </div>    
    </div>

    <div class="row">
        <div class="col-lg-12 col-5 text-right mb-3">
            <button type="button" class="btn btn-sm btn-warning float-right" data-toggle="modal" data-target="#modalEdit"><i class="fas fa-edit"></i> Edit Jadwal</button>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="row">

                <div class="col-md-4 grid-margin stretch-card bg-primary">
                    <div class="card"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                        <div class="card-body pb-0">
                            <div class="d-flex justify-content-between mb-3">
                                <h4 class="card-title mb-0">Pagi</h4>
                                <div class="bg-light">
                                    <i class="far fa-clock fa-2x"></i>
                                </div>
                            </div>
                            <h3 class="font-weight-medium mb-4"><?= $jadwal[0]['pagi'] . ".00" ; ?></h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 grid-margin stretch-card bg-danger">
                    <div class="card"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                        <div class="card-body pb-0">
                            <div class="d-flex justify-content-between mb-3">
                                <h4 class="card-title mb-0">Siang</h4>
                                <div class="bg-light">
                                    <i class="far fa-clock fa-2x"></i>
                                </div>
                            </div>
                            <h3 class="font-weight-medium mb-4"><?= $jadwal[0]['siang'] . ".00" ; ?></h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 grid-margin stretch-card bg-dark">
                    <div class="card"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                        <div class="card-body pb-0">
                            <div class="d-flex justify-content-between mb-3">
                                <h4 class="card-title mb-0">Sore</h4>
                                <div class="bg-light">
                                    <i class="far fa-clock fa-2x"></i>
                                </div>
                            </div>
                            <h3 class="font-weight-medium mb-4"><?= $jadwal[0]['sore'] . ".00" ; ?></h3>
                        </div>
                    </div>
                </div>
        
            </div>
        </div>
    
    </div>

</div>

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('Dashboard/editJadwal'); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pagi">Pagi</label>
                        <select class="custom-select" id="inputGroupSelect02" name="pagi">
                          <option value="">-- Jam --</option>
                          <?php for ($i=6; $i<=10; $i++) : ?>
                            {
                                <option value="<?= $i ; ?>" <?php if ($jadwal[0]['pagi'] == $i) echo 'selected="selected"' ;?>><?= $i ; ?></option>
                            }
                          <?php endfor ; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="siang">Siang</label>
                        <select class="custom-select" id="inputGroupSelect02" name="siang">
                          <option value="">-- Jam --</option>
                          <?php for ($i=11; $i<=14; $i++) : ?>
                            {
                                <option value="<?= $i ; ?>" <?php if ($jadwal[0]['siang'] == $i) echo 'selected="selected"' ;?>><?= $i ; ?></option>
                            }
                          <?php endfor ; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sore">Sore</label>
                        <select class="custom-select" id="inputGroupSelect02" name="sore">
                          <option value="">-- Jam --</option>
                          <?php for ($i=15; $i<=18; $i++) : ?>
                            {
                                <option value="<?= $i ; ?>" <?php if ($jadwal[0]['sore'] == $i) echo 'selected="selected"' ;?>><?= $i ; ?></option>
                            }
                          <?php endfor ; ?>
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="add" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>