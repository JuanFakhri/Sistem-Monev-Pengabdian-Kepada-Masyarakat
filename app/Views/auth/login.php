<?= $this->extend('auth/templates/index');  ?>

<?= $this->section('content');  ?>

<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-body">
                                <form action="auth/get_login" method="POST">
                                    <!-- Nested Row within Card Body -->
                                    <div class=" col-lg">
                                        <div class="p-4">
                                            <div class="text-center">
                                                <h1 class="h3 text-gray-800 mb-3">Sistem Monitoring dan Evaluasi Pengabdian kepada Masyarakat</h1>
                                            </div>
                                            <hr>
                                            <div class="text-center">
                                                <h2 class="h5 text-gray-900 mb-4">Silahkan Login Terlebih Dahulu</h2>

                                            </div>
                                            <form action="" method="POST" class="user">
                                                <?= session()->get('pesan');  ?>
                                                <div class="form-group">

                                                    <label for="user">Username</label>
                                                    <input type="text" name="username" id="username" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Username...">
                                                </div>
                                                <div class="form-group">

                                                    <label for="pass">Password</label>
                                                    <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password...">
                                                </div>

                                                <div class="form-label-group">
                                                    <label for="aks">Login sebagai</label>
                                                    <select class="form-control" name="akses" id="akses">
                                                        <option value="1">Fakultas Ekonomi dan Bisnis</option>
                                                        <option value="2">Fakultas Agama Islam</option>
                                                        <option value="3">Fakultas Teknik</option>
                                                        <option value="4">Fakultas Ilmu Pendidikan dan Humaniora</option>
                                                        <option value="5">Admin</option>
                                                    </select>

                                                    <label for=""> </label>
                                                </div>
                                                <div class="form-group">
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-user btn-block">login</button>

                                            </form>
                                            <hr>
                                            <div class="text-center">
                                                <a class="small" href="register">Create an Account!</a>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="layoutAuthentication_footer">
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Pengabdian kepada Masyarakat</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<?= $this->endSection();  ?>