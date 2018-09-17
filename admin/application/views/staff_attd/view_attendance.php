<div class='form_content'>
	<h3><?=$page_title?></h3>
	<?php if($msg!=""){echo "<div class='error'>$msg</div>";}?>
        <form id="valid_form" action='<?=site_url('staff_attd/view_attendance')?>' method='post'>
        <table>
            <tr>
                <th>Staff ID <span class='req_mark'>*</span></th>
                <td><input type='text' autocomplete='off' class='text ui-widget-content ui-corner-all required width_160 jstaff_username'  name='user_name' value='<?=set_value('user_name')?>' /><?=form_error('user_name','<span>','</span>')?><div class="juas_list"></div></td>
            </tr>
			<tr>
                <th>From Date</th>
                <td><input type='text' name='from_date' value='<?=set_value('from_date')?>' class='text ui-widget-content ui-corner-all width_80 date_picker' /><?=form_error('from_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>To Date</th>
                <td><input type='text' name='to_date' value='<?=set_value('to_date')?>' class='text ui-widget-content ui-corner-all width_80 date_picker' /><?=form_error('to_date','<span>','</span>')?></td>
            </tr>
			<tr>
                <th>Month</th>
                <td><select name="month"><?=ahdate::get_month(set_value('month'))?></select> <select name="year"><?=ahdate::get_year(set_value('year'))?></select><?=form_error('year','<span>','</span>')?></td>
            </tr>
            <tr><th>&nbsp;</th><td><input type='submit' name='search' value='View' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>