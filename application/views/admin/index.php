<?php $this->view('admin/header'); ?>

<!-- Page Content -->
<div class="container">
    <div class="row formadmin">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <h1 class="text-center login-title"></h1>
                <div class="account-wall ">

                    <?php if(validation_errors() != false) { ?>
                        <div class="alert alert-warning">
                            <strong>Warning!</strong> <?php echo validation_errors(); ?>
                        </div>
                    <?php } ?>

                    <?php echo form_open('admin/login'); ?>
                    <!--form class="form-signin"-->
                        <div class="form-group">
                           <input type="text" name="username" id="username" class="form-control" placeholder="اسم الأدمن" required autofocus>
                        </div>
                        <div class="form-group">
                           <input type="password" name="password" id="password" class="form-control" placeholder="كلمة المرور" required>
                        </div>
                        <div class="form-group">
                        <button class="btn btn-lg btn-primary btn-block" type="submit">دخول</button>
                        </div>
                    </form>

                </div>
                <a href="#" class="text-center new-account">تسجيل حساب أدمن جديد </a>
            </div>
    </div>

    <!-- /.row -->

</div>

<?php $this->view('admin/footer'); ?>