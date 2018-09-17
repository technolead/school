

<div style="width:900px;margin:0 auto;">
    <?php if($msg!="") {
        echo "<div class='success'>$msg</div>";
    }?>
    <div class="tooolbars">
        <button id="add" title="staffs/new_training" class="jadd_button">Add</button>
        <button title="staffs/edit_training" class="jedit_button">Edit</button>
        <button title="staffs/delete_staff_training" class="jdelete_button">Del</button>

    </div>
    <hr />
    <?php echo $grid_data?>
</div>
