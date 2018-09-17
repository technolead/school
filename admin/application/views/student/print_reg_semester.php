<div class='form_content'>
    <table cellspacing="0" cellpadding="0">
        <tr><th>Student ID</th><td><?=$user_name?></td></tr>
        <tr><th>Student Name</th><td><?=$student_name?></td></tr>
        <tr><th>Email</th><td><?=$email?></td></tr>
        <tr><th>Program Name</th><td><?=$program_name?></td></tr>
        <tr><th>Level Name</th><td><?=$level_name?></td></tr>
        <tr><th>Semester Name</th><td><?=$semester_name?></td></tr>
        <tr><th>Semester Duration</th><td><?=$semester_duration?></td></tr>
        <tr><th>Enrolment Date</th><td><?=$enrolment_date?></td></tr>
        <tr><th>Start Date</th><td><?=$start_date?></td></tr>
        <tr><th>End Date</th><td><?=$end_date?></td></tr>
        <tr><th>Semester Status</th><td><?=$semester_status?></td></tr>
        <tr><th>Status Change Date</th><td><?=$semester_status_date?></td></tr>
    </table>
    <h3>Module Registration</h3>
    <table cellspacing="0" cellpadding="0">
        <tr class="title"><th>Module Name (taken for this semester)</th><th>Level</th><th>Module Status</th><th>Attempt</th><th>Module Comment</th></tr>
        <?php
        if(count($reg_mod)>0) {
            foreach($reg_mod as $row): ?>
        <tr>
            <td style="border-right:1px solid #333;"><?=$row['module_name']?></td>
            <td style="border-right:1px solid #333;"><?=$this->mod_student->get_levels_name($row['module_id'])?></td>
            <td style="border-right:1px solid #333;"><?=$row['module_status']?></td>
            <td style="border-right:1px solid #333;"><?=$row['module_attempt']?></td>
            <td><?=$row['module_comment']?>&nbsp;</td>
        </tr>
            <?php endforeach;
}  ?>
    </table> <br />
    <!--
    <h3>DECLARATION:</h3>
    <p>I give consent to the processing of these data by LVC for educational purposes under the provision of the Data
        Protection Act 1998. I also confirm that I have read and understood the terms and conditions of
        Enrolment, the <strong>Student Handbook</strong> and the general principles of <strong>Health and Safety</strong>.</p>
    <p>I also declare that if there is any changes in my contact details e.g. Residential Address,
        Telephone/Mobile, E-mail address or any other changes in my personal circumstances, I will notify the
        College immediately.</p>
    -->
    <table cellspacing="0" cellpadding="0">
        <tr><th>Signature</th><td style="border-right:1px solid #333;">&nbsp;</td><th>Date</th><td>&nbsp;</td></tr>
    </table>
    <h3 style="border-bottom:1px dotted #333">Office Use Only:</h3>
    <table cellspacing="0" cellpadding="0">
        <tr><th>Personal Tutor</th><td><?=$tutor_name?>&nbsp;</td></tr>
        <tr><th>Comments</th><td style="height:100px;">&nbsp;</td></tr>
        <tr><th>Special Needs</th><td>&nbsp;</td></tr>
    </table>
</div>