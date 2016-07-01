        <div class="footer">
            
            <div>
                <strong>Copyright</strong> Castiko Agile &copy; <?= date('Y')?>
            </div>
        </div>

        </div>
    </div>
    <script type="text/javascript">
        var base_url = '<?= base_url() ?>';
    </script>
    <!-- Mainly scripts -->
    <script src="<?= ADMIN ?>/js/jquery-2.1.1.js"></script>
    <script src="<?= ADMIN ?>/js/jquery-ui-1.11.4.min.js"></script>
    <script src="<?= ADMIN ?>/js/bootstrap.min.js"></script>
    <script src="<?= ADMIN ?>/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?= ADMIN ?>/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="<?= ADMIN ?>/js/plugins/flot/jquery.flot.js"></script>
    <script src="<?= ADMIN ?>/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="<?= ADMIN ?>/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="<?= ADMIN ?>/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="<?= ADMIN ?>/js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="<?= ADMIN ?>/js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="<?= ADMIN ?>/js/plugins/flot/curvedLines.js"></script>

    <!-- Peity -->
    <script src="<?= ADMIN ?>/js/plugins/peity/jquery.peity.min.js"></script>
	
	<script src="<?= ADMIN ?>/js/plugins/sweetalert/sweetalert.min.js"></script>

    <script src="<?= ADMIN ?>/js/plugins/tag/tags.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?= ADMIN ?>/js/inspinia.js"></script>
	<script src="<?= ADMIN ?>/js/custom.js"></script>
    <script src="<?= ADMIN ?>/js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="<?= ADMIN ?>/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Jvectormap -->
    <script src="<?= ADMIN ?>/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="<?= ADMIN ?>/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- footable -->
    <script src="<?= ADMIN ?>/js/plugins/footable/footable.all.min.js"></script>

    <!-- Sparkline -->
    <script src="<?= ADMIN ?>/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="<?= ADMIN ?>/js/demo/sparkline-demo.js"></script>
	
	<!-- iCheck -->
    <script src="<?= ADMIN ?>/js/plugins/iCheck/icheck.min.js"></script>

    <!-- ChartJS-->
    <script src="<?= ADMIN ?>/js/plugins/chartJs/Chart.min.js"></script>
	<script src="<?= ADMIN ?>/js/plugins/summernote/summernote.min.js"></script>

    

    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });


            $('.summernote').summernote();

        });
        var edit = function() {
            $('.click2edit').summernote({focus: true});
        };
        var save = function() {
            var aHTML = $('.click2edit').code(); //save HTML If you need(aHTML: array).
            $('.click2edit').destroy();
        };

    </script>
    <script>
       $('.footable').footable();

    </script>
</body>
</html>