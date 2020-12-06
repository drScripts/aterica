<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Admins List</h1>


    </div>
    <hr>

    <table class="table table-bordered table-striped table-hover table-responsive-sm">
        <?php

        $sql = "SELECT * FROM admin";
        $data = $this->db->query($sql)->result_array();
        $no = 1;
        ?>
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Email</th>


            </tr>
        </thead>
        <?php foreach ($data as $u) : ?>
        <tbody>
            <tr>
                <td><?= $no; ?></td>
                <td><?= $u['username']; ?></td>
                <td><?= $u['email']; ?></td>

            </tr>
        </tbody>
        <?php $no++ ?>
        <?php endforeach; ?>
    </table>

    <!-- Button trigger modal -->