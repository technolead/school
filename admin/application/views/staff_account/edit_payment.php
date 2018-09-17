<div class='form_content'>	
    <h3><?=$page_title?></h3>
    <form action="<?=site_url('staff_account/edit_payment/'.$payment_id)?>" method="post">
        <table>
            <tr>
                <th>Paid Date <span class='required'>*</span></th>
                <td><input type="text" name="paid_date" value="<?=$paid_date?>" class="input_txt width_160 date_picker" /><?=form_error('paid_date','<span>','</span>')?></td>
            </tr>

            <?
                $salary_description="Basic = ".$std_info['amount'];
                $salary_amount=$std_info['amount'];
                if(count($training)>0){
                    foreach($training as $training){
                        $salary_description.=" + ".$training['training_title']." = ".$training['increment'];
                        $salary_amount+=$training['increment'];
                    }
                }

            ?>

            <tr>
                <th>Paid Amount <span class='required'>*</span></th>
                <td><input type="text" name="paid_amount" value="<?=$paid_amount?>" class="input_txt width_160" /><span>[ <?=$salary_description?> ]</span><?=form_error('paid_amount','<span>','</span>')?></td>
            </tr>
            <?if($staff_details['mpo_listed']==1){?>
            <tr>
                <th>MPO Amount <span class='req_mark'>*</span></th>
                <td><input type="text" name="mpo_amount" value="<?=combo::get_mpo_amount($staff_details['designation_id'])?>" readonly class="text ui-widget-content ui-corner-all required width_160" /><?=form_error('mpo_amount','<span>','</span>')?></td>
            </tr>
            <?}?>
            <tr>
                <th>Pay Mood <span class='required'>*</span></th>
                <td><select name="pay_mood"><?=combo::get_type_options('PAY_MOOD',$pay_mood)?></select><?=form_error('pay_mood','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Pay Details <span class='required'>*</span></th>
                <td><select name="pay_details_id"><?=combo::get_pay_details_options('STAFF_PAYMENT',$pay_details_id)?></select><?=form_error('pay_details_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Month <span class='required'>*</span></th>
                <td><select name="month"><?=ahdate::get_month($month)?></select> <select name="year"><?=ahdate::get_year($year)?></select><?=form_error('year','<span>','</span>')?></td>
            </tr>
            <!--<tr>
                <th>Duration <span class='required'>*</span></th>
                <td><input type="text" name="dur_from_date" value="<?=$dur_from_date?>" style="width:80px;" class="input_txt date_picker" /> TO <input type="text" name="dur_to_date" value="<?=$dur_to_date?>" style="width:80px;" class="input_txt date_picker" /><?=form_error('dur_to_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Purpose <span class='required'>*</span></th>
                <td><select name="purpose"><?=combo::get_type_options('PAYMENT_PURPOSE',$purpose)?></select><?=form_error('purpose','<span>','</span>')?></td>
            </tr>-->
            <tr><th>&nbsp;</th>
                <td>
                    <input type='submit' name='update' value='Update' class='button' />  <input type='button' name='cancel' value='Cancel' class='cancel' />
                </td>
            </tr>
        </table>
    </form>
</div>