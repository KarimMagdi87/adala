<div class="row">
    <div class="col-lg-12 text-center">
        <footer class="container">
            &copy; All rights reserved for Isys - 2015
        </footer>
    </div>
</div>
</div>

<!-- /.container -->

<!-- jQuery Version 1.11.1 -->
<script src="<?php echo base_url();?>assets/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/r/dt/dt-1.10.8/datatables.min.js"></script>

<script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>

<script type="text/javascript">
    $( document ).ready(function() {
        $('.btn').tooltip();

        $('#example').DataTable({
            language: {
                "sProcessing": "جاري التحميل...",
                "sLengthMenu": "أظهر مُدخلات _MENU_",
                "sZeroRecords": "لم يُعثر على أية سجلات",
                "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مُدخل",
                "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجلّ",
                "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                "sInfoPostFix": "",
                "sSearch": "ابحث:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "الأول",
                    "sPrevious": "السابق",
                    "sNext": "التالي",
                    "sLast": "الأخير"
                }
            }
        });
    });
    
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $(".container bcontainer").toggleClass("toggled");
    });
</script>


</body>


</html>