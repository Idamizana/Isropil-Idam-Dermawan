<div id="auth">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-sm-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <img src="<?= BASE_URL ?>/assets/images/Logo9.svg" height="80" class='mb-3'>
                            <h2>Login</h2>
                            <p>Silahkan Login</p>
                        </div>
                        <?php if (isset($data['error'])) { ?>
                            <div class="alert alert-danger">
                                <?= $data['message'] ?>
                            </div>
                        <?php } ?>
                        <form action="<?= BASE_URL ?>/login" method="POST">
                            <div class="form-group position-relative has-icon-left">
                                <label for="username">Username</label>
                                <div class="position-relative">
                                    <input type="text" class="form-control" id="username" name="username" required>
                                    <div class="form-control-icon">
                                        <i data-feather="user"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group position-relative has-icon-left">
                                <div class="clearfix">
                                    <label for="password">Password</label>
                                </div>
                                <div class="position-relative">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <div class="form-control-icon">
                                        <i data-feather="lock"></i>
                                    </div>
                                </div>
                            </div>

                            <div class='form-check clearfix my-4'>
                                <div class="text-center">
                                    <a href="<?= BASE_URL ?>/register">G Punya Akun lo? Daftar</a>
                                </div>
                            </div>
                            <div class="row">
                                <button class="btn btn-primary d-block" name="submit">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>