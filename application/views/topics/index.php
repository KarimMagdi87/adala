<?php $this->view('backend_header'); ?>
<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">    <h2>Topics List</h2>

    <a href="<?php echo site_url('topics/create'); ?>">Create</a>
    <div>
        <?php
        if ($this->session->flashdata('success')) {
            echo '<div class="bg-success">';
            echo $this->session->flashdata('success');
            echo '</div>';
        }
        if ($this->session->flashdata('error')) {
            echo '<div class="bg-danger">';
            echo $this->session->flashdata('error');
            echo '</div>';
        }
        ?>
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
                            <li><a data-toggle="modal" data-target="#myModal" class="tddocument" id="<?php echo $topic['TopicId']; ?>" href="#">View</a>
                            <li><a href="<?php echo site_url('topics/edit/' . $topic['TopicId']); ?>">Edit</a></li>
                            <li><a href="<?php echo site_url('topics/delete/' . $topic['TopicId']); ?>" onclick="return confirm('Are you sure?')">Delete</a></li>
                        </ul>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button style="float: left" type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Topic</h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
<?php $this->view('footer'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#topics').DataTable();

        // Render topic modal
        $(document).on("click", '.tddocument', function (e) {
            e.preventDefault();
            $(".modal-body").html('');
            var string = "";

            $.ajax({
                type: "GET",
                url: "<?php echo base_url('topics/') ?>/" + $(this).attr("id"),
                cache: false,
                dataType: 'JSON',
                success: function (response) {
                    var string = '<div><h4>Name:</h4><span>' + response.Name + '</span></div>'
                    +'<div><h4>Topic Type:</h4><span>' + response.TopicTypeId + '</span></div>'
                    + '<div><h4>Parent Topic:</h4><span>' + response.ParentTopicId + '</span></div>';
                    
                    $(".modal-body").append(string);
                }
            });

        });
    });
</script>