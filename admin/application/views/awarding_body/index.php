<?php if($msg!="") {
    echo "<div class='success'>$msg</div>";
}?>
<script type="text/javascript">
    function doOperation(commnad)
    {
        if(commnad=='add')
        {
            window.location='awarding_body/new_awarding_body';
        }
        if(commnad=='edit')
        {
            var s=$j("#data_grid").jqGrid('getGridParam','selarrrow');
            if(s.length==0){alert('Please select a record!');return false;}
            var id=s[0]; //we will edit only first one in case of multiple selction
            window.location='awarding_body/edit_awarding_body/'+id;
        }
        if(commnad=='delete')
        {
            operationName=commnad; //save command value for commit data
            var s=$j("#data_grid").jqGrid('getGridParam','selarrrow');
            if(s.length==0){alert('Please select a record!');return false;}
            var id=s[0]; //we will edit only first one in case of multiple selction
            if(confirm('Are you sure to delete the selected type?')){
                window.location='awarding_body/delete_awarding_body/'+id;
            }
        }
        if(commnad=='enabled' || commnad=='disabled')
        {
            operationName=commnad; //save command value for commit data
            var s=$j("#data_grid").jqGrid('getGridParam','selarrrow');
            if(s.length==0){alert('Please select a record!');return false;}
            var id=s[0]; //we will edit only first one in case of multiple selction
            if(confirm('Are you sure to update the status of selected user?')){
                window.location='awarding_body/awarding_body_status/'+id+'/'+commnad;
            }
        }
    }
  
</script>
<div class='' style="width:750px;margin:0 auto;">
    <div class="tooolbars fl_left">
        <button id="add" onclick="doOperation('add')">Add</button>
        <button onclick="doOperation('edit')">Edit</button>
        <button onclick="doOperation('delete')">Del</button>
         <button onclick="doOperation('disabled')">Activate</button>
        <button onclick="doOperation('enabled')">Deactivate</button>
    </div>
    <div class="clear"></div>
    <hr />
    <?php echo $grid_data?>
</div>