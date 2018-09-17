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
            
            <th>Continues missed <br />(3 class)</th>
            <th>Continues missed <br />(6 times)</th>
            <th>Continues missed <br />(10 times)</th>
            <th>Last Continues missed</th>
            <th>Percentage</th>
        </tr>
            <?php
            $inc=1;
            foreach($rows as $row):
                $three_class=sql::count('std_con_absent',"student_id=$row[student_id] and absent=3");
                $six_class=sql::count('std_con_absent',"student_id=$row[student_id] and absent=6");
                $ten_class=sql::count('std_con_absent',"student_id=$row[student_id] and absent=10");
                ?>
        <tr <?php if($inc%2==0) {
                    echo "class='even'";
                }else {
                    echo "class='odd'";
                    }?>>
            <td><?=$row['student_name']?></td>
            <td><?=$row['class_name']?></td>
            <td><?=$row['student_status']?></td>
            
            <td><?=$three_class?></td>
            <td><?=$six_class?></td>
            <td><?=$ten_class?></td>
            <th title="From <?=$row['from_date'].' To '.$row['to_date']?>" class="<?=common::get_attd_status_view($row['absent'])?>"><?=$row['absent']?></th>
            <th><?=round($row['percentage'],2)?>%</th>
        </tr>
                <?php $inc++;
            endforeach;
            ?>
    </table>
</div>
    <?php }?>