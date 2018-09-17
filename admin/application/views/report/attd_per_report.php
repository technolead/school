<style type="text/css">
    .grid_area table.ui-jqgrid-htable th{vertical-align:middle;}
    .grid_area table.ui-jqgrid-htable th div{height:30px;}
</style>
<div class='form_content'>
    <h3><?=$page_title?></h3>
    <?php if($msg!='') {
        echo '<div class="error">'.$msg.'</div>';
    }?>
    <form action='<?=site_url('report/attd_per_report')?>' method='post'>
        <table>
            <tr>
                <th>Class</th>
                <td><select name="class_id" class="input_txt jclass_id"><?=combo::get_class_options(set_value('class_id'))?></select><?=form_error('class_id','<span>','</span>')?></td>
            </tr>
            
            <tr>
                <th>Session</th>
                <td><select name="session_id" class="input_txt"><?=combo::get_session_options(set_value('session_id'))?></select><?=form_error('session_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Final Status</th>
                <td><select name="student_status" class="input_txt"><?=combo::get_status_options('STUDENT_STATUS',set_value('student_status'))?></select><?=form_error('student_status','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Percentage</th>
                <td><select name="percentage"><?=$this->mod_attendance->get_attd_per_options(set_value('percentage'))?></select></td>
            </tr>
            <!--
            <tr>
                <th>Date</th>
                <td><input type="text" name="from_date" value="<?=set_value('from_date',date('Y-m-d'))?>" class="date_picker width_80" /> To <input type="text" name="to_date" value="<?=set_value('to_date',date('Y-m-d'))?>" class="date_picker width_80" /></td>
            </tr>
            -->
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
        <a href='#print_view' rel="<?=site_url('report/print_attd_per_report/')?>" id="add" class="print_view" title="Print View">Print View</a>
    </div>
    <hr />
    <?php echo $grid_data ?>
</div>
<?php if(count($rows)>0) {?>
<div class='table_content'>
    <div class="pagination_links">
        <div class="left b">Attendance Report (Percentage)</div>
        <a href='#print_view' rel="<?=site_url('report/print_attd_per_report/')?>" class="print_view right" title="Print View">Print View</a>
        <div class="clear"></div>
    </div>
     <div class="pagination_links">
        <div class="fl_left bold">Showing <?=$start?>-<?=$end?> of <?=$total?></div>
         <div class="fl_right"><?=$pagination_links?></div>
        <div class="clear"></div>
    </div>
    <table cellpadding="0" cellspacing="1">
        <tr class='title'>
            <th>Student Name</th>
            <th>class Name</th>
            <th>Final Status</th>
            <th>Level Name</th>
            <th>session Name</th>
            <th>Continues missed</th>
            <th>Percentage</th>
        </tr>
            <?php
            $inc=1;
            foreach($rows as $row):?>
        <tr <?php if($inc%2==0) {
                    echo "class='even'";
                }else {
                    echo "class='odd'";
                    }?>>
            <td><?=$row['student_name']?></td>
            <td><?=$row['class_name']?></td>
            <td><?=$row['student_status']?></td>
            <td><?=$row['level_name']?></td>
            <td><?=$row['session_name']?></td>
            <th title="From <?=$row['from_date'].' To '.$row['to_date']?>" class="<?=common::get_attd_status_view($row['absent'])?>"><?=$row['absent']?></th>
            <th><?=round($row['percentage'],2)?>%</th>
        </tr>
                <?php $inc++;
            endforeach;
            ?>
    </table>
     <div class="pagination_links">
        <div class="fl_left bold">Showing <?=$start?>-<?=$end?> of <?=$total?></div>
         <div class="fl_right"><?=$pagination_links?></div>
        <div class="clear"></div>
    </div>
</div>
    <?php }?>