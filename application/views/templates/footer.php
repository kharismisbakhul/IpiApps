<!-- Footer -->
<footer class="sticky-footer bg-white" style="margin-top: 15rem">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright © <?= date('Y') ?> AKD Web Development Team. All Rights Reserved. </span>
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

<!-- Page level plugins -->
<script src="<?= base_url('assets/vendor/jquery/jquery.progresstimers.js') ?>"></script>


<!-- Sweet alert custom -->
<script src="<?= base_url('assets/') ?>js/sweet-alert.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="<?= base_url('assets/vendor/chartjs/chartjs-plugin-annotation.js') ?>"></script>
<!-- Updated -->

<script src="<?= base_url('assets/'); ?>js/inputData.js"></script>
<script src="<?= base_url('assets/'); ?>js/inputIndikator.js"></script>
<script src="<?= base_url('assets/'); ?>js/hapusIndikator.js"></script>
<script src="<?= base_url('assets/'); ?>js/hapusDatadiTahun.js"></script>

<!-- TableExport.js -->
<script src="<?= base_url('assets/'); ?>js/xlsx.core.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/Blob.js"></script>
<script src="<?= base_url('assets/'); ?>js/FileSaver.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/tableExport.js"></script>
<script src="<?= base_url('assets/'); ?>js/progressbar.min.js"></script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>

<!-- Script Modal -->

<?php if ($this->input->get('d')) : ?>
    <script src="<?= base_url('assets/'); ?>js/dimensi.js"></script>
<?php elseif ($this->input->get('sd')) : ?>
    <script src="<?= base_url('assets/'); ?>js/subdimensi.js"></script>
<?php elseif ($this->uri->segment(2) == 'ipi') : ?>
    <script src="<?= base_url('assets/'); ?>js/ipi.js"></script>
<?php elseif ($this->uri->segment(2) == 'report') : ?>
    <script src="<?= base_url('assets/'); ?>js/report.js"></script>
<?php elseif ($this->uri->segment(2) == 'export') : ?>
    <script src="<?= base_url('assets/'); ?>js/export.js"></script>
<?php elseif ($this->uri->segment(2) == null && $this->uri->segment(1) == "admin") : ?>
    <script src="<?= base_url('assets/'); ?>js/dashboard.js"></script>
<?php endif; ?>

<script src="<?= base_url('assets/'); ?>js/filter.js"></script>

</body>

</html>