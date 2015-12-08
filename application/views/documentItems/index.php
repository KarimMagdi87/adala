<?php $this->view('backend_header'); ?>
<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
    <h2>Document Types List</h2>

    <a href="<?php echo site_url('document-items/create'); ?>">Create</a>
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

    <table id="documentItems" class="display dataTable no-footer" width="100%" cellspacing="0" role="grid" aria-describedby="documentTypes_info" style="width: 100%;">
        <thead>
            <tr>
                <th>Id</th>
                <th>Document Id</th>
                <th>Parent Item Id</th>
                <th>Title</th>
                <th>Note</th>
                <th>Item Order</th>
                <th>Clean Text</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($documentItems as $key => $documentItem): ?>
                <?php $class = (0 == $key % 2)? 'even': 'odd'; ?>
                <tr class="<?php echo $class; ?>">
                    <td><?php echo $documentItem['DocumentItemId']; ?></td>
                    <td><?php echo $documentItem['DocumentId']; ?></td>
                    <td><?php echo $documentItem['ParentItemId']; ?></td>
                    <td><?php echo $documentItem['Title']; ?></td>
                    <td><?php echo $documentItem['Note']; ?></td>
                    <td><?php echo $documentItem['ItemOrder']; ?></td>
                    <td><?php echo $documentItem['CleanText']; ?></td>
                    <td>
                        <ul>
                            <li><a data-toggle="modal" data-target="#myModal" class="tddocument" id="<?php echo $documentItem['DocumentItemId']; ?>" href="#">View</a>
                            <li><a href="<?php echo site_url('document-items/edit/' . $documentItem['DocumentItemId']); ?>">Edit</a></li>
                            <li><a href="<?php echo site_url('document-items/delete/' . $documentItem['DocumentItemId']); ?>" onclick="return confirm('Are you sure?')">Delete</a></li>
                        </ul>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <?php $start = (is_numeric($this->uri->segment(3))) ? $this->uri->segment(3): 1; ?>
    <div class="dataTables_paginate paging_simple_numbers" id="documentTypes_paginate">
        <?php echo $this->pagination->create_links(); ?>
    </div>
    <div class="dataTables_info" id="documentTypes_info" role="status" aria-live="polite">Showing <?php echo $start; ?> to <?php echo $start + 19; ?> of <?php echo $total_rows; ?> entries</div>
    
    
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button style="float: left" type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Document Item</h4>
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
        // Render document type modal
        $(document).on("click", '.tddocument', function (e) {
            e.preventDefault();
            $(".modal-body").html('');
            var string = "";

            $.ajax({
                type: "GET",
                url: "<?php echo base_url('document-items/')?>/" + $(this).attr("id"),
                cache: false,
                dataType: 'JSON',
                success: function (response) {
                    console.log(response)
                    var string = '<div><h4>Document Item Id:</h4><span>' + response.DocumentItemId + '</span></div>'
                    + '<div><h4>Document Id:</h4><span>' + response.DocumentId + '</span></div>'
                    + '<div><h4>Parent Document Item Id:</h4><span>' + response.ParentItemId + '</span></div>'
                    + '<div><h4>Title:</h4><span>' + response.Title + '</span></div>'
                    + '<div><h4>Text:</h4><span>' + response.Text + '</span></div>'
                    + '<div><h4>Text:</h4><span>' + response.Note + '</span></div>'
                    + '<div><h4>Item Order:</h4><span>' + response.ItemOrder + '</span></div>'
                    + '<div><h4>Clean Text:</h4><span>' + response.CleanText + '</span></div>';
                    
                    $(".modal-body").append(string);
                }
            });

        });

    });
</script>