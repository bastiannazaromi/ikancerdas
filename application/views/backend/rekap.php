<div class="content-wrapper">
  <!-- Page Title Header Starts-->
  <div class="row page-title-header">
    <div class="col-12">
      <div class="page-header">
        <h4 class="page-title"><?= $title ;?></h4>
      </div>
    </div>    
  </div>

  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="card-body">
       <div class="table-responsive">
          <table id="example" class="table table-bordered table-hover">
            <thead class="bg-primary">
              <tr>
                <th>#</th>
                <th>Waktu</th>
                <th>Pakan</th>
                <th>Kekeruhan</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php $i = 1;
              foreach ($rekap as $hasil) : ?>
                  <tr>
                      <th><?= $i++ ?></th>
                      <td><?= date('d F Y - H:i:s', strtotime($hasil['waktu'])) ; ?></td>
                      <td><?= $hasil['pakan'] . " %" ; ?></td>
                      <td><?= $hasil['kekeruhan'] . " NTU" ; ?></td>
                      <td>
                          <a href="<?= base_url() ?>Dashboard/hapusRekap/<?= $hasil['id']; ?>" class="btn btn-danger delete-people tombol-hapus"><i class="fa fa-trash"></i> Hapus</a>
                      </td>
                  </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>       
</div>