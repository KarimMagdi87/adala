<?php $this->view('header'); ?>
                        <h1>Topic</h1>
                        <table>
    <tr>
        <th>Id</th>
        <td><?php echo $topic['TopicId']; ?></td>
    </tr>
    <tr>
        <th>Name</th>
        <td><?php echo $topic['Name'] ?></td>
    </tr>
    <tr>
        <th>Topic Type</th>
        <td><?php echo $topic['TopicTypeId'];?></td>
    </tr>
    <tr>
        <th>Parent Topic</th>
        <td><?php echo $topic['ParentTopicId'] ?></td>
    </tr>
</table>
                <?php $this->view('footer'); ?>