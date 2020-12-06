<div class="container">
    <div class="row atas" id="row">
        <div class="col-lg-9 mx-auto">
            <div class="card text-center">

                <div class="card-body">
                    <h1>Hello, <?= $email; ?></h1>
                    <h2>Code Promo Anda Adalah <?= $code; ?></h2>
                    <h3>Dengan Promo ( <?= $keterangan; ?>)</h3>
                    <a href="<?= base_url('assets/promo/') . $foto ?>"><img
                            src="<?= base_url('assets/promo/') . $foto ?>" alt="<?= $keterangan ?>"
                            class="img-fluid img-thumbnail"></a>

                    <h4>Untuk Cara penggunaanya Silahkan ScreenShoot dan Berikan ScreenShootnya ke Admin Lewat DM Yah!
                    </h4>
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