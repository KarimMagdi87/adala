<?php $this->view('admin/header'); ?>

<?php $this->view('admin/nav'); ?>

    <!-- Page Content -->
    <div class="container">
        <div class="row formadmin">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <h1 class="text-center login-title"></h1>
                <div class="account-wall ">

                    <?php if(validation_errors() != false) { ?>
                        <div class="alert alert-warning">
                            <?php //echo validation_errors(); ?>
                            <?php echo "هذا اللأسم موجود في قاعدة البيانات , الرجاء ادخال اسم جديد"; ?>
                        </div>
                    <?php } ?>

                    <?php echo form_open('backend/execute'); ?>
                    <!--form class="form-signin"-->
                    <div class="form-group">
                        <input type="text" name="username" id="username" class="form-control" placeholder="اسم الأدمن" required autofocus>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control" placeholder="كلمة المرور" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-lg btn-primary btn-block" type="submit">تسجيل</button>
                    </div>
                    </form>

                </div>
                <!--a href="#" class="text-center new-account">تسجيل حساب جديد-- </a>
            </div>
        </div>

    </div>

<?php $this->view('admin/footer'); ?>