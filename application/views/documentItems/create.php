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

                    <?php echo form_open('document-items/create'); ?>
                        <div class="form-group">
                            <label for="DocumentId">الملف</label>
                            <select  name="DocumentId" class="form-control" required >
                                <?php foreach ($documents as $document) { ?>
                                    <option value="<?php echo $document['DocumentId']; ?>"><?php echo $document['Title'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ParentItemId">نوع الموضوع</label>
                            <select  name="ParentItemId" class="form-control" required >
                                <?php foreach ($parentItems as $parentItem) { ?>
                                    <option value="<?php echo $parentItem['DocumentItemId']; ?>"><?php echo $parentItem['Title'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Title">العنوان</label>
                            <input type="text" name="Title"  class="form-control" placeholder="العنوان" />
                        </div>
                        <div class="form-group">
                            <label for="Text">المحتوى</label>
                            <input type="text" name="Text"  class="form-control" placeholder="المحتوى" />
                        </div>
                        <div class="form-group">
                            <label for="Note">ملحوظة</label>
                            <input type="text" name="Note"  class="form-control" placeholder="ملحوظة" />
                        </div>
                        <div class="form-group">
                            <label for="ItemOrder">الترتيب</label>
                            <input type="text" name="ItemOrder"  class="form-control" placeholder="الترتيب" required />
                        </div>
                        <div class="form-group">
                            <label for="CleanText">Clear Text</label>
                            <input type="text" name="CleanText"  class="form-control" placeholder="Clear Text" />
                        </div>
                        
                        <div class="form-group">
                            <input type="submit" name="submit" value="Create Document Item" />
                        </div>
                    </form>

                </div>
            </div>
    </div>
    <!-- /.row -->
</div>
</div>

<?php $this->view('footer'); ?>