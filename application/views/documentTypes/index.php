<?php $this->view('header'); ?>
<!-- Page Content -->
<div class="container bcontainer" style="min-height:308px;">
    <h2>Document Types List</h2>

    <a href="<?php echo site_url('document-types/create'); ?>">Create</a>
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

    <table id="documentTypes" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Topic Type</th>
                <th>Color</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($documentTypes as $documentType): ?>
                <tr>
                    <td><?php echo $documentType['DocumentTypeId']; ?></td>
                    <td><?php echo $documentType['Name']; ?></td>
                    <td><?php echo $documentType['TopicTypeId']; ?></td>
                    <td><?php echo $documentType['Color']; ?></td>
                    <td>
                        <ul>
                            <li><a data-toggle="modal" data-target="#myModal" class="tddocument" id="<?php echo $documentType['DocumentTypeId']; ?>" href="#">View</a>
                            <li><a href="<?php echo site_url('document-types/edit/' . $documentType['DocumentTypeId']); ?>">Edit</a></li>
                            <li><a href="<?php echo site_url('document-types/delete/' . $documentType['DocumentTypeId']); ?>" onclick="return confirm('Are you sure?')">Delete</a></li>
                        </ul>
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
                    <h4 class="modal-title">Document Type</h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>
<?php $this->view('footer'); ?>

<script type="text/javascript">
    $(document).ready(function () {
        $('#documentTypes').DataTable();
        
        // Render document type modal
        $(document).on("click", '.tddocument', function (e) {
            e.preventDefault();
            $(".modal-body").html('');
            var string = "";

            $.ajax({
                type: "GET",
                url: "<?php echo base_url('document-types/')?>/" + $(this).attr("id"),
                cache: false,
                dataType: 'JSON',
                success: function (response) {
                    
                    var string = '<div><h4>Name:</h4><span>' + response.Name + '</span></div>'
                    + '<div><h4>Document Type:</h4><span>' + response.DocumentTypeId + '</span></div>'
                    + '<div><h4>Topic Type:</h4><span>' + response.TopicTypeId + '</span></div>'
                    + '<div><h4>Color:</h4><span>' + response.Color + '</span></div>';
                    
                    $(".modal-body").append(string);
                }
            });

        });

    });
</script>