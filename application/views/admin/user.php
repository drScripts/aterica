<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data
            <?php
            $sql = "SELECT * FROM users WHERE id='$ids'";
            $dataus = $this->db->query($sql)->row_array();
            // var_dump($dataus);
            ?>
            <?= $dataus['name']; ?>
        </h1>
    </div>


    <table class="table table-hover ">
        <tr>
            <th>Nama</th>
            <td><?= $dataus['name']; ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?= $dataus['email']; ?></td>
        </tr>
        <tr>
            <th>Tanggal Lahir</th>
            <td><?= $dataus['birth']; ?></td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td><?= $dataus['address']; ?></td>
        </tr>
        <tr>
            <th>Nomor Telepon</th>
            <td><?= $dataus['phone'] ?></td>
        </tr>
        <tr>
            <th>Instagram</th>
            <td><?= $dataus['insta']; ?></td>
        </tr>



        <?php
        $idus = $dataus['id'];
        $check = "SELECT * FROM promo_user WHERE user='$idus' ";
        $proms = $this->db->query($check)->row_array();
        $code = $proms['code_prom'];
        ?>
        <?php if ($code) : ?>
        <tr>
            <th>Code Promo</th>
            <td><?= $code; ?></td>
        </tr>
        <?php else : ?>
        <tr>
            <th>Code Promo</th>
            <td>NO PROMO</td>
        </tr>
        <?php endif; ?>




    </table>