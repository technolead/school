
<div style="width:900px;margin:0 auto;">
    <?php if($msg!='') {
        echo "<div class='success'>$msg</div>";
    }?>
    <div class="tooolbars fl_left">
        <button id="add" class="jadd_button" title="session/new_mapping">Add</button>
        <button class="jedit_button" title="session/edit_mapping">Edit</button>
        <button class="jdelete_button" title="session/delete_session_map">Del</button>
        <button class="jstatus_button" title="session/session_map_status/disabled">Activate</button>
        <button class="jstatus_button" title="session/session_map_status/enabled">Deactivate</button>
    </div>
    <div class="fl_right">Sort By: <select name="jsession_id" class="sort_session_map ui-widget-content ui-corner-all" style="padding:0.4em;"><?=combo::get_session_options($session_id)?></select></div>
    <div class="clear"></div>
    <div class="clear"></div>
    <hr />
    <?php echo $grid_data?>
</div>