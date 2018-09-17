<?php if($msg!="") {
    echo "<div class='success'>$msg</div>";
}?>
<div class='table_content'>
  <div>
        <form action="<?=site_url('letters/issued_letters/')?>" method="post">
            <table>
                <tr>
                    <th class="txt_right">Student ID</th><td><input type="text" name="user_name" value="<?=set_value('user_name')?>" class="width_160" /></td>
                    <th>Last Name</th><td><input type="text" name="name" value="<?=set_value('name')?>" class="width_160" /></td>
                    <th>Letter</th><td><select name="letters_id"><?=combo::get_letter_options(set_value('letters_id'),TRUE)?></select></td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td><input type="text"  name="from_date" value="<?=set_value('from_date')?>" class="date_picker width_80" /> To <input type="text" name="to_date" value="<?=set_value('to_date')?>" class="date_picker width_80" /></td>
                    <td colspan="4" align="right"><input type='submit' name='apply_filter' value='Search' class='button' /></td>
                </tr>
            </table>
        </form>
    </div>
    <div class="pagination_links">
        <div class="left width_500 b">Showing <?=$start?>-<?=$end?> of <?=$total?> Issued Letters</div><div class="right"><?=$pagination_links?></div>
        <div class="clear"></div>
    </div>
    <table cellpadding="1" cellspacing="1">
        <tr class='title'>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Letter Title</th>
            <th>Description</th>
            <th>Created By</th>
            <th>Issue Date</th>
            <th>Action</th>
        </tr>
        <?php if(count($rows)>0) {
            $inc=1;
            foreach($rows as $row):?>
        <tr <?php if($inc%2==0) {
                    echo "class='even'";
                }else {
                    echo "class='odd'";
                    }?>>
            <td><?=$row['user_name']?></td>
            <td><?=$row['first_name'].' '.$row['last_name']?></td>
            <td><?=$row['letter_title']?></td>
            <td><?=word_limiter(strip_tags($row['letter_des']),5)?></td>
            <td><?=$row['ufirst_name'].' '.$row['ulast_name']?></td>
            <td><?=$row['issue_date']?></td>
            <td class='view_links'>
                        <?php  if(common::user_permit('update')) { ?>
                <a href='#print_view' rel="<?=site_url('letters/print_view/'.$row['student_letters_id'])?>" class="print_link print_view" title="Print View"></a
                <a href='<?=site_url('letters/edit_issue_letter/'.$row['student_letters_id'])?>' class="edit_link" title="Change"></a>
                <a href='<?=site_url('letters/delete_issued_letters/'.$row['student_letters_id'])?>' class="delete_link" onclick='javascript: return confirm("Are you sure you want to delete?");' class="delete_link" title="Delete"></a>
                            <?php }?>
            </td>
        </tr>
                <?php $inc++;
            endforeach;
        }else {
            echo "<tr><td colspan='4'>No Content Found!!!</td></tr>";
        }  ?>
    </table>
    <div class="pagination_links">
        <div class="left width_500 b">Showing <?=$start?>-<?=$end?> of <?=$total?> Issued Letters</div><div class="right"><?=$pagination_links?></div>
        <div class="clear"></div>
    </div>
</div>