<?php $this->view('header'); ?>
<h2>Update Document</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('topics/edit/' . $this->uri->segment(3)); ?>

<div>
    <label for="Name">Name</label>
    <input type="input" name="Name" value="<?php echo $topic['Name']; ?>"/><br />
</div>
<div>
    <label for="ParentTopicId">Parent Topic</label>
    <select  name="ParentTopicId" >
        <option>No parent</option>
        <?php foreach ($parentTopics as $parentTopic) { ?>
            <?php $selected = ($parentTopic['TopicId'] == $topic['ParentTopicId']) ? 'selected' : ''; ?>
            <option value="<?php echo $parentTopic['TopicId']; ?>" <?php echo $selected; ?>><?php echo $parentTopic['Name'] ?></option>
        <?php } ?>
    </select>
</div>

<div>
    <label for="TopicTypeId">Topic Type</label>
    <select  name="TopicTypeId" >
        <?php foreach ($topicTypes as $topicType) { ?>
            <?php $selected = ($topicType['TopicTypeId'] == $topic['TopicTypeId']) ? 'selected' : ''; ?>
            <option value="<?php echo $topicType['TopicTypeId']; ?>" <?php echo $selected ?>><?php echo $topicType['Name'] ?></option>
        <?php } ?>
    </select>
</div>

<input type="submit" name="submit" value="Update Topic Type" />

</form>

<?php $this->view('footer'); ?>