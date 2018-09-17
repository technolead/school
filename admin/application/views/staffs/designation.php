<?php if($msg!="") {
    echo "<div class='success'>$msg</div>";
}?>

<div style="width:750px;margin:0 auto;">
    <div class="tooolbars">
        <button id="add" class="jadd_button" title="staffs/new_designation">Add</button>
        <button class="jedit_button" title="staffs/edit_designation">Edit</button>
        <button class="jdelete_button" title="staffs/delete_designation">Delete</button>
        
    </div>
    <hr />
    <?php echo $grid_data?>
</div>