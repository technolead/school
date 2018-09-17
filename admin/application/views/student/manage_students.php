<div class="form_content" style="width:890px;">
    <form action="<?=site_url('student/manage_students')?>" method="post">
        <table>
            <tr>
                <th class="txt_right">Student ID</th><td><input type="text" name="user_name" value="<?=$this->session->userdata('sess_user_name')?>" class="text ui-widget-content ui-corner-all width_160" /></td>
                <th>Last Name</th><td><input type="text" name="name" value="<?=$this->session->userdata('sess_name')?>" class="text ui-widget-content ui-corner-all width_160" /></td>
                <th>Student Status</th><td><select name="student_status"><?=combo::get_student_status($this->session->userdata('student_status'))?></select></td>
            </tr>
            <tr>
                <th>Date of Birth</th>
                <td><input type="text"  name="date_of_birth" value="<?=set_value('date_of_birth',$this->session->userdata('date_of_birth'))?>" class="date_picker text ui-widget-content ui-corner-all width_80" /></td>
                <th class="txt_right">Class</th><td><select name="class_id" class="width_160"><?=combo::get_class_options($this->session->userdata('class_id'))?></select></td>
                <th>Session</th>
                <td><select name="check_session_id"><?=combo::get_session_options($this->session->userdata('check_session_id'))?></select></td>
            </tr>
            
            <tr>
                <th class="txt_right">Search Key</th><td><select name="searchField"><?=$this->mod_student->get_search_options($_REQUEST['searchField'])?></select></td>
                <th>Search Value</th><td><input type="text" name="searchValue" value="<?=$_REQUEST['searchValue']?>" class="text ui-widget-content ui-corner-all width_160" /></td>
                <td colspan="6" align="right"><input type='submit' name='apply_filter' value='Search' class='button' /></td>
            </tr>
        </table>
    </form>
</div>
<div>

    <div style="width:900px;margin:0 auto;">
        <script type="text/javascript">
            function doOperation(command)
            {
                if(command=='add')
                {
                    window.location='student/new_student';
                }
                if(command=='edit')
                {
                    var s=$j("#data_grid").jqGrid('getGridParam','selarrrow');
                    if(s.length==0){alert('Please select a Student!');return false;}
                    var id=s[0]; //we will edit only first one in case of multiple selction
                    window.location='student/edit_student/'+id;
                }
                if(command=='delete')
                {
                    operationName=command; //save command value for commit data
                    var s=$j("#data_grid").jqGrid('getGridParam','selarrrow');
                    if(s.length==0){alert('Please select a agents!');return false;}
                    var id=s[0]; //we will edit only first one in case of multiple selction
                    if(confirm('Are you sure to delete the selected Student?')){
                        window.location='student/delete_student/'+id;
                    }
                }
                //status command
                if(command=='enabled' || command=='disabled')
                {
                    operationName=command; //save command value for commit data
                    var s=$j("#data_grid").jqGrid('getGridParam','selarrrow');
                    if(s.length==0){alert('Please select a Student!');return false;}
                    // alert(s);
                    var id=s[0]; //we will edit only first one in case of multiple selction
                    if(confirm('Are you sure to update the status of selected Student?')){
                        window.location='student/student_status/'+id+'/'+command;
                    }
                }
                if(command=='xls'){
                    window.location='student/create_xls';
                }
                if(command=='promote_class'){
                    var s=$j("#data_grid").jqGrid('getGridParam','selarrrow');
                    if(s.length==0){alert('Please select a Student!');return false;}

                    $j.ajax({
                        type: "post",
                        url: base_url+"student/session_student_id",
                        data: {
                            student_id:s
                        },
                        success: function(proceed){
                            if(proceed==true){
                                window.location='student/promote_class';
                            }
                        }
                    });
                }
            }
            function sendLetter(){
                var s=$j("#data_grid").jqGrid('getGridParam','selarrrow');
                if(s.length==0){alert('Please select a Student!');return false;}
                var issue_date=$j("input[name='issue_date']").val();
                if(issue_date==''){
                    alert("Please Select an issue date!");
                    return false;
                }
                var letters_id=$j("select[name='letters_id']").val();
                if(letters_id==''){
                    alert("Please select a letter!");
                    return false;
                }
                 var enotify=$j("input[name='enotify']:checked").val();
                    if(enotify!=1){
                        enotify=0;
                    }
                $j.ajax({
                    url:'student/send_letter',
                    type:'post',
                    data:{
                        letters_id:letters_id,issue_date:issue_date,student_list:s,enotify:enotify
                    },
                    success:function(html){
                        alert(html);
                    },
                    error:function(e,m,s){
                        alert(e+m+s);
                    }
                });
                return false;
            }
        </script>

        <div class="tooolbars">
            <button id="add" onclick="doOperation('add')">Add</button>
            <button onclick="doOperation('edit')">Edit</button>
            <button onclick="doOperation('delete')">Del</button>
            <button onclick="doOperation('disabled')">Activate</button>
            <button onclick="doOperation('enabled')">Deactivate</button>
            <button onclick="doOperation('xls')">Create Excel</button>
            <button onclick="doOperation('promote_class')">Promote Class</button>
        </div>
        <hr />

        <?php if($msg!="") {
            echo "<div class='success'>$msg</div>";
        }?>

        <?php echo $grid_data?>

        <hr />
        <div class="form_content txt_center">
            <?php $er=validation_errors();
            if($er!='') {
                echo "<div class='error'>$er</div>";
            }?>
            Email Notify: <input type="checkbox" name="enotify" value="1" checked />
            Issue Letters: <input type="text" name="issue_date" value="<?=date('Y-m-d')?>" class="text ui-widget-content ui-corner-all width_80 date_picker" readonly /> <select name="letters_id"><?=combo::get_letter_options()?></select>	<input type="submit" name="send" value="Send" onclick="sendLetter()" class="button" />
        </div>
    </div>
</div>