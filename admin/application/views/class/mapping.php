<script type="text/javascript">
 
    function getClass(ses_id){
        window.location='classes/mapping/'+ses_id;
    }
</script>
<div style="width:900px;margin:0 auto;">
    <?php if($msg!="") {
        echo "<div class='success'>$msg</div>";
    }?>
    <div class="tooolbars fl_left">
        <button id="add" class="jadd_button" title="classes/new_mapping">Add</button>
        <button class="jedit_button" title="classes/edit_mapping">Edit</button>
        <button class="jdelete_button" title="classes/delete_class_map">Del</button>
        <button class="jstatus_button" title="classes/class_map_status/disabled">Activate</button>
        <button class="jstatus_button" title="classes/class_map_status/enabled">Deactivate</button>
    </div>
    <div class="fl_right">Sort By: <select name="session_id" class="ui-widget-content ui-corner-all" onchange="getClass(this.value)" style="padding:0.4em;width:250px;"><?=combo::get_session_options($session_id)?></select></div>
    <div class="clear"></div>
    <hr />
    <?php echo $grid_data?>
</div>