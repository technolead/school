<?php if(count($rows)>0) {?>
<div class='table_content'>
    <div class="pagination_links">
        <div class="left b">Student Report (Contact)</div>
        <div class="clear"></div>
    </div>
    <table cellpadding="0" cellspacing="0" class="txt_center">
        <tr class='title'>
            <th>Student Name</th>
            <th>Class Name</th>
            <th>Final Status</th>
            <th>Telephone</th>
            <th>Email</th>
            <th>Address</th>
        </tr>
            <?php
            $inc=1;
            foreach($rows as $row):?>
        <tr <?php if($inc%2==0) {
                    echo "class='even'";
                }else {
                    echo "class='odd'";
                    }?>>
            <td><?=$row['student_name']?></td>
            <td><?=$row['class_name']?></td>
            <td><?=$row['student_status']?>&nbsp;</td>
            <td><?=$row['phone']?>&nbsp;</td>
            <td><?=$row['email']?></td>
            <td><?=$row['present_address']?></td>
        </tr>
                <?php $inc++;
            endforeach;
            ?>
    </table>
</div>
    <?php }?>