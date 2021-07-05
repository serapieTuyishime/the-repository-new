    <!-- Footer -->
    <footer class="footer pt-0 container-fluid ">
      <div class="row align-items-center justify-content-lg-between">
        <div class="col-lg-6">
          <div class="copyright text-center  text-lg-left  text-muted">
            &copy; 2020 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
          </div>
        </div>
        <div class="col-lg-6">
          <ul class="nav nav-footer justify-content-center justify-content-lg-end">
            <li class="nav-item">
              <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
            </li>
            <li class="nav-item">
              <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
            </li>
            <li class="nav-item">
              <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
            </li>
            <li class="nav-item">
              <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
            </li>
          </ul>
        </div>
      </div>
    </footer>
</div>
        <script src="<?php echo base_url(); ?>assets/vendor/jquery/dist/jquery.min.js"></script>

		<script>
                // CKEDITOR.replace( 'editor1' );
                $(document).ready(function() {
                    $('#dataTable').DataTable( {
                        dom: 'Bfrtip',
                        buttons:
                        [
                            'copy', 'csv', 'excel', 'print'
                        ]
                    } );
                } );
                $(document).ready(function() {
                    $('#dataTable1').DataTable( {
                        dom: 'Bfrtip',
                        buttons:
                        [

                        ],
                    } );
                } );
            </script>
            <script type="text/javascript">
                $('a[href]').each(function()
                {
                    if ($(this).attr('href')==window.location.pathname||$(this).attr('href')==window.location.href) {
                        $(this).addClass('active');
                    }
                });
            </script>

        <!-- Argon Scripts -->
        <!-- Core -->
        <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/vendor/js-cookie/js.cookie.js"></script>
        <script src="<?php echo base_url(); ?>assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
        <!-- Optional JS -->
        <script src="<?php echo base_url(); ?>assets/vendor/chart.js/dist/Chart.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/vendor/chart.js/dist/Chart.extension.js"></script>

        <script src="<?php echo base_url(); ?>assets/js/argon.js?v=1.2.0"></script>




        <!-- all datatables plugins -->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datatables/jquery.dataTables.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datatables/dataTables.bootstrap4.js"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datatables/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datatables/buttons.flash.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datatables/jszip.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datatables/pdfmake.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datatables/vfs_fonts.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datatables/buttons.print.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datatables/buttons.html5.min.js"></script>
        <!-- Argon JS -->

        <!-- from the makers of the homepage -->
        <script src="<?php echo base_url(); ?>assets/js/modernizr-2.6.2-respond-1.1.0.min.js"></script>

        <!-- form validations -->
    	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>
    	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/form-validation-script.js"></script>

	</body>
</html>
