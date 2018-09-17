<script type="text/javascript">
    function doOperation(commnad)
    {
        if(commnad=='add')
        {
            window.location='modules/new_mapping';
        }
        if(commnad=='edit')
        {
            var s=$j("#data_grid").jqGrid('getGridParam','selarrrow');
            if(s.length==0){alert('Please select a modules!');return false;}
            var id=s[0]; //we will edit only first one in case of multiple selction
            window.location='modules/edit_mapping/'+id;
        }
        if(commnad=='delete')
        {
            operationName=commnad; //save command value for commit data
            var s=$j("#data_grid").jqGrid('getGridParam','selarrrow');
            if(s.length==0){alert('Please select a record!');return false;}
            var id=s[0]; //we will edit only first one in case of multiple selction
            if(confirm('Are you sure to delete the selected modules?')){
                window.location='modules/delete_module_map/'+id;
            }
        }
        //status command
        if(commnad=='enabled' || commnad=='disabled')
        {
            operationName=commnad; //save command value for commit data
            var s=$j("#data_grid").jqGrid('getGridParam','selarrrow');
            if(s.length==0){alert('Please select a record!');return false;}
            var id=s[0]; //we will edit only first one in case of multiple selction
            if(confirm('Are you sure to update the statue of selected modules?')){
                window.location='modules/module_map_status/'+id+'/'+commnad;
            }
        }
    }
</script>
<div style="width:900px;margin:0 auto;">
    <?php if($msg!='') {
        echo "<div class='success'>$msg</div>";
    }?>
    <div class="tooolbars fl_left">
        <button id="add" onclick="doOperation('add')">Add</button>
        <button onclick="doOperation('edit')">Edit</button>
        <button onclick="doOperation('delete')">Del</button>
        <button onclick="doOperation('disabled')">Activate</button>
        <button onclick="doOperation('enabled')">Deactivate</button>
    </div>
    <div class="fl_right">
        <select name="class_id" class="sort_module_map  ui-widget-content ui-corner-all width_200" style="padding:0.4em;"><?=combo::get_class_options($class_id)?></select>
    </div>
    <div class="clear"></div>
    <hr />
    <?php echo $grid_data?>
</div>