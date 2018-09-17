<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url('levels/new_mapping')?>' method='post'>
        <table>
            <tr>
                <th>Awarding Body: <span class='req_mark'>*</span></th>
                <td><select name="awarding_body_id" class="jawarding_body_id ui-widget-content ui-corner-all required"><?=combo::get_awarding_body_options(set_value('awarding_body_id'))?></select><?=form_error('awarding_body_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Program Name: <span class='req_mark'>*</span></th>
                <td><select name="programs_id" class="jprogram_list jprograms_id ui-widget-content ui-corner-all required"><?=combo::get_awarding_body_programs(set_value('awarding_body_id'),set_value('programs_id'))?></select><?=form_error('programs_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Specialization: <span class='req_mark'>*</span></th>
                <td><select name="specialization_id" class="jspecialization_id ui-widget-content ui-corner-all required"><?=combo::get_program_specialization_options(set_value('programs_id'),set_value('specialization_id'))?></select><?=form_error('specialization_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Level <span class='req_mark'>*</span></th>
                <td><select name="levels_id" class="ui-widget-content ui-corner-all required"><?=combo::get_levels_options(set_value('levels_id'))?></select><?=form_error('levels_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Level Duration: <span class='req_mark'>*</span></th>
                <td><input type='text' name='level_duration' value='<?=set_value('level_duration')?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('level_duration','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Level Fee: <span class='req_mark'>*</span></th>
                <td><input type='text' name='level_fee' value='<?=set_value('level_fee')?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('level_fee','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>