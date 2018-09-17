<?php if($msg!="") {
    echo "<div class='success'>$msg</div>";
}?>
<div class="form_content">
    <h3>Apply Filter</h3>
    <form action="<?=site_url('attendance/view_summary')?>" method="post">
        <table>
            <tr>
                <th>Class</th>
                <td><select name="class_id" class="jclass_list jclass_id jclass_module ui-corner-all"><?=combo::get_class_options(set_value('class_id'))?></select><?=form_error('module_id','<span>','</span>')?></td>
            </tr>
            
            <tr>
                <th>Session</th>
                <td><select name="session_id" class="ui-corner-all"><?=combo::get_session_options(set_value('session_id'))?></select><?=form_error('session_id','<span>','</span>')?></td>
            </tr>
            
            <tr>
                <th>Date</th>
                <td><input type='text' name='from_date' value='<?=set_value('from_date')?>' class='text ui-widget-content ui-corner-all width_80 date_picker' /><?=form_error('from_date','<span>','</span>')?> To <input type='text' name='from_date' value='<?=set_value('to_date')?>' class='text ui-widget-content ui-corner-all width_80 date_picker' /><?=form_error('to_date','<span>','</span>')?></td>
            </tr>
            
            <tr>
                <th>Continuous Miss</th>
                <td><select name="absent"><?=$this->mod_attendance->get_attd_class_options(set_value('absent'))?></select></td>
            </tr>
            <tr>
                <th>Total attendance</th>
                <td><select name="percentage"><?=$this->mod_attendance->get_attd_per_options(set_value('percentage'))?></select></td>
            </tr>
            <tr><th>&nbsp;</th>
                <td><input type='submit' name='apply_filter' value='Search' class='button' /></td>
            </tr>
        </table>
    </form>
</div>
<div class='table_content'>
    <form action="<?=site_url('attendance/view_summary')?>" method="post">
        <div class="pagination_links">
            <div class="left">
                <?=$pagination_links?> <span class="b margin_0_10">Showing <?=$start?>-<?=$end?> of <?=$total?> Student Attendance Summary</span>
            </div>
            <div class="clear"></div>
        </div>
        <table cellspacing='1'>
            <tr class='title'>
                <th><input type="checkbox" name="sel_all" value="1"  class="jsel_all" /></th>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Class</th>
                <th title="Continues miss">Continuous miss</th>
                <th>Total attendance</th>
                <th>Exemption</th>
            </tr>
            <?php if(count($rows)>0) {
                $inc=1;
                foreach($rows as $row):
                    ?>
            <tr <?php if($inc%2==0) {
                        echo "class='even'";
                    }else {
                        echo "class='odd'";
                        }?>>
                <th><input type="checkbox" name="student_id[]" value="<?=$row['student_id']?>" class="select_std" /></th>
                <td class="b" title="<?=$row['letter_sent_day']?>"><?=$row['first_name'].' '.$row['last_name']?></td>
                <td title="<?=$row['student_id']?>"><?=$row['user_name']?></td>
                <td><?=$row['class_name']?></td>
                <th title="From <?=$row['from_date'].' To '.$row['to_date']?>" class="<?=common::get_attd_status_view($row['absent'])?>"><?=$row['absent']?></th>
                <th class="<?=common::get_color_code($row['percentage'])?>">
                            <?=round($row['percentage'],2)?>%</th>
                <th><?php if(sql::count('exemption',"student_id=$row[student_id]")>0) {?><a href="<?=site_url("?c=attendance&m=exemption&student_id=$row[student_id]")?>&height=200&width=300" title="Exemption [<?=$row['first_name'].' '.$row['last_name']?>]" class="thickbox">Yes</a><?php }else echo 'No';?></th>
            </tr>
                    <?php $inc++;
                endforeach;
            }else {
                echo "<tr><td colspan='4'>No Content Found!!!</td></tr>";
            }  ?></table>
        
        <!--<div class="pagination_links b">
            <?php $er=validation_errors();
            if($er!='') {
                echo "<div class='error'>$er</div>";
            }?>
            Email Notify: <input type="checkbox" name="enotify" value="1" checked />
            Issue Letters:
            <input type="text" name="issue_date" value="<?=date('Y-m-d')?>" readonly class="width_80 date_picker" />
            <select name="letters_id"><?=$this->mod_attendance->get_letter_options()?></select>
            <input type="submit" name="send" value="Send" onclick="sendLetter()" class="button" />
        </div>-->
        
        <div class="pagination_links">
            <div class="left"><?=$pagination_links?> <span class="b margin_0_10">Showing <?=$start?>-<?=$end?> of <?=$total?> Student Attendance Summary</span></div><div class="right"><?=$prev_next?></div>
            <div class="clear"></div>
        </div>
    </form>
</div>