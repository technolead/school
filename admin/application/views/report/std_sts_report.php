<div class='form_content'>
    <h3><?=$page_title?></h3>
    <?php if($msg!='') {
    echo '<div class="error">'.$msg.'</div>';
}?>
    <form action='<?=site_url('report/std_sts_report')?>' method='post'>
        <table>
            <tr>
                <th>Class</th>
                <td><select name="class_id" class="input_txt jclass_id"><?=combo::get_class_options(set_value('class_id',$this->session->userdata('ser_class_id')))?></select><?=form_error('class_id','<span>','</span>')?></td>
            </tr>
            
            <tr>
                <th>Session</th>
                <td><select name="session_id" class="input_txt"><?=combo::get_session_options(set_value('session_id',$this->session->userdata('ser_session_id')))?></select><?=form_error('session_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Student Status</th>
                <td><select name="student_status" class="input_txt"><?=combo::get_student_status(set_value('student_status',$this->session->userdata('ser_student_status')))?></select><?=form_error('student_status','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Date</th>
                <td><input type="text" readonly name="from_date" value="<?=set_value('from_date',date('Y-m-d'))?>" class="date_picker width_80" /> To <input type="text" name="to_date" readonly value="<?=set_value('to_date',date('Y-m-d'))?>" class="date_picker width_80" /></td>
            </tr>
            <tr><th>&nbsp;</th>
                <td><input type='submit' name='gen_report' value='Generate Report' class='button' />  <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>
<div class='grid_area'>
    <?php
    if ($msg != "") {
        echo "<div class='success'>$msg</div>";
    }
    ?>
    <div class="tooolbars">
        <a href='<?=site_url('create_excel/std_status_xls/')?>' id="add" class="" title="Create Excel">Create Excel</a>
        <a href='#print_view' rel="<?=site_url('report/print_sts_report/')?>" class="print_view" title="Print View">Print View</a>
    </div>
    <hr />
    <?php echo $grid_data ?>
</div>