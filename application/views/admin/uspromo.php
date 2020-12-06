<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Users With Promo List</h1>


    </div>
    <hr>
    <small><?= $this->session->flashdata('message') ?></small>
    <?php
    $sql = "SELECT * FROM promo_user JOIN users ON promo_user.user=users.id";
    $data = $this->db->query($sql)->result_array();

    ?>


    <?php if (!$data) : ?>
    <h1 class="text-center mt-5 pt-5">No Users With An Promo</h1>
    <?php else : ?>

    <table class="table table-bordered table-hover table-striped table-responsive-lg">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Instagram</th>
                <th>Promo Code</th>
                <th>Batas Waktu</th>
                <th>Waktu Berjalan</th>
                <th class="text-center">Action</th>

            </tr>
        </thead>
        <?php $no = 1; ?>
        <?php foreach ($data as $a) : ?>



        <tbody>
            <tr>
                <td> <?= $no; ?> </td>
                <td><?= $a['name']; ?></td>
                <td><?= $a['email']; ?></td>
                <td><?= $a['phone']; ?></td>
                <td><?= $a['insta']; ?></td>
                <td><?= $a['code_prom']; ?></td>
                <td><?= (60 * 60 * 24 * $a['lama']);  ?></td>
                <td><?= time() - $a['time'] ?></td>
                <td class="text-center">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteusprom">
                        <i class="fas fa-trash"></i>
                    </button>
                    <div class="modal fade" id="deleteusprom" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-danger" id="exampleModalLabel">Confirm Remove
                                        User Promo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are You Sure Want To Delete This User Promo?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <a href="<?= base_url('admin/deleteprom') ?>?id=<?= $a['id_prom_us'] ?>"
                                        class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-secondary btn-sm" href="<?= base_url('admin/user') ?>?id=<?= $a['id'] ?>"><i
                            class="fas fa-eye"></i></a>
                </td>
            </tr>
        </tbody>
        <?php $no++; ?>
        <?php endforeach; ?>
    </table>

    <?php endif; ?>
    <!-- Modal -->