<div class='form_content' style="width:880px;">
    <div>
        <form action="<?=site_url('staffs/manage_staffs')?>" method="post">
            <table>
                <tr>
                    <th class="txt_right">Staff ID</th><td><input type="text" name="user_name" value="<?=set_value('user_name')?>" class="text ui-widget-content ui-corner-all width_160" /></td>
                    <th>Last Name</th><td><input type="text" name="name" value="<?=set_value('name')?>" class="text ui-widget-content ui-corner-all width_160" /></td>
                </tr>
                <tr>
                    <th>Staff Status</th><td><select name="staff_status"><?=combo::get_student_status(set_value('staff_status'))?></select></td>
                    <th>Date of Birth</th>
                    <td><input type="text"  name="date_of_birth" value="<?=set_value('date_of_birth')?>" class="text ui-widget-content ui-corner-all date_picker width_160" /></td>
                 </tr>
                 
                <tr>
                    <th class="txt_right">Search Key</th><td><select name="searchField"><?=$this->mod_staffs->get_search_options($_REQUEST['searchField'])?></select></td>
                <th>Search Value</th><td><input type="text" name="searchValue" value="<?=$_REQUEST['searchValue']?>" class="text ui-widget-content ui-corner-all width_160" /></td>
                    <td colspan="4" align="right"><input type='submit' name='apply_filter' value='Search' class='button' /></td>
                </tr>
            </table>
        </form>
    </div>
 </div>
    <script type="text/javascript">
        function doOperation(commnad)
        {
            if(commnad=='add')
            {
                window.location='staffs/new_staff';
            }
            if(commnad=='edit')
            {
                var s=$j("#data_grid").jqGrid('getGridParam','selarrrow');
                if(s.length==0){alert('Please select a Staff!');return false;}
                var id=s[0]; //we will edit only first one in case of multiple selction
                window.location='staffs/edit_staff/'+id;
            }
            if(commnad=='delete')
            {
                operationName=commnad; //save command value for commit data
                var s=$j("#data_grid").jqGrid('getGridParam','selarrrow');
                if(s.length==0){alert('Please select a agents!');return false;}
                var id=s[0]; //we will edit only first one in case of multiple selction
                if(confirm('Are you sure to delete the selected staffs?')){
                    window.location='staffs/delete_staffs/'+id;
                }
            }
            //status command
            if(commnad=='enabled' || commnad=='disabled')
            {
                operationName=commnad; //save command value for commit data
                var s=$j("#data_grid").jqGrid('getGridParam','selarrrow');
                if(s.length==0){alert('Please select a agents!');return false;}
                var id=s[0]; //we will edit only first one in case of multiple selction
                if(confirm('Are you sure to update the status of selected staffs?')){
                    window.location='staffs/staffs_status/'+id+'/'+commnad;
                }
            }
        }
    </script>
    <div style="width:900px;margin:0 auto;">
        <?php if($msg!="") {
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
