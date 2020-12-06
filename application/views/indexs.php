<body>
    <div class="row fixed-top mt-4 mr-3">
        <div class="col-3 ml-auto">
            <a class="nav-link bg-primary btn text-light" href="<?= base_url('check') ?>">Check Your
                Code!</span></a>
        </div>
    </div>
    <div class="container idiw">

        <!-- Outer Row -->
        <div class="row justify-content-center my-5">

            <div class="col-lg-9">

                <div class="card o-hidden border-0 shadow-lg my-5 animate__zoomInRight">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 mb-4 wadwa animate__backInUp" style="color:white">Masukan Data
                                            Diri
                                            Anda</h1>
                                    </div>
                                    <form class="user" method="post" action="<?= base_url('Profile/check') ?>">
                                        <div class=animate__rotateInDownRight form-group">
                                            <label for="nama"><strong>*Masukan Nama Lengkap Anda</strong></label>
                                            <input type="text" id="nama" class="form-control form-control-user"
                                                placeholder="Your Full Name" name="name"
                                                value="<?= set_value('name') ?>">
                                            <?= form_error('name', '<small class="text-danger pl-3">', '</small>') ?>
                                        </div>
                                        <div class=animate__rotateInDownLeft form-group">
                                            <label for="email"><strong>*Masukan EMAIL Anda</strong></label>
                                            <input type="email" id="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Your Email Address..." name="email"
                                                value="<?= set_value('email') ?>">
                                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                                        </div>
                                        <div class=" form-group animate__rotateInDownRight">
                                            <label for="ultah"><strong>*Masukan Tanggal Lahir Anda</strong></label>
                                            <input type="date" id="ultah" class="form-control form-control-user"
                                                placeholder="Birth day date" name="birth"
                                                value="<?= set_value('birth') ?>">
                                            <?= form_error('birth', '<small class="text-danger pl-3">', '</small>') ?>
                                        </div>
                                        <div class=" form-group animate__rotateInDownLeft">
                                            <label for="alamat"><strong>*Masukan Alamat Lengkap Anda</strong></label>
                                            <textarea name="address" id="alamat" rows="5" placeholder="Your Address"
                                                class="form-control"><?= set_value('address') ?></textarea>
                                            <?= form_error('address', '<small class="text-danger pl-3">', '</small>') ?>
                                        </div>
                                        <div class="form-group animate__rotateInDownRight">
                                            <label for="nomor"><strong>*Masukan Nomor Telp/WA Anda</strong></label>
                                            <input type="number" id="nomor" class="form-control form-control-user"
                                                name="phone" placeholder="Your Phone Number"
                                                value="<?= set_value('phone') ?>">
                                            <?= form_error('phone', '<small class="text-danger pl-3">', '</small>') ?>
                                        </div>
                                        <div class=" mb-5 form-group animate__rotateInDownLeft">
                                            <label for="nomor"><strong>*Masukan Username Instagram Anda</strong></label>
                                            <input type="text" class="form-control form-control-user"
                                                placeholder="Your Instagram Username" name="insta"
                                                value="<?= set_value('insta') ?>">
                                            <?= form_error('insta', '<small class="text-danger pl-3">', '</small>') ?>
                                        </div>
                                        <div class=" row">
                                            <div class="col-lg-5 mx-auto">

                                                <button type="submit"
                                                    class="mt-5 animate__rotateInDownRight btn btn-primary btn-user btn-block">
                                                    Proses!
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <div class="row fixed-bottom">
        <div class="col-4">
            <a class="nav-link  btn text-light" href="https://instagram.com/_aterica_?igshid=10hrmtovf53y7"><img
                    src="<?= base_url('assets/img/instagram.png') ?>" alt="" width="50px"></span></a>
        </div>
        <div class="col-4">
            <a class="nav-link  btn text-light"
                href="https://www.tokopedia.com/arterica?utm_medium=Share&utm_campaign=Shop%20Share&utm_source=Desktop"><img
                    src="<?= base_url('assets/img/tokopedia.png') ?>" alt="" width="50px"></span></a>

        </div>
        <div class="col-4">
            <a class="nav-link  btn text-light" href="https://shopee.co.id/atericajewerly?smtt=0.0.9"><img
                    src="<?= base_url('assets/img/shopee-bag.png') ?>" alt="" width="50px"></span></a>
        </div>
    </div>