<?php if($msg!="") {
    echo "<div class='success'>$msg</div>";
}?>
<script type="text/javascript" language="javascript">
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
<div class="form_content">
     <form action="<?=site_url('alert/attendance')?>" method="post">
        <table>
            <tr>
                <th class="txt_right">Search Key</th><td><select name="searchField"><?=$this->mod_alert->get_attd_search_options($_REQUEST['searchField'])?></select></td>
                <th>Search Value</th><td><input type="text" name="searchValue" value="<?=$_REQUEST['searchValue']?>" class="text ui-widget-content ui-corner-all width_160" /></td>
            </tr>
            <tr>
                <td colspan="4" align="right"><input type='submit' name='apply_filter' value='Search' class='button' /></td>
            </tr>
        </table>
    </form>

</div>
<div style="width:900px;margin:0 auto;">
    <div class="tooolbars">
        <button id="add" class="jadd_button" title="alert/create_xls">Create Excel</button>
    </div>
    <hr />
    <?php echo $attd_grid_data?>
    <hr />
    <div class="form_content txt_center">
        <?php $er=validation_errors();
        if($er!='') {
            echo "<div class='error'>$er</div>";
        }?>
        Email Notify: <input type="checkbox" name="enotify" value="1" />
        Issue Letters: <input type="text" name="issue_date" value="<?=date('Y-m-d')?>" class="text ui-widget-content ui-corner-all width_80 date_picker" readonly /> <select name="letters_id"><?=$letters?></select>	<input type="submit" name="send" value="Send" onclick="sendLetter()" class="button" />
    </div>
</div>
