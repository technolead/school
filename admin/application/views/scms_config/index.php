<?php if($msg!="") {
    echo "<div class='success'>$msg</div>";
}?>
<script type="text/javascript">
    function getTypes(type_for){
        window.location='scms_config/index/'+type_for;
    }
</script>
<div class='' style="width:750px;margin:0 auto;">
    <div class="tooolbars fl_left">
        <button id="add" class="jadd_button" title="scms_config/new_type/<?=$type_for?>">Add</button>
        <button class="jedit_button" title="scms_config/edit_type">Edit</button>
        <button class="jdelete_button" title="scms_config/delete_type">Del</button>
       
    </div>
    <div class="fl_right"> Sort By: <select name="type_for" onchange="getTypes(this.value)"  class="ui-widget-content ui-corner-all required width_200" style="padding:0.4em;"><?=$this->mod_scms_config->type_for_options($type_for)?></select></div>
    <div class="clear"></div>
    <hr />
    <?php echo $grid_data?>
</div>