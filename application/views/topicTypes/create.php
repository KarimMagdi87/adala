<?php $this->view('header'); ?>
<h2>Create Topic</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('topic-types/create'); ?>

    <label for="Name">Name</label>
    <input type="input" name="Name" /><br />

    <label for="Color">Color</label>
    <textarea name="Color"></textarea><br />

    <input type="submit" name="submit" value="Create Topic Type" />

</form>

<?php $this->view('footer'); ?>