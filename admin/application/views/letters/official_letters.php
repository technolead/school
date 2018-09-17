
<div class='' style="width:900px;margin:0 auto;">
    <?php if($msg!="") {
        echo "<div class='success'>$msg</div>";
    }?>
    <div class="tooolbars fl_left">
        <button id="add" title="letters/new_official_letter" class="jadd_button">Add</button>
        <button title="letters/edit_official_letter" class="jedit_button">Edit</button>
        <button title="letters/delete_official_letters" class="jdelete_button">Del</button>
    </div>
    <div class="clear"></div>
    <hr />
    <?php echo $grid_data?>
</div>