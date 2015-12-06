<?php $this->view('backend_header'); ?>
<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">        <div class="row">
            <div class="col-sm-8 col-md-6 col-md-offset-4">
                <h1 class="text-center login-title">Create Document</h1>
                <div class="account-wall ">
                    <?php if(validation_errors() != false) { ?>
                        <div class="alert alert-warning">
                           <?php echo validation_errors(); ?>
                        </div>
                    <?php } ?>

                    <?php echo form_open('documents/create'); ?>
                        <div class="form-group">
                            <label for="TopicId">نوع الموضوع</label>
                            <select name="TopicId" class="form-control" required >
                                <?php foreach ($topics as $topic) { ?>
                                    <option value="<?php echo $topic['TopicId']; ?>"><?php echo $topic['Name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="DocumentTypeId">Document Type</label>
                            <select name="DocumentTypeId" class="form-control" required >
                                <?php foreach ($documentTypes as $documentType) { ?>
                                    <option value="<?php echo $documentType['DocumentTypeId']; ?>"><?php echo $documentType['Name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ParentDocumentId">Parent Document</label>
                            <select  name="ParentDocumentId" class="form-control" >
                                <option value="">No parent</option>
                                <?php foreach ($parentDocuments as $parentDocument) { ?>
                                    <option value="<?php echo $parentDocument['ParentDocumentId']; ?>"><?php echo $parentDocument['Title'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Note">ملحوظة</label>
                            <textarea type="text" name="Note"  class="form-control" placeholder="ملحوظة" ></textarea>
                        </div>
                        <div class="form-group">
                            <label for="Title">العنوان</label>
                            <input type="text" name="Title" class="form-control" placeholder="العنوان" />
                        </div>
                        <div class="form-group">
                            <label for="Year">السنة</label>
                            <select name="Year" class="form-control" >
                                <?php for($i = 1960; $i <= date('Y'); $i++) { ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Date">التاريخ</label>
                            <input type="text" id="date" name="Date" class="form-control" placeholder="التاريخ" />
                        </div>
                        <div class="form-group">
                            <label for="Publication">النشر</label>
                            <textarea type="text" name="Publication" class="form-control" placeholder="النشر" ></textarea>
                        </div>
                        <div class="form-group">
                            <label for="Intro">المقدمة</label>
                            <textarea type="text" name="Intro" class="form-control" placeholder="المقدمة" ></textarea>
                        </div>
                        <div class="form-group">
                            <label for="Summary">ملخص</label>
                            <textarea type="text" name="Summary" class="form-control" placeholder="ملخص" ></textarea>
                        </div>
                        <div class="form-group">
                            <label for="Text">المحتوى</label>
                            <textarea type="text" name="Text" class="form-control" placeholder="المحتوى" ></textarea>
                        </div>
                        <div class="form-group">
                            <label for="Number">رقم</label>
                            <input type="text" name="Number" class="form-control" placeholder="رقم" />
                        </div>
                        <div class="form-group">
                            <label for="EditionNumber">رقم النسخة</label>
                            <input type="text" name="EditionNumber" class="form-control" placeholder="رقم النسخة" />
                        </div>
                        <div class="form-group">
                            <label for="DocumentOrder">ترتيب الملف</label>
                            <input type="text" name="DocumentOrder" class="form-control" placeholder="ترتيب الملف" />
                        </div>
                        <div class="form-group">
                            <label for="OldId">الرقم القديم</label>
                            <input type="text" name="OldId" class="form-control" placeholder="الرقم القديم" />
                        </div>
                        <div class="form-group">
                            <label for="HTML">HTML</label>
                            <input type="text" name="HTML" class="form-control" placeholder="HTML" />
                        </div>
                        <div class="form-group">
                            <label for="IndexId">رقم المسلسل</label>
                            <input type="text" name="IndexId" class="form-control" placeholder="رقم المسلسل" />
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
<script type="text/javascript">
    $(document).ready(function () {
        $("#date").datepicker();
    });
</script>