<?php $this->view('backend_header'); ?>
<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">    <div class="row">
        <div class="col-sm-8 col-md-6 col-md-offset-4">
            <h1 class="text-center login-title">Update Topic</h1>
            <div class="account-wall ">
                <?php if (validation_errors() != false) { ?>
                    <div class="alert alert-warning">
                        <?php echo validation_errors(); ?>
                    </div>
                <?php } ?>
                <?php echo form_open('topics/edit/' . $this->uri->segment(3)); ?>

                <div class="form-group">
                    <label for="Name">Name</label>
                    <input type="input" name="Name" class="form-control" value="<?php echo $topic['Name']; ?>"/><br />
                </div>
                <div class="form-group">
                    <label for="ParentTopicId">Parent Topic</label>
                    <select  name="ParentTopicId" class="form-control" >
                        <option>No parent</option>
                        <?php foreach ($parentTopics as $parentTopic) { ?>
                            <?php $selected = ($parentTopic['TopicId'] == $topic['ParentTopicId']) ? 'selected' : ''; ?>
                            <option value="<?php echo $parentTopic['TopicId']; ?>" <?php echo $selected; ?>><?php echo $parentTopic['Name'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="TopicTypeId">Topic Type</label>
                    <select  name="TopicTypeId" class="form-control" >
                        <?php foreach ($topicTypes as $topicType) { ?>
                            <?php $selected = ($topicType['TopicTypeId'] == $topic['TopicTypeId']) ? 'selected' : ''; ?>
                            <option value="<?php echo $topicType['TopicTypeId']; ?>" <?php echo $selected ?>><?php echo $topicType['Name'] ?></option>
                        <?php } ?>
                    </select>
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
</div>
<?php $this->view('footer'); ?>