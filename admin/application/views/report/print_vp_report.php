<?php if(count($rows)>0) {?>
<div class='table_content'>
    <div class="pagination_links">
        <div class="left b">Student Report (Visa/Passport)</div>
        <div class="clear"></div>
    </div>
    <table cellpadding="0" cellspacing="0" class="txt_center">
        <tr class='title'>
            <th>Student Name</th>
            <th>Program Name</th>
            <th>Final Status</th>
            <th>Level Name</th>
            <th>Semester Name</th>
            <th>Passport Expiry Date</th>
            <th>Visa Expiry Date</th>
            <th>Hard</th>
            <th>Action</th>
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
            <td><?=$row['program_name']?></td>
            <td><?=$row['student_status']?></td>
            <td><?=$row['level_name']?></td>
            <td><?=$row['semester_name']?></td>
            <td><?=$row['passport_expiry']?></td>
            <td><?=$row['visa_expiry']?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
                <?php $inc++;
            endforeach;
            ?>
    </table>
</div>
    <?php }?>