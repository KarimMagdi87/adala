<?php $this->view('header'); ?>
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-md-6 col-md-offset-4">
            <h1 class="text-center login-title">Update Topic Type</h1>
            <div class="account-wall ">
                <?php if (validation_errors() != false) { ?>
                    <div class="alert alert-warning">
                        <?php echo validation_errors(); ?>
                    </div>
                <?php } ?>

                <?php echo form_open('topic-types/edit/' . $this->uri->segment(3)); ?>
                
                <div class="form-group">
                <label for="Name">Name</label>
                <input type="input" name="Name" class="form-control" value="<?php echo $Name; ?>" /><br />
                </div>
            
                <div class="form-group">
                    <label for="Color">Color</label>
                    <input type="text" name="Color" class="form-control" value="<?php echo $Color; ?>" />
                </div>
                
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-lg btn-primary btn-block" value="Update Topic Type" />
                </div>
                
                </form>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>

<?php $this->view('footer'); ?>