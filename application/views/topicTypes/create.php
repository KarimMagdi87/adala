<?php $this->view('backend_header'); ?>
<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">    <div class="row">
        <div class="col-sm-8 col-md-6 col-md-offset-4">
            <h1 class="text-center login-title">Create Topic Type</h1>
            <div class="account-wall ">
                <?php if (validation_errors() != false) { ?>
                    <div class="alert alert-warning">
                        <?php echo validation_errors(); ?>
                    </div>
                <?php } ?>
                <?php echo validation_errors(); ?>

                <?php echo form_open('topic-types/create'); ?>

                <div class="form-group">
                    <label for="Name">Name</label>
                    <input type="input" class="form-control" name="Name" /><br />
                </div>
                
                <div class="form-group">
                    <label for="Color">Color</label>
                    <textarea name="Color" class="form-control"></textarea><br />
                </div>
                
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-lg btn-primary btn-block" value="Create Topic Type" />
                </div>
                
                </form>

            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
</div>
<?php $this->view('footer'); ?>