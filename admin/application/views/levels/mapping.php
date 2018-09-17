<script type="text/javascript">
    function doOperation(commnad)
    {
        if(commnad=='add')
        {
            window.location='levels/new_mapping';
        }
        if(commnad=='edit')
        {
            var s=$j("#data_grid").jqGrid('getGridParam','selarrrow');
            if(s.length==0){alert('Please select a Levels!');return false;}
            var id=s[0]; //we will edit only first one in case of multiple selction
            window.location='levels/edit_mapping/'+id;
        }
        if(commnad=='delete')
        {
            operationName=commnad; //save command value for commit data
            var s=$j("#data_grid").jqGrid('getGridParam','selarrrow');
            if(s.length==0){alert('Please select a record!');return false;}
            var id=s[0]; //we will edit only first one in case of multiple selction
            if(confirm('Are you sure to delete the selected Levels?')){
                window.location='levels/delete_mapping/'+id;
            }
        }
        //status command
        if(commnad=='enabled' || commnad=='disabled')
        {
            operationName=commnad; //save command value for commit data
            var s=$j("#data_grid").jqGrid('getGridParam','selarrrow');
            if(s.length==0){alert('Please select a record!');return false;}
            var id=s[0]; //we will edit only first one in case of multiple selction
            if(confirm('Are you sure to update the statue of selected Levels?')){
                window.location='levels/level_map_status/'+id+'/'+commnad;
            }
        }
    }
</script>
<div style="width:900px;margin:0 auto;">
    <?php if($msg!='') {
        echo "<div class='success'>$msg</div>";
    }?>
    <div class="tooolbars">
        <button id="add" onclick="doOperation('add')">Add</button>
        <button onclick="doOperation('edit')">Edit</button>
        <button onclick="doOperation('delete')">Del</button>
        <button onclick="doOperation('disabled')">Activate</button>
        <button onclick="doOperation('enabled')">Deactivate</button>
    </div>
    <hr />
    <?php echo $grid_data?>
</div>