<body>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-lg-7 my-5">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-light mb-4">Aterica Admin Register!</h1>
                                    </div>
                                    <form class="user" method="post" action="<?= base_url('Auth/regis');  ?>">
                                        <div class="form-group">
                                            <label for="name"><small><strong>*Masukan Email Anda!
                                                    </strong></small></label>
                                            <input type="text" class="form-control form-control-user" id="name"
                                                placeholder="Enter Your Username As Admin..." name="name"
                                                value="<?=
                                                                                                                                                                                        set_value('name') ?>">
                                            <?= form_error('name', '<small class="text-danger pl-3">', '</small>') ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="email"><small><strong>*Masukan Email Anda!
                                                    </strong></small></label>
                                            <input type="email" class="form-control form-control-user" id="email"
                                                placeholder="Enter Email Address..." name="email"
                                                value="<?= set_value('email') ?>">
                                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="pass1"><small><strong>*Masukan Password Anda!
                                                            </strong></small></label>
                                                    <input type="password" class="form-control form-control-user"
                                                        id="pass1" placeholder="Your Password" name="pass1">
                                                    <?= form_error('pass1', '<small class="text-danger pl-3">', '</small>') ?>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="pass2"><small><strong>*Masukan Ulang Password Anda!
                                                            </strong></small></label>
                                                    <input type="password" class="form-control form-control-user"
                                                        id="pass2" placeholder="Confirm Your Password" name="pass2">
                                                    <?= form_error('pass2', '<small class="text-danger pl-3">', '</small>') ?>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <div class="row">
                                            <div class="col-md-9 mx-auto">
                                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                                    Register!
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('Auth') ?>">Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>