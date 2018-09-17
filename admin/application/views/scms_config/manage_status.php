<?php if($msg!="") {
    echo "<div class='success'>$msg</div>";
}?>
<script type="text/javascript">
    function getStatus(status_for){
        window.location='scms_config/manage_status/'+status_for;
    }
</script>
<div class='' style="width:750px;margin:0 auto;">
    <div class="tooolbars fl_left">
        <button id="add" class="jadd_button" title="scms_config/new_status/<?=$status_for?>">Add</button>
        <button class="jedit_button" title="scms_config/edit_status">Edit</button>
        <button class="jdelete_button" title="scms_config/delete_status">Del</button>

    </div>
    <div class="fl_right"> Sort By: <select name="status_for" onchange="getStatus(this.value)"  class="ui-widget-content ui-corner-all required width_200" style="padding:0.4em;"><?=$this->mod_scms_config->status_for_options($status_for)?></select></div>
    <div class="clear"></div>
    <hr />
    <?php echo $grid_data?>
</div>