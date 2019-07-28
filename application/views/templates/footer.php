<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright © <?= date('Y') ?> AKD Web Development Team. All Rights Reserved. </span>
            <?= count($this->uri->segment(2))  ?>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/')  ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/')  ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/')  ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>
<script src="<?= base_url(); ?>assets/js/sweetalert2.all.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url('assets/') ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('assets/') ?>js/demo/datatables-demo.js"></script>

<!-- Sweet alert custom -->
<script src="<?= base_url('assets/') ?>js/sweet-alert.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="<?= base_url('assets/vendor/chartjs/chartjs-plugin-annotation.js') ?>"></script>
<!-- Script Modal -->


<?php if ($this->input->get('d')) : ?>
    <script src="<?= base_url('assets/'); ?>js/dimensi.js"></script>
<?php elseif ($this->input->get('sd')) : ?>
    <script src="<?= base_url('assets/'); ?>js/subdimensi.js"></script>
<?php elseif ($this->uri->segment(2) == 'ipi') : ?>
    <script src="<?= base_url('assets/'); ?>js/ipi.js"></script>
<?php elseif (count($this->uri->segment(2)) == 0) : ?>
    <script src="<?= base_url('assets/'); ?>js/script.js"></script>
<?php endif; ?>

</body>

</html>