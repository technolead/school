<div class='table_content'>
    <h3>Student Letters</h3>
    <table cellspacing='1' cellpadding="1">
        <tr class='title'>
            <th>From Name</th>
            <th>Issue Date</th>
            <th>Letter Title</th>
            <th>Description</th>
        </tr>
        <?php if(count($letters)>0) {
            $inc=1;
            foreach($letters as $row): ?>
        <tr <?php if($inc%2==0) {
                    echo "class='even'";
                }else {
                    echo "class='odd'";
                    }?>>
            <td><?=$row['first_name'].' '.$row['last_name']?></td>
            <td><?=$row['issue_date']?></td>
            <td><a href="<?=site_url('letters/details/'.$row['student_letters_id'])?>" title="<?=$row['letter_title']?>" style="color:#0202F5"><?=$row['letter_title']?></a></td>
            <td><?=word_limiter(strip_tags($row['letter_des']),10)?></td>
        </tr>
                <?php  $inc++;
            endforeach;
        }else {
            echo "<tr><td colspan='3'>No Letters Found!!!</td></tr>";
        }?>
    </table>
</div>
<div class='table_content'>
    <h3>Notice Board</h3>
    <table cellspacing='1' cellpadding="1">
        <tr class='title'>
            <th>Notice Title</th>
            <th>Notice</th>
            <th>Posted Date</th>
            <th>Valid Until</th>
            <th>Priority</th>
            <!--<th>Notice Type</th>-->
            <th>Posted By</th>
        </tr>
        <?php if(count($notice)>0) {
            $inc=1;
            foreach($notice as $row): ?>
        <tr <?php if($inc%2==0) {
                    echo "class='even'";
                }else {
                    echo "class='odd'";
                    }?>>
            <td><a href="<?=site_url('notice/details/'.$row['notice_id'].'/'.url_title($row['notice_title']))?>" title="<?=$row['notice_title']?>" style="color:#0202F5"><?=$row['notice_title']?></a></td>
            <td><?=word_limiter(strip_tags($row['des']),10)?></td>
            <td><?=$row['posted_date']?></td>
            <td><?=$row['valid_until']?></td>
            <td><?=$row['priority']?></td>
            <!--<td><?=$row['notice_type']?></td>-->
            <td><?=$row['first_name'].' '.$row['last_name']?></td>
        </tr>
                <?php  $inc++;
            endforeach;
        }?>
        <?php if(count($staff_notice)>0) {
            $inc=1;
            foreach($staff_notice as $row): ?>
        <tr <?php if($inc%2==0) {
                    echo "class='even'";
                }else {
                    echo "class='odd'";
                    }?>>
            <td><a href="<?=site_url('notice/notice_details/'.$row['notice_id'].'/'.url_title($row['notice_title']))?>" title="<?=$row['notice_title']?>" style="color:#0202F5"><?=$row['notice_title']?></a></td>
            <td><?=word_limiter(strip_tags($row['des']),10)?></td>
            <td><?=$row['posted_date']?></td>
            <td><?=$row['valid_until']?></td>
            <td><?=$row['priority']?></td>
            <td><?=$row['first_name'].' '.$row['last_name']?></td>
        </tr>
                <?php  $inc++;
            endforeach;
        }?>
    </table>
</div>