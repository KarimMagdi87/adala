<?php $this->view('header'); ?>
<div class="container bcontainer" style="min-height:308px;">
<h2>Topic Types List</h2>

<a href="<?php echo site_url('topic-types/create'); ?>">Create</a>
<div>
<?php
if($this->session->flashdata('success')){ 
    echo '<div class="bg-success">';
    echo $this->session->flashdata('success'); 
    echo '</div>';
}
if($this->session->flashdata('error')){ 
    echo '<div class="bg-danger">';
    echo $this->session->flashdata('error'); 
    echo '</div>';
}
?>
</div>

<div class="row">
        <form action="<?php echo site_url('document-types/filter'); ?>">
            <!--div class="col-lg-12 text-center" -->
            <!--h1>اختر</h1-->
            <div class="col-md-3 sel1Div">
                <div class="form-group">
                    <label for="Name">الأسم  :</label>
                    <input type="text" class="form-control" placeholder="Name" name="name" />
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="Color">اللون</label>
                    <input type="text"  class="form-control" placeholder="Color" name="color" />
                </div>
            </div>

            <div class="col-md-3">
                <input type="submit" value="Filter" />
            </div>
        </form>
    </div>

<table id="topicTypes" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Color</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($topicTypes as $topicType): ?>
        <tr>
            <td><?php echo $topicType['TopicTypeId']; ?></td>
            <td><?php echo $topicType['Name']; ?></td>
            <td><?php echo $topicType['Color']; ?></td>
            <td>
                <ul>
                    <li><a href="<?php echo site_url('topic-types/'.$topicType['TopicTypeId']); ?>">View</a></li>
                    <li><a href="<?php echo site_url('topic-types/edit/'.$topicType['TopicTypeId']); ?>">Edit</a></li>
                    <li><a href="<?php echo site_url('topic-types/delete/'.$topicType['TopicTypeId']); ?>" onclick="return confirm('Are you sure?')">Delete</a></li>
                </ul>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php $this->view('footer'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#topicTypes').DataTable();
    });
</script>