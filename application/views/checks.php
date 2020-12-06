<div class="container">
    <div class="row atas" id="row">
        <div class="col-lg-6 mx-auto">
            <div class="card text-center">

                <div class="card-body">
                    <small><?= $this->session->flashdata('message') ?></small>
                    <form action="<?= base_url('check/search') ?>" method="post">
                        <div class="form-group">
                            <label for="email">*Masukan Email Anda</label>
                            <input type="text" name="email" id="email" class="form-control"
                                placeholder="maskan email anda yang valid">
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="cupon">*CUPON CODE</label>
                            <input type="text" name="cupon" id="cupon" class="form-control"
                                placeholder="masukan code cupon">
                            <?= form_error('cupon', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i>Search</button>
                        </div>
                    </form>
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