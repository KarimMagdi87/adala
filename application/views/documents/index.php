<?php $this->view('backend_header'); ?>
<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
    <h2>Documents List</h2>

    <a href="<?php echo site_url('documents/create'); ?>">Create</a>
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
                <th>Title</th>
                <th>Topic Id</th>
                <th>DocumentType Id</th>
                <th>ParentDocument Id</th>
                <th>Note</th>
                <th>Year</th>
                <th>Publication</th>
                <th>Date</th>
                <th>Intro</th>
                <th>Summary</th>
                <th>Text</th>
                <th>Number</th>
                <th>Edition Number</th>
                <th>Document Order</th>
                <th>Old Id</th>
                <th>HTML</th>
                <th>Index Id</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($documents as $document): ?>
                <tr>
                    <td><?php echo $document['DocumentId']; ?></td>
                    <td><?php echo $document['Title']; ?></td>
                    <td><?php echo $document['TopicId']; ?></td>
                    <td><?php echo $document['DocumentTypeId']; ?></td>
                    <td><?php echo $document['ParentDocumentId']; ?></td>
                    <td><?php echo $document['Note']; ?></td>
                    <td><?php echo $document['Year']; ?></td>
                    <td><?php echo $document['Publication']; ?></td>
                    <td><?php echo $document['Date']; ?></td>
                    <td><?php echo $document['Intro']; ?></td>
                    <td><?php echo $document['Summary']; ?></td>
                    <td><?php echo $document['Text']; ?></td>
                    <td><?php echo $document['Number']; ?></td>
                    <td><?php echo $document['EditionNumber']; ?></td>
                    <td><?php echo $document['DocumentOrder']; ?></td>
                    <td><?php echo $document['OldId']; ?></td>
                    <td><?php echo $document['HTML']; ?></td>
                    <td><?php echo $document['IndexId']; ?></td>
                    <td>
                        <ul>
                            <li><a data-toggle="modal" data-target="#myModal" class="tddocument" id="<?php echo $document['DocumentId']; ?>" href="#">View</a>
                            <li><a href="<?php echo site_url('documents/edit/' . $document['DocumentId']); ?>">Edit</a></li>
                            <li><a href="<?php echo site_url('documents/delete/' . $document['DocumentId']); ?>" onclick="return confirm('Are you sure?')">Delete</a></li>
                            <li><a href="<?php echo site_url('documents/document-items/' . $document['DocumentId']); ?>">View Document Items</a></li>
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
                    <h4 class="modal-title">Document</h4>
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
        $('#documentTypes').DataTable();
        
        // Render document type modal
        $(document).on("click", '.tddocument', function (e) {
            e.preventDefault();
            $(".modal-body").html('');
            var string = "";

            $.ajax({
                type: "GET",
                url: "<?php echo base_url('documents/')?>/" + $(this).attr("id"),
                cache: false,
                dataType: 'JSON',
                success: function (response) {
                    
                    var string = '<div><h4>DocumentId:</h4><span>' + response.DocumentId + '</span></div>'	
                               + '<div><h4>TopicId:</h4><span>' + response.TopicId + '</span></div>'
                               + '<div><h4>DocumentTypeId:</h4><span>' + response.DocumentTypeId + '</span></div>'
                               + '<div><h4>ParentDocumentId:</h4><span>' + response.ParentDocumentId + '</span></div>'
                               + '<div><h4>Note:</h4><span>' + response.Note + '</span></div>'
                               + '<div><h4>Title:</h4><span>' + response.Title + '</span></div>'
                               + '<div><h4>Year:</h4><span>' + response.Year + '</span></div>'
                               + '<div><h4>Publication:</h4><span>' + response.Publication + '</span></div>'
                               + '<div><h4>Date:</h4><span>' + response.Date + '</span></div>'
                               + '<div><h4>Intro:</h4><span>' + response.Intro + '</span></div>'
                               + '<div><h4>Summary:</h4><span>' + response.Summary + '</span></div>'
                               + '<div><h4>Text:</h4><span>' + response.Text + '</span></div>'
                               + '<div><h4>Number:</h4><span>' + response.Number + '</span></div>'
                               + '<div><h4>Edition Number:</h4><span>' + response.EditionNumber + '</span></div>'
                               + '<div><h4>Document Order:</h4><span>' + response.DocumentOrder + '</span></div>'
                               + '<div><h4>Old Id:</h4><span>' + response.OldId + '</span></div>'
                               + '<div><h4>HTML:</h4><span>' + response.HTML + '</span></div>'
                               + '<div><h4>Index Id:</h4><span>' + response.IndexId + '</span></div>';
                    
                    $(".modal-body").append(string);
                }
            });

        });

    });
</script>