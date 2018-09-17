<?php if($msg!="") {
    echo "<div class='success'>$msg</div>";
}?>

<div class='' style="width:750px;margin:0 auto;">
    <div class="tooolbars fl_left">
        <button id="add" title="institution_config/new_class" class="jadd_button">Add</button>
        <button title="institution_config/edit_class" class="jedit_button">Edit</button>
        <button title="institution_config/delete_class" class="jdelete_button">Del</button>

    </div>

    <div class="clear"></div>
    <hr />
    <?php echo $grid_data?>
</div>