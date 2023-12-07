            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->

        <script>
            $(document).ready(function() {
                $('.logout, .dashboardWeb, .kontenWeb, .kategoriWeb, .carouselWeb, .userWeb, .konfigurasiWeb').on('click', function() {
                    localStorage.clear();
                    $('#button-hapus').hide();
                    $('#tabUser').hide();
                    $('#logUser').hide();
                });

                function sembunyikanElement() {
                    $('.alert').animate({
                        opacity: 0
                    }, {
                        duration: 3000,
                        easing: 'easeOutBounce',
                        complete: function() {
                            $(this).remove();
                        }
                    });
                }
                $('.alert').css({
                    right: '0',
                    opacity: '1'
                });
                setTimeout(sembunyikanElement, 10000);
            });
        </script>
        <!-- jQuery -->
        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url('assets/staradmin') ?>/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?php echo base_url('assets/staradmin') ?>/js/metisMenu.min.js"></script>

        <!-- Morris Charts JavaScript -->
        <script src="<?php echo base_url('assets/staradmin') ?>/js/raphael.min.js"></script>
        <script src="<?php echo base_url('assets/staradmin') ?>/js/morris.min.js"></script>
        <script src="<?php echo base_url('assets/staradmin') ?>/js/morris-data.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="<?php echo base_url('assets/staradmin') ?>/js/startmin.js"></script>

    </body>
</html>