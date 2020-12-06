 <!-- Bootstrap core JavaScript-->
 <script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>

 <script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

 <!-- Core plugin JavaScript-->
 <script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

 <!-- Custom scripts for all pages-->
 <script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>
 <script src="<?= base_url('assets/') ?>js/script.js"></script>


 <script type="text/javascript">
// 1 detik = 1000 
window.setTimeout("waktu()", 1000);

function waktu() {
    var tanggal = new Date();
    setTimeout("waktu()", 1000);
    document.getElementById("output").innerHTML = tanggal.getHours() + ":" + tanggal.getMinutes() + ":" + tanggal
        .getSeconds();
}
 </script>
 </body>

 </html>