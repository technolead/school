<?php if($msg!="") {
    echo "<div class='success'>$msg</div>";
}?>

<div class='' style="width:750px;margin:0 auto;">
    <div class="tooolbars fl_left">
        <button id="add" class="jadd_button" title="scms_config/new_report_status">Add</button>
        <button class="jedit_button" title="scms_config/edit_report_status">Edit</button>
        <button class="jdelete_button" title="scms_config/delete_report_status">Del</button>

    </div>
    
    <div class="clear"></div>
    <hr />
    <?php echo $grid_data?>
</div>