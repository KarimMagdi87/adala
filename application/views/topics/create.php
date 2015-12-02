<?php $this->view('header'); ?>
<h2>Create Topic</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('topics/create'); ?>

<div>
    <label for="Name">Name</label>
    <input type="input" name="Name" value=""/><br />
</div>
<div>
    <label for="ParentTopicId">Parent Topic</label>
    <select  name="ParentTopicId" >
        <option value="">No parent</option>
        <?php foreach ($parentTopics as $parentTopic) { ?>
            <option value="<?php echo $parentTopic['TopicId']; ?>"><?php echo $parentTopic['Name'] ?></option>
        <?php } ?>
    </select>
</div>
<div>
    <label for="TopicTypeId">Topic Type</label>
    <select  name="TopicTypeId" >
        <?php foreach ($topicTypes as $topicType) { ?>
            <option value="<?php echo $topicType['TopicTypeId']; ?>"><?php echo $topicType['Name'] ?></option>
        <?php } ?>
    </select>
</div>

<input type="submit" name="submit" value="Create Topic" />

</form>

<?php $this->view('footer'); ?>