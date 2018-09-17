<div class='form_content'>
    <h3><?=$page_title?></h3>
    <?php if($msg!='') {
        echo '<div class="error">'.$msg.'</div>';
    }?>
    <form action='<?=site_url('report/std_vp_report')?>' method='post'>
        <table>
            <tr>
                <th>Programs</th>
                <td><select name="programs_id" class="input_txt jprograms_id"><?=combo::get_programs_options(set_value('programs_id'))?></select><?=form_error('programs_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Current Level</th>
                <td><select name="levels_id" class="jlevels_list jlevel_id"><?=combo::get_program_levels(set_value('programs_id'),set_value('levels_id'))?></select><?=form_error('levels_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Semester</th>
                <td><select name="semester_id" class="input_txt"><?=combo::get_semester_options(set_value('semester_id'))?></select><?=form_error('semester_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Student Status</th>
                <td><select name="student_status" class="input_txt"><?=combo::get_status_options('STUDENT_STATUS',set_value('student_status'))?></select><?=form_error('student_status','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Passport Date</th>
                <td><input type="text"  name="pass_from_date" value="<?=set_value('pass_from_date',date('Y-m-d'))?>" class="date_picker width_80" /> To <input type="text" name="pass_to_date" value="<?=set_value('pass_to_date',date('Y-m-d'))?>" class="date_picker width_80" /></td>
            </tr>
            <tr>
                <th>Visa Date</th>
                <td><input type="text" name="visa_from_date" value="<?=set_value('visa_from_date',date('Y-m-d'))?>" class="date_picker width_80" /> To <input type="text" name="visa_to_date" value="<?=set_value('visa_to_date',date('Y-m-d'))?>" class="date_picker width_80" /></td>
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
        <a href='<?=site_url('create_excel/vp_report_xls/')?>' id="add" class="margin_0_5" title="Create Excel">Create Excel</a>
        <a href='#print_view' rel="<?=site_url('report/print_vp_report/')?>" class="print_view" title="Print View">Print View</a>
    </div>
    <hr />
    <?php echo $grid_data ?>
</div>