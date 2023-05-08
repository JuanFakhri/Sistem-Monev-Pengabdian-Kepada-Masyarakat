<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <?php
            if (session()->get('err')) {
                echo "<div class='alert alert-danger p-0 pt-2' role='alert'>" . session()->get('err') . "</div>";
            }
            ?>
        </div>
    </div>
    <!-- Page Heading -->
    <div class="d-flex pl-0 mb-3">
        <i class="icon fa fa-book-reader"></i>
        <div>
            <h4>Data Penelitian</h4>
            <p class="mg-b-0">Olah Data Penelitian</p>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-md">

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">

                        <i class="fa fa-plus"> Tambah Data</i>
                    </button>
                </div>
                <?php if (session()->get('message')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        Data Siswa Berhasil <strong><?= session()->getFlashdata('message');  ?></strong>
                    </div>

                    <script>
                        $(".alert").alert();
                    </script>
                <?php endif; ?>
                <div class="col-md">
                    <button type="button" class="btn btn-outline-secondary float-right ml-2">
                        <i class="fa fa-print"> Print</i>
                    </button>
                    <a href="backend/excel" class="btn btn-outline-danger float-right">Excel <i class="fa fa-file-excel"></i></a>
                </div>

            </div>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" name="keyword">
                <div class="col-md">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"> Search</i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            <tr>
                                <th>No</th>
                                <th>NISN</th>
                                <th>NAMA</th>
                                <th>Opsi</th>
                            </tr>

                            </tr>
                        </thead>
                        <tbody><?php $i = 1;  ?>
                            <?php foreach ($siswa as $row) : ?>
                                <tr>
                                    <td scope="row"><?= $i++;  ?></td>
                                    <td><?= $row['nisn'];  ?></td>
                                    <td><?= $row['nama'];  ?></td>
                                    <?php if (allow('3')) : ?>
                                        <td>
                                            <button type="button" data-toggle="modal" data-target="#modalUbah" class="btn btn-sm btn-warning" id='btn-edit' data-id="<?= $row['id'];  ?> " data-nisn="<?= $row['nisn'];  ?> " id='btn-panel' data-id="<?= $row['id'];  ?> " data-nama="<?= $row['nama'];  ?> "><i class="fas fa-edit"></i></button>

                                            <button type="button" data-toggle="modal" data-target="#modalHapus" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    <?php endif; ?>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


<!-- Modal -->
<div class="modal fade" id="modalTambah">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah <?= $judul;  ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="<?= base_url("backend/tambah_data");  ?>" method="post">
                    <div class="form-group mb-0">
                        <label for="">NISN</label>
                        <input type="text" name="nisn" id="nisn" class="form-control" placeholder="Masukan NISN">
                    </div>
                    <div class="form-group mb-0">
                        <label for="">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukan Nama Siswa">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="tambah" class="btn btn-primary">Tambah Data</button>
            </div>
            </form>

        </div>
    </div>
</div>


<!-- Modal Hapus data-->
<div class="modal fade" id="modalHapus">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Apakah anda yakin ingin menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                <a href="backend/hapus/<?= $row['id'];  ?>" class="btn btn-primary">Yes </a>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalUbah">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah <?= $judul;  ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="<?= base_url("backend/ubah_data");  ?>" method="post">

                    <input type="text" name="id" id="id-siswa">
                    <div class="form-group mb-0">
                        <label for="">NISN</label>
                        <input type="text" name="NISN" id="NISN" class="form-control" placeholder="Masukan NISN">
                    </div>
                    <div class="form-group mb-0">
                        <label for="">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukan Nama Siswa">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="ubah" class="btn btn-primary">Ubah Data</button>
            </div>
            </form>

        </div>
    </div>
</div>