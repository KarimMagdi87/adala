<?php $this->view('header'); ?>
<h2>Edit Topic Type</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('topic-types/edit/'. $this->uri->segment(3)); ?>

    <label for="Name">Name</label>
    <input type="input" name="Name" value="<?php echo $Name; ?>" /><br />

    <label for="Color">Color</label>
    <textarea name="Color"><?php echo $Color; ?></textarea><br />

    <input type="submit" name="submit" value="Update Topic Type" />

</form>

<?php $this->view('footer'); ?>