<?php $this->view('backend_header'); ?>
<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">        <div class="row">
            <div class="col-sm-8 col-md-6 col-md-offset-4">
                <h1 class="text-center login-title">Create Document Item</h1>
                <div class="account-wall ">
                    <?php if(validation_errors() != false) { ?>
                        <div class="alert alert-warning">
                           <?php echo validation_errors(); ?>
                        </div>
                    <?php } ?>

                    <?php echo form_open('document-items/edit/'. $this->uri->segment(3)); ?>
                        <div class="form-group">
                            <label for="DocumentId">الملف</label>
                            <select  name="DocumentId" class="form-control" required >
                                <?php foreach ($documents as $document) { ?>
                                    <?php $selected = ($document['DocumentId'] = $documentItem['DocumentId'])? 'selected': ''; ?>
                                    <option value="<?php echo $document['DocumentId']; ?>" <?php echo $selected; ?> ><?php echo $document['Title'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ParentItemId">نوع الموضوع</label>
                            <select  name="ParentItemId" class="form-control" >
                                <?php foreach ($parentItems as $parentItem) { ?>
                                    <?php $selected = ($parentItem['DocumentItemId'] = $parentItem['DocumentItemId'])? 'selected': ''; ?>
                                    <option value="<?php echo $parentItem['DocumentItemId']; ?>" <?php echo $selected; ?> ><?php echo $parentItem['DocumentItemId'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Title">العنوان</label>
                            <input type="text" name="Title"  class="form-control" placeholder="العنوان" value="<?php echo $documentItem['Title']; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="Text">المحتوى</label>
                            <textarea type="text" name="Text"  class="form-control" placeholder="المحتوى" ><?php echo $documentItem['Text']; ?> </textarea>
                        </div>
                        <div class="form-group">
                            <label for="Note">ملحوظة</label>
                            <textarea type="text" name="Note"  class="form-control" placeholder="ملحوظة" ><?php echo $documentItem['Note']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="ItemOrder">الترتيب</label>
                            <input type="text" name="ItemOrder"  class="form-control" placeholder="الترتيب" value="<?php echo $documentItem['ItemOrder']; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="CleanText">Clear Text</label>
                            <textarea type="text" name="CleanText"  class="form-control" placeholder="Clear Text" ><?php echo $documentItem['CleanText']; ?></textarea>
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