<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Welcome <?= $this->session->userdata('username') ?></h1>

    </div>
    <hr>
    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <a href="<?= base_url('Admin/users') ?>" style="text-decoration:none">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">
                                    Users</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">

                                    <?php
                                    if ($jumlah) {
                                        echo $jumlah;
                                    } else {
                                        $jumlah = 0;
                                        echo $jumlah;
                                    }
                                    ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <a href="<?= base_url('Admin') ?>" style="text-decoration:none">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xl font-weight-bold text-success text-uppercase mb-1">
                                    User Birthday Today</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">

                                    <?php
                                    $ult = "SELECT * FROM users";

                                    $tnggll = $this->db->query($ult)->result_array();

                                    foreach ($tnggll as $b) {
                                        date_default_timezone_set('Asia/Jakarta');
                                        $tnggllpecah = explode("-", $b['birth']);

                                        $bulan = $tnggllpecah[1];
                                        $hari = $tnggllpecah[2];
                                        $bulanskr = date("m");
                                        $hariskr = date("d");

                                        if ($bulan == $bulanskr && $hari == $hariskr) {
                                            $jumlah = $this->db->get_where('users', ['birth' => $b['birth']])->num_rows();
                                            echo $jumlah;
                                            $id = $b['id'];
                                            $updt = "UPDATE users SET birthday='YES' WHERE id='$id' ";
                                            $this->db->query($updt);
                                        } else {
                                            $id = $b['id'];

                                            $updt = "UPDATE users SET birthday='NO' WHERE id='$id' ";
                                            $this->db->query($updt);
                                        }
                                    }

                                    ?>




                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-birthday-cake fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>




    </div>
    <!-- Page Heading -->
    <?php
    $yes = "YES";
    $datas = $this->db->get_where('users', ['birthday' => $yes])->result_array();
    ?>
    <?php
    $no = 1; ?>
    <?php if ($datas) : ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Users Birthday Today</h1>

    </div>
    <hr>
    <?php foreach ($datas as $d) : ?>

    <table class="table table-bordered table-responsive-sm table-hover table-striped">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Birth</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td> <?= $no; ?> </td>
                <td><?= $d['name']; ?></td>
                <td><?= $d['email']; ?></td>
                <td><?= $d['phone']; ?></td>
                <td><?= $d['birth']; ?></td>
                <td class="text-center">
                    <a class="btn btn-success btn-sm" href="<?= base_url('Admin/event?id=' . $d['id']) ?>">
                        <i class="fas fa-birthday-cake"></i>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
    <?php
            $no++;
        endforeach; ?>
    <?php else : ?>
    <h1 class="text-center mt-5 pt-5">No Users Birthday Today</h1>
    <?php endif; ?>