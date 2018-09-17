<?php if($msg!="") {
    echo "<div class='success'>$msg</div>";
}?>
<script type="text/javascript">
    function doOperation(command)
    {
        if(command=='add')
        {
            window.location='institution_config/new_type';
        }
        if(command=='edit')
        {
            var s=$j("#data_grid").jqGrid('getGridParam','selarrrow');
            if(s.length==0){alert('Please select a record!');return false;}
            var id=s[0]; //we will edit only first one in case of multiple selction
            
            window.location='institution_config/edit_type/'+id;
        }
        if(command=='delete')
        {
            operationName=command; //save command value for commit data
            var s=$j("#data_grid").jqGrid('getGridParam','selarrrow');
            if(s.length==0){alert('Please select a record!');return false;}
            var id=s[0]; //we will edit only first one in case of multiple selction
            if(confirm('Are you sure to delete the selected type?')){
                window.location='institution_config/delete_type/'+id;
            }
        }
    }
    
</script>
<div class='' style="width:750px;margin:0 auto;">
    <div class="tooolbars fl_left">
        <button id="add" onclick="doOperation('add')">Add</button>
        <button onclick="doOperation('edit')">Edit</button>
        <button onclick="doOperation('delete')">Del</button>
       
    </div>
    
    <div class="clear"></div>
    <hr />
    <?php echo $grid_data?>
</div>