<?php $this->view('header'); ?>
<table>
    
        <tr>
            <th>Name</th>
            <td><?php echo $topicType['Name'] ?></td>
            
        </tr>
        <tr>
            <th>Color</th>
            <td><?php echo $topicType['Color'] ?></td>
        </tr>
    
</table>
<?php $this->view('footer'); ?>