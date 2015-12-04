<?php $this->view('backend_header'); ?>
<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">        <div class="row">
            <div class="col-sm-8 col-md-6 col-md-offset-4">
                <h1 class="text-center login-title">Create Document Type</h1>
                <div class="account-wall ">
                    <?php if(validation_errors() != false) { ?>
                        <div class="alert alert-warning">
                           <?php echo validation_errors(); ?>
                        </div>
                    <?php } ?>

                    <?php echo form_open('document-types/create'); ?>
                        <div class="form-group">
                            <label for="Name">الاسم</label>
                            <input type="text" name="Name" class="form-control" placeholder="الأسم" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="TopicTypeId">نوع الموضوع</label>
                            <select  name="TopicTypeId" class="form-control" >
                                <?php foreach ($topicTypes as $topicType) { ?>
                                    <option value="<?php echo $topicType['TopicTypeId']; ?>"><?php echo $topicType['Name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Color">اللون</label>
                            <input type="text" name="Color"  class="form-control" placeholder="اللون" />
                        </div>
                        
                        <div class="form-group">
                            <input type="submit" name="submit" value="Create Topic Type" />
                        </div>
                    </form>

                </div>
            </div>
    </div>
    <!-- /.row -->
</div>
</div>

<?php $this->view('footer'); ?>