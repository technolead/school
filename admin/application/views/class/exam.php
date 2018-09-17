<?php if($msg!="") {
    echo "<div class='success'>$msg</div>";
}?>

<div style="width:750px;margin:0 auto;">
    <div class="tooolbars">
        <button id="add" class="jadd_button" title="classes/new_exam">Add</button>
        <button class="jedit_button" title="classes/edit_exam">Edit</button>
        <button class="jdelete_button" title="classes/delete_exam">Del</button>
        
    </div>
    <hr />
    <?php echo $grid_data?>
</div>