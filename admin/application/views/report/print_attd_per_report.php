<?php if(count($rows)>0) {?>
<div class='table_content'>
    <div class="pagination_links">
        <div class="left b">Attendance Report (Percentage)</div>
        <div class="clear"></div>
    </div>
    <table cellpadding="0" cellspacing="0" class="txt_center">
        <tr class='title'>
            <th>Student Name</th>
            <th>Class Name</th>
            <th>Final Status</th>
            
            <th>Session Name</th>
            <th>Continues missed</th>
            <th>Percentage</th>
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
            <td><?=$row['student_status']?></td>
            
            <td><?=$row['session_name']?></td>
            <th title="From <?=$row['from_date'].' To '.$row['to_date']?>" class="<?=common::get_attd_status_view($row['absent'])?>"><?=$row['absent']?></th>
            <th><?=round($row['percentage'],2)?>%</th>
            </tr>
                <?php $inc++;
            endforeach;
            ?>
    </table>
</div>
    <?php }?>