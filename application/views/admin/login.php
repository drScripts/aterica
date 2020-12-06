<body>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-lg-5 my-5">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 mb-4">Aterica Admin Login!</h1>
                                        <hr>
                                    </div>
                                    <small><?= $this->session->flashdata('message') ?></small>
                                    <form class="user" method="post" action="<?= base_url('Auth');  ?>">
                                        <div class="form-group">
                                            <label for="email"><small><strong>*Masukan Email Anda!
                                                    </strong></small></label>
                                            <input type="email" class="form-control form-control-user" id="email"
                                                name="email" placeholder="Enter Email Address..."
                                                value="<?= set_value('email') ?>">
                                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="pass"><small><strong>*Masukan Password Anda!
                                                    </strong></small></label>
                                            <input type="password" class="form-control form-control-user" id="pass"
                                                placeholder="Password" name="pass">
                                            <?= form_error('pass', '<small class="text-danger pl-3">', '</small>') ?>
                                        </div>
                                        <div class="row">
                                            <div class="col-7 mx-auto">
                                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                                    Login
                                                </button></div>
                                        </div>
                                    </form>
                                    <hr>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>