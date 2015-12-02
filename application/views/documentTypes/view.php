<?php $this->view('header'); ?>
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-md-6 col-md-offset-4">
            <h1 class="text-center login-title">Create Document Type</h1>
            <div class="account-wall ">
                <table>
                    <tr>
                        <th>Id</th>
                        <td><?php echo $documentType['DocumentTypeId']; ?></td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td><?php echo $documentType['Name'] ?></td>

                    </tr>
                    <tr>
                        <th>Topic Type Id</th>
                        <td><?php echo $documentType['TopicTypeId'] ?></td>
                    </tr>
                    <tr>
                        <th>Color</th>
                        <td><?php echo $documentType['Color'] ?></td>
                    </tr>

                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->view('footer'); ?>