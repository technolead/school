
<div class='form_content margin_10_0'>
    <table cellpadding="1" cellspacing="1">

        <tr>
            <th>Session : </th><td><?=$routine[0]['session_name']?></td>
        </tr>
        <tr>
            <th>Class : </th><td><?=$routine[0]['class_name']?></td>
        </tr>
        <tr>
            <th>Section : </th><td><?=$routine[0]['section']?></td>
        </tr>

    </table>
</div>




<div class='table_content'>
    <form id="valid_form" action="<?=site_url($action)?>" method="post">

        <?php if(validation_errors()){ echo "<div style='color:red;font-size:11px;text-align:left;'>".validation_errors()."</div>";}?>

        <div class="txt_center">
            <span class="routine_link" title="saturday" > [ Saturday ]</span>
            <div id="div_saturday" style="margin: 10px 0px;">
                <table cellpadding="1" cellspacing="1">
            <tr class='title'>
                <th>Period</th>
                <th>Time</th>
                <th>Subject</th>
                <th>Teacher</th>

            </tr>
            <input type="hidden" name="day[]" value="saturday" />
            <?

            $details=combo::get_routine_details($routine[0]['class_routine_id'],'saturday');
            $day="saturday";
            for($i=0;$i<8;$i++){?>
            
            <tr>
                <td align="center">
                    <select name="period_<?=$day?>_<?=$i?>" class="jperiod_<?=$day?>_<?=$i?>">
                        <?=combo::get_period_options($details[$i]['period'])?>
                    </select>
                </td>
                <td align="center">
                    <input type="text" name="time_<?=$day?>_<?=$i?>" value="<?=$details[$i]['time']?>" />
                </td>
                <td align="center">
                    <select name="module_id_<?=$day?>_<?=$i?>" title="<?=$routine[0]['class_id']?>"  id="<?=$day."_".$i?>" class="jmodule_staff"><?=combo::get_class_module($routine[0]['class_id'],$details[$i]['module_id'])?></select>
                </td>

                <td align="center">
                    <select name="staffs_id_<?=$day?>_<?=$i?>" title="<?=$day?>_<?=$i?>" class="jstaff jmodule_staff_list_<?=$day."_".$i?>">
                        <?if($details[$i]['module_id']!=''){?>
                            <?=combo::get_assigned_staff($details[$i]['module_id'],$routine[0]['class_id'],$details[$i]['staffs_id'])?>
                        <?}else{?>
                            <option value=""> Select Staff</option>
                        <?}?>
                    </select>
                </td>
                <?}?>

              </tr>
                </table>
            </div>
        </div>


        <div class="txt_center">
            <span class="routine_link" title="sunday" > [ Sunday ]</span>
            <div id="div_sunday" style="margin: 10px 0px;">
                <table cellpadding="1" cellspacing="1">
            <tr class='title'>
                <th>Period</th>
                <th>Time</th>
                <th>Subject</th>
                <th>Teacher</th>

            </tr>
            <input type="hidden" name="day[]" value="sunday" />
            <?

            $details=combo::get_routine_details($routine[0]['class_routine_id'],'sunday');
            $day="sunday";
            for($i=0;$i<8;$i++){?>

            <tr>
                <td align="center">
                    <select name="period_<?=$day?>_<?=$i?>" class="jperiod_<?=$day?>_<?=$i?>">
                        <?=combo::get_period_options($details[$i]['period'])?>
                    </select>
                </td>
                <td align="center">
                    <input type="text" name="time_<?=$day?>_<?=$i?>" value="<?=$details[$i]['time']?>" />
                </td>
                <td align="center">
                    <select name="module_id_<?=$day?>_<?=$i?>" title="<?=$routine[0]['class_id']?>"  id="<?=$day."_".$i?>" class="jmodule_staff"><?=combo::get_class_module($routine[0]['class_id'],$details[$i]['module_id'])?></select>
                </td>

                <td align="center">
                    <select name="staffs_id_<?=$day?>_<?=$i?>" title="<?=$day?>_<?=$i?>" class="jstaff jmodule_staff_list_<?=$day."_".$i?>">
                        <?if($details[$i]['module_id']!=''){?>
                            <?=combo::get_assigned_staff($details[$i]['module_id'],$routine[0]['class_id'],$details[$i]['staffs_id'])?>
                        <?}else{?>
                            <option value=""> Select Staff</option>
                        <?}?>
                    </select>
                </td>
                <?}?>

              </tr>
                </table>
            </div>
        </div>

        <div class="txt_center">
            <span class="routine_link" title="monday" > [ Monday ]</span>
            <div id="div_monday" style="margin: 10px 0px;">
                    <table cellpadding="1" cellspacing="1">
            <tr class='title'>
                <th>Period</th>
                <th>Time</th>
                <th>Subject</th>
                <th>Teacher</th>

            </tr>


            <input type="hidden" name="day[]" value="monday" />
            <?
                $details=combo::get_routine_details($routine[0]['class_routine_id'],'monday');
                $day="monday";
            for($i=0;$i<8;$i++){?>

            <tr>
                <td align="center">
                    <select name="period_<?=$day?>_<?=$i?>" class="jperiod_<?=$day?>_<?=$i?>">
                        <?=combo::get_period_options($details[$i]['period'])?>
                    </select>
                </td>
                <td align="center">
                    <input type="text" name="time_<?=$day?>_<?=$i?>" value="<?=$details[$i]['time']?>" />
                </td>
                <td align="center">
                    <select name="module_id_<?=$day?>_<?=$i?>" title="<?=$routine[0]['class_id']?>"  id="<?=$day."_".$i?>" class="jmodule_staff"><?=combo::get_class_module($routine[0]['class_id'],$details[$i]['module_id'])?></select>
                </td>

                <td align="center">
                    <select name="staffs_id_<?=$day?>_<?=$i?>" title="<?=$day?>_<?=$i?>" class="jstaff jmodule_staff_list_<?=$day."_".$i?>">
                        <?if($details[$i]['module_id']!=''){?>
                            <?=combo::get_assigned_staff($details[$i]['module_id'],$routine[0]['class_id'],$details[$i]['staffs_id'])?>
                        <?}else{?>
                            <option value=""> Select Staff</option>
                        <?}?>
                    </select>
                </td>
                <?}?>

            </tr>


        </table>


            </div>
        </div>

        <div class="txt_center">
            <span class="routine_link" title="tuesday" > [ Tuesday ]</span>
            <div id="div_tuesday" style="margin: 10px 0px;">
                <table cellpadding="1" cellspacing="1">
            <tr class='title'>
                <th>Period</th>
                <th>Time</th>
                <th>Subject</th>
                <th>Teacher</th>

            </tr>


            <input type="hidden" name="day[]" value="tuesday" />
            <? $details=combo::get_routine_details($routine[0]['class_routine_id'],'tuesday');
                $day="tuesday";
            for($i=0;$i<8;$i++){?>

            <tr>
                <td align="center">
                    <select name="period_<?=$day?>_<?=$i?>" class="jperiod_<?=$day?>_<?=$i?>">
                        <?=combo::get_period_options($details[$i]['period'])?>
                    </select>
                </td>
                <td align="center">
                    <input type="text" name="time_<?=$day?>_<?=$i?>" value="<?=$details[$i]['time']?>" />
                </td>
                <td align="center">
                    <select name="module_id_<?=$day?>_<?=$i?>" title="<?=$routine[0]['class_id']?>"  id="<?=$day."_".$i?>" class="jmodule_staff"><?=combo::get_class_module($routine[0]['class_id'],$details[$i]['module_id'])?></select>
                </td>

                <td align="center">
                    <select name="staffs_id_<?=$day?>_<?=$i?>" title="<?=$day?>_<?=$i?>" class="jstaff jmodule_staff_list_<?=$day."_".$i?>">
                        <?if($details[$i]['module_id']!=''){?>
                            <?=combo::get_assigned_staff($details[$i]['module_id'],$routine[0]['class_id'],$details[$i]['staffs_id'])?>
                        <?}else{?>
                            <option value=""> Select Staff</option>
                        <?}?>
                    </select>
                </td>
                <?}?>

            </tr>


        </table>

            </div>
        </div>

        <div class="txt_center">
            <span class="routine_link" title="wednesday" > [ Wednesday ]</span>
            <div id="div_wednesday" style="margin: 10px 0px;">
                
                <table cellpadding="1" cellspacing="1">
            <tr class='title'>
                <th>Period</th>
                <th>Time</th>
                <th>Subject</th>
                <th>Teacher</th>

            </tr>


            <input type="hidden" name="day[]" value="wednesday" />
            <? $details=combo::get_routine_details($routine[0]['class_routine_id'],'wednesday');
                $day="wednesday";
            for($i=0;$i<8;$i++){?>

            <tr>
                <td align="center">
                    <select name="period_<?=$day?>_<?=$i?>" class="jperiod_<?=$day?>_<?=$i?>">
                        <?=combo::get_period_options($details[$i]['period'])?>
                    </select>
                </td>
                <td align="center">
                    <input type="text" name="time_<?=$day?>_<?=$i?>" value="<?=$details[$i]['time']?>" />
                </td>
                <td align="center">
                    <select name="module_id_<?=$day?>_<?=$i?>" title="<?=$routine[0]['class_id']?>"  id="<?=$day."_".$i?>" class="jmodule_staff"><?=combo::get_class_module($routine[0]['class_id'],$details[$i]['module_id'])?></select>
                </td>

                <td align="center">
                    <select name="staffs_id_<?=$day?>_<?=$i?>" title="<?=$day?>_<?=$i?>" class="jstaff jmodule_staff_list_<?=$day."_".$i?>">
                        <?if($details[$i]['module_id']!=''){?>
                            <?=combo::get_assigned_staff($details[$i]['module_id'],$routine[0]['class_id'],$details[$i]['staffs_id'])?>
                        <?}else{?>
                            <option value=""> Select Staff</option>
                        <?}?>
                    </select>
                </td>
                <?}?>

            </tr>


        </table>
            </div>
        </div>

        <div class="txt_center">
            <span class="routine_link" title="thursday" > [ Thursday ]</span>
            <div id="div_thursday" style="margin: 10px 0px;">
                
                    <table cellpadding="1" cellspacing="1">
            <tr class='title'>
                <th>Period</th>
                <th>Time</th>
                <th>Subject</th>
                <th>Teacher</th>

            </tr>


            <input type="hidden" name="day[]" value="thursday" />
            <? $details=combo::get_routine_details($routine[0]['class_routine_id'],'thursday');
                $day="thursday";
            for($i=0;$i<8;$i++){?>

            <tr>
                <td align="center">
                    <select name="period_<?=$day?>_<?=$i?>" class="jperiod_<?=$day?>_<?=$i?>">
                        <?=combo::get_period_options($details[$i]['period'])?>
                    </select>
                </td>
                <td align="center">
                    <input type="text" name="time_<?=$day?>_<?=$i?>" value="<?=$details[$i]['time']?>" />
                </td>
                <td align="center">
                    <select name="module_id_<?=$day?>_<?=$i?>" title="<?=$routine[0]['class_id']?>"  id="<?=$day."_".$i?>" class="jmodule_staff"><?=combo::get_class_module($routine[0]['class_id'],$details[$i]['module_id'])?></select>
                </td>

                <td align="center">
                    <select name="staffs_id_<?=$day?>_<?=$i?>" title="<?=$day?>_<?=$i?>" class="jstaff jmodule_staff_list_<?=$day."_".$i?>">
                        <?if($details[$i]['module_id']!=''){?>
                            <?=combo::get_assigned_staff($details[$i]['module_id'],$routine[0]['class_id'],$details[$i]['staffs_id'])?>
                        <?}else{?>
                            <option value=""> Select Staff</option>
                        <?}?>
                    </select>
                </td>
                <?}?>

            </tr>


        </table>
            </div>
        </div>



        <div class="txt_center margin_10_0">
            
            <input type='submit' name='update' value='Update' class='button' />
            <input type='button' name='cancel' value='Cancel' class='cancel' />
        </div>
    </form>
</div>