<?php if($msg!="") {
    echo "<div class='success'>$msg</div>";
}?>
<div class='table_content'>
    <h3>Notice Board</h3>
    <table cellspacing='1' cellpadding="1">
        <tr class='title'>
            <th>Notice Title</th>
            <th>Notice</th>
            <th>Posted Date</th>
            <th>Valid Until</th>
            <th>Priority</th>
            <th>Notice Type</th>
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
            <td><?=$row['notice_type']?></td>
            <td><?=$row['first_name'].' '.$row['last_name']?></td>
        </tr>
        <?php  $inc++;
    endforeach;
}else {
    echo "<tr><td colspan='3'>No Letters Found!!!</td></tr>";
}?>
    </table>
</div>
<div class='table_content'>
    <h3>General Enquiry Message</h3>
<table cellspacing='1' cellpadding="1">
        <tr class='title'>
            <th>Date</th>
            <th>Person Name</th>
            <th>Organisation</th>
            <th>Queries/messages</th>
            <th>Looking for</th>
            <th>Comments</th>
            <th>Posted By</th>
            <th>View</th>
        </tr>
        <?php if(count($enquiry)>0) {
    $inc=1;
    foreach($enquiry as $row):?>
        <tr <?php if($inc%2==0) {
            echo "class='even'";
        }else {
            echo "class='odd'";
        }?>>
            <td><?=$row['date']?></td>
            <td><?=$row['name']?></td>
            <td><?=$row['organisation']?></td>
            <td><?=$row['messages']?></td>
            <td><?=$row['look_for']?></td>
            <td><?=$row['comments']?></td>
            <td><?=$row['first_name'].' '.$row['last_name']?></td>
            <td class="view_links" style="width:30px;">
                <a href='#print_view' rel="<?=site_url('enquiry/details/'.$row['enquiry_id'])?>" class="print_link print_view" title="Print View"></a>
            </td>
        </tr>
        <?php $inc++;
    endforeach;
}else {
    echo "<tr><td colspan='4'>No Content Found!!!</td></tr>";
}  ?></table>
</div>