<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Send a Promo To Your User! (With Email)</h1>
    </div>
    <hr class="mb-5">
    <small><?= $this->session->flashdata('message') ?></small>

    <form action="<?= base_url('admin/sende') ?>" method="post" enctype="multipart/form-data">
        <div class="col-lg-6 mx-auto">
            <div class="form-group">
                <label for="user">
                    <ah class="text-danger">*</ah> Kepada Siapa Anda Ingin Mengirim (email)
                </label>
                <?php

                if ($ids) {
                    $sql = "SELECT * FROM users WHERE id='$ids' ";
                    $akoh = $this->db->query($sql)->row_array();
                } else {
                    $sql = "SELECT * FROM users";
                    $datas = $this->db->query($sql)->result_array();
                }


                ?>
                <select name="users" id="user" class="form-control">

                    <?php if ($akoh) : ?>

                    <option value="<?= $akoh['id'] ?>" aria-readonly="true"><?= $akoh['email']; ?></option>
                    <?php endif; ?>



                    <?php if ($datas) : ?>
                    <option value="" aria-readonly="true">-- Select User --</option>


                    <?php foreach ($datas as $a) : ?>
                    <option value="<?= $a['id'] ?>"><?= $a['email']; ?></option>
                    <?php endforeach; ?>
                    <?php else : ?>
                    <option value="" aria-readonly="true">-- Ga Ada User --</option>

                    <?php endif; ?>
                </select>
                <?= form_error('users', '<small class="text-danger pl-3">*', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="keterangan">
                    <ah class="text-danger">*</ah>Keterangan Kupon
                </label>
                <input type="text" class="form-control" name="ket" id="keterangan" placeholder="Keterangan Kupon">
                <?= form_error('ket', '<small class="text-danger pl-3">*', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="promo">
                    <ah class="text-danger">*</ah>Nama Promo (singkat aja)
                </label>
                <input type="text" name="promo" class="form-control" id="promo" placeholder="Nama Promo">
                <?= form_error('promo', '<small class="text-danger pl-3">*', '</small>') ?>

            </div>
            <div class="form-group">
                <label for="subjek">
                    <ah class="text-danger">*</ah>Subject (email)
                </label>
                <input type="text" class="form-control" name="sub" id="subjek" placeholder="Subject pada email">
                <?= form_error('sub', '<small class="text-danger pl-3">*', '</small>') ?>

            </div>
            <div class="form-group">
                <label for="lama">
                    <ah class="text-danger">*</ah>Lama Promo Berjalan(hari)
                </label>
                <input type="text" class="form-control" name="lama" id="lama" min=" 1" value="1">
                <?= form_error('lama', '<small class="text-danger pl-3">*', '</small>') ?>

            </div>
            <div class="form-group">
                <label for="pesan">
                    <ah class="text-danger">*</ah>Pesan Email
                </label>
                <textarea class="form-control" name="pes" id="pesan" cols="30" rows="5"
                    placeholder="Pesan Email"></textarea>
                <?= form_error('pes', '<small class="text-danger pl-3">*', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="foto">
                    <ah class="text-danger">*</ah>Foto Promo
                </label>
                <input type="file" id="foto" name="fpro" class="form-control-file" required>
                <?= form_error('fpro', '<small class="text-danger pl-3">*', '</small>') ?>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary">Kirim!</button>
            </div>

        </div>
    </form>