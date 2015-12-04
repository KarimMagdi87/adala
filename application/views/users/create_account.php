<?php $this->view('backend_header'); ?>
<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <h1 class="text-center login-title"></h1>
                <div class="account-wall ">

                    <?php if(validation_errors() != false) { ?>
                        <div class="alert alert-warning">
                            <?php echo validation_errors(); ?>
                        </div>
                    <?php } ?>

                    <?php echo form_open('users/execute'); ?>
                        <div class="form-group">
                            <input type="text" name="username" id="username" class="form-control" placeholder="اسم الأدمن" required autofocus>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="كلمة المرور" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="sdate" name="sdate" class="form-control" placeholder="تاريخ البدء"  required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="edate" name="edate" class="form-control" placeholder="تاريخ الانتهاء"  required>
                        </div>
                        <div class="form-group">
                            <label><input id="bulk" name="bulk" type="checkbox" value="">مجموعات</label>
                        </div>
                       <div id="numtag">
                           <!--div class="form-group">
                               <input type="number" id="accnumber" name="accnumber" class="form-control" placeholder="عدد التسجيلات"  required>
                           </div>
                           <div class="form-group">
                               <input type="tag" id="tag" name="tag" class="form-control" placeholder="التصنيف"  required>
                           </div-->
                       </div>
                        <div class="form-group">
                            <button class="btn btn-lg btn-primary btn-block" type="submit">تسجيل</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>


</div>


<?php $this->view('footer'); ?>

<script type="text/javascript">
    $(function() {
        $("#sdate").datepicker();
        $("#edate").datepicker();

        var inputsBulk = '<div class="form-group">'+
                         '<input type="number" id="accnumber" name="accnumber" class="form-control" placeholder="عدد التسجيلات"  required>'+
                         '</div>'+
                         '<div class="form-group">'+
                         '<input type="tag" id="tag" name="tag" class="form-control" placeholder="التصنيف"  required>'+
                         '</div>';

        $('#bulk').click(function() {
            $("#numtag").append(inputsBulk);
            $("#numtag").toggle(this.checked);
        });
    });
</script>
