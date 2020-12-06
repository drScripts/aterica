<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Users List</h1>


    </div>
    <hr>

    <?php

    $sql = "SELECT * FROM users";
    $data = $this->db->query($sql)->result_array();
    $no = 1;
    ?>
    <?php if (!$data) : ?>
    <h1 class="text-center" style="margin-top:20%">Ga Ada User Nih Promotin Gih</h1>
    <?php else : ?>
    <table class="table table-bordered table-striped table-hover table-responsive-lg">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Email</th>
                <th>Birth</th>
                <th>Telp.</th>
                <th>Stat</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <?php foreach ($data as $u) : ?>
        <tbody>
            <tr>
                <td><?= $no; ?></td>
                <td><?= $u['name']; ?></td>
                <td><?= $u['email']; ?></td>
                <td><?= $u['birth']; ?></td>
                <td><?= $u['phone']; ?></td>
                <td><?= $u['birthday']; ?></td>
                <td class="text-center">
                    <div class="row">
                        <div class="col-md-6 mt-1">
                            <a href="<?= base_url('admin/user?') ?>id=<?= $u['id'] ?>"
                                class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i></a>
                        </div>
                        <?php if ($u['birthday'] == 'YES') : ?>
                        <div class="col-md-6 mt-1">
                            <a href="<?= base_url('admin/birthday?') ?>id=<?= $u['id'] ?>"
                                class="btn btn-success btn-sm"><i class="fas fa-birthday-cake"></i></a>
                        </div>
                        <?php endif; ?>

                    </div>
                </td>
            </tr>
        </tbody>
        <?php $no++ ?>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>