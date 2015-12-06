<?php $this->view('backend_header'); ?>
<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-md-6 col-md-offset-4">
                <h1 class="text-center login-title">Update Document</h1>
                <div class="account-wall ">
                    <?php if(validation_errors() != false) { ?>
                        <div class="alert alert-warning">
                           <?php echo validation_errors(); ?>
                        </div>
                    <?php } ?>

                    <?php echo form_open('documents/edit/'. $this->uri->segment(3)); ?>
                        <div class="form-group">
                            <label for="TopicId">نوع الموضوع</label>
                            <select name="TopicId" class="form-control" required >
                                <?php foreach ($topics as $topic) { ?>
                                    <?php $selected = ($document['TopicId'] == $topic['TopicId'])? 'selected': ''; ?>
                                    <option value="<?php echo $topic['TopicId']; ?>" <?php echo $selected; ?>><?php echo $topic['Name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="DocumentTypeId">Document Type</label>
                            <select name="DocumentTypeId" class="form-control" required >
                                <?php foreach ($documentTypes as $documentType) { ?>
                                    <?php $selected = ($document['DocumentTypeId'] == $documentType['DocumentTypeId'])? 'selected': ''; ?>
                                    <option value="<?php echo $documentType['DocumentTypeId']; ?>" <?php echo $selected; ?>><?php echo $documentType['Name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ParentDocumentId">Parent Document</label>
                            <select  name="ParentDocumentId" class="form-control" >
                                <option value="">No parent</option>
                                <?php foreach ($parentDocuments as $parentDocument) { ?>
                                    <?php $selected = ($document['ParentDocumentId'] == $parentDocument['ParentDocumentId'])? 'selected': ''; ?>
                                    <option value="<?php echo $parentDocument['ParentDocumentId']; ?>" <?php echo $selected; ?>><?php echo $parentDocument['Title'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Note">ملحوظة</label>
                            <textarea type="text" name="Note"  class="form-control" placeholder="ملحوظة" ><?php echo $document['Note']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="Title">العنوان</label>
                            <input type="text" name="Title" class="form-control" placeholder="العنوان" value="<?php echo $document['Title']; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="Year">السنة</label>
                            <select name="Year" class="form-control" >
                                <?php for($i = 1960; $i <= date('Y'); $i++) { ?>
                                    <?php $selected = ($document['Year'] == $i)? 'selected': ''; ?>
                                    <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Date">التاريخ</label>
                            <input type="text" id="date" name="Date" class="form-control" placeholder="التاريخ" value="<?php echo $document['Date']; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="Publication">النشر</label>
                            <textarea type="text" name="Publication" class="form-control" placeholder="النشر" ><?php echo $document['Publication']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="Intro">المقدمة</label>
                            <textarea type="text" name="Intro" class="form-control" placeholder="المقدمة" ><?php echo $document['Intro']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="Summary">ملخص</label>
                            <textarea type="text" name="Summary" class="form-control" placeholder="ملخص" ><?php echo $document['Summary']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="Text">المحتوى</label>
                            <textarea type="text" name="Text" class="form-control" placeholder="المحتوى" ><?php echo $document['Text']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="Number">رقم</label>
                            <input type="text" name="Number" class="form-control" placeholder="رقم"  value="<?php echo $document['Number']; ?>"/>
                        </div>
                        <div class="form-group">
                            <label for="EditionNumber">رقم النسخة</label>
                            <input type="text" name="EditionNumber" class="form-control" placeholder="رقم النسخة" value="<?php echo $document['EditionNumber']; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="DocumentOrder">ترتيب الملف</label>
                            <input type="text" name="DocumentOrder" class="form-control" placeholder="ترتيب الملف" value="<?php echo $document['DocumentOrder']; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="OldId">الرقم القديم</label>
                            <input type="text" name="OldId" class="form-control" placeholder="الرقم القديم" value="<?php echo $document['OldId']; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="HTML">HTML</label>
                            <input type="text" name="HTML" class="form-control" placeholder="HTML" value="<?php echo $document['HTML']; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="IndexId">رقم المسلسل</label>
                            <input type="text" name="IndexId" class="form-control" placeholder="رقم المسلسل" value="<?php echo $document['IndexId']; ?>" />
                        </div>
                        
                        <div class="form-group">
                            <input type="submit" name="submit" value="Update Document" />
                        </div>
                    </form>

                </div>
            </div>
    </div>
    <!-- /.row -->
</div>
</div>
<?php $this->view('footer'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#date").datepicker();
    });
</script>