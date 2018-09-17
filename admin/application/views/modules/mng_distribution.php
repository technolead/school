<?php if($msg!="") {
    echo "<div class='success'>$msg</div>";
}?>
<div class='table_content'>
    <div class="pagination_links">
        <div class="fl_left"><?=$pagination_links?></div>
        <div class="fl_left width_500 b">Showing <?=$start?>-<?=$end?> of <?=$total?> Subject Distribution</div>
        <div class="fl_right">Sort By: <select name="staffs_id" class="sort_module_dis width_250"><?=combo::get_staff_options($staffs_id)?></select></div>
        <div class="clear"></div>
    </div>
    <table cellpadding="1" cellspacing="1">
        <tr class='title'>
            <th>Staffs ID</th>
            <th>Staffs Name</th>
            <th>Designation</th>
            <th>Class Name</th>
            <th>Subject Name</th>
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
            <td><?=$row['staff_name']?></td>
            <td><?=$row['designation']?></td>
            <td><?=$row['class_name']?></td>
            <td><?=$row['module_name']?></td>
            <td class='view_links'>
                <?php if(common::user_permit('add','module')) {?>
                <a href='<?=site_url('modules/edit_distribution/'.$row['distribution_id'])?>' class="edit_link" title="Change"></a>
                <?php }?>
                <?php if(common::user_permit('delete','module') && $site_data['delete']) {?>
                <a href='<?=site_url('modules/delete_distribution/'.$row['distribution_id'])?>' class="delete_link" title="Delete" onclick='javascript: return confirm("Are you sure you want to delete?");'></a>
                    <?php }?>
            </td>
        </tr>
        <?php $inc++;
    endforeach;
}else {
    echo "<tr><td colspan='5'>No Content Found!!!</td></tr>";
}  ?>
    </table>
    <div class="pagination_links">
        <div class="left"><?=$pagination_links?></div><div class="left width_500 b">Showing <?=$start?>-<?=$end?> of <?=$total?> Subject Distribution</div><div class="right"><?=$prev_next?></div>
        <div class="clear"></div>
    </div>
</div>