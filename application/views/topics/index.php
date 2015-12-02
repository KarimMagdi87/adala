<?php $this->view('header'); ?>
<div class="container bcontainer" style="min-height:308px;">
<h2>Topics List</h2>

<a href="<?php echo site_url('topics/create'); ?>">Create</a>
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
        <form action="<?php echo site_url('topics/filter'); ?>">
            <!--div class="col-lg-12 text-center" -->
            <!--h1>اختر</h1-->
            <div class="col-md-3 sel1Div">
                <div class="form-group">
                    <label for="Name">الأسم  :</label>
                    <input type="text" placeholder="Name" name="name" />
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="parentTopic">نوع الموضوع</label>
                    <select class="form-control" name="parentTopic" >
                        <option value="">No parent</option>
                        <?php foreach ($parentTopics as $parentTopic) { ?>
                            <option value="<?php echo $parentTopic['TopicId']; ?>"><?php echo $parentTopic['Name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    <label for="parentTopic">نوع الموضوع</label>
                    <select class="form-control" name="topicType" >
                        <option value="">No Topic type</option>
                        <?php foreach ($topicTypes as $topicType) { ?>
                            <option value="<?php echo $topicType['TopicTypeId']; ?>"><?php echo $topicType['Name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>


            <div class="col-md-3">
                <input type="submit" value="Filter" />
            </div>
        </form>
    </div>

<table id="topics" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Topic Type</th>
            <th>Parent Topic</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($topics as $topic): ?>
            <tr>
                <td><?php echo $topic['TopicId']; ?></td>
                <td><?php echo $topic['Name']; ?></td>
                <td><?php echo $topic['TopicTypeId'] ?></td>
                <td><?php echo $topic['ParentTopicId'] ?></td>
                <td>
                    <ul>
                        <li><a href="<?php echo site_url('topics/' . $topic['TopicId']); ?>">View</a></li>
                        <li><a href="<?php echo site_url('topics/edit/' . $topic['TopicId']); ?>">Edit</a></li>
                        <li><a href="<?php echo site_url('topics/delete/' . $topic['TopicId']); ?>" onclick="return confirm('Are you sure?')">Delete</a></li>
                    </ul>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php $this->view('footer'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#topics').DataTable();
    });
</script>