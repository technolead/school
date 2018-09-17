<?php $sess_ins_data=common::get_institution();?>
<div class="form_content">
    <table cellpadding="0" cellspacing="0">
        <tr><th style="width:120px;">Application Date:</th><td class="border_right" style="width:120px;"><?=$admission_date?>&nbsp;</td><th style="width:90px;">Student ID : &nbsp;</th><td class="border_right" style="width:90px;"><?=$user_name?>&nbsp;</td><th style="width:80px;">CAS No: &nbsp;</th><td><?=$cas?>&nbsp;</td></tr>
    </table>
</div>
<div class='form_content'>
    <h3>Personal Details:</h3>
    <table cellspacing='0' cellpadding='0'>
        <tr><th>Title </th><td class="border_right"><?=$title?>&nbsp;</td><th>Last Name </th><td class="border_right"><?=$last_name?>&nbsp;</td><th>First Name </th><td><?=$first_name?>&nbsp;</td></tr>
        <tr><th>Date of Birth</th><td class="border_right"><?=$date_of_birth?>&nbsp;</td><th>Age </th><td class="border_right"><?=$age?>&nbsp;&nbsp;</td><th>Gender </th><td><?=$gender?>&nbsp;</td></tr>
        <tr><th>Nationality </th><td class="border_right"><?=$nationality?>&nbsp;</td><th>Passport No </th><td class="border_right"><?=$passport_no?>&nbsp;</td><th>Passport Expiry </th><td><?=$passport_expiry?>&nbsp;</td></tr>
        <tr><th>UK Entry Date</th><td class="border_right"><?=$entry_to_uk?>&nbsp;</td><th>Visa Expiry Date</th><td class="border_right"><?=$visa_expiry?>&nbsp;</td><th>Visa Status </th><td><?=$visa_status?>&nbsp;</td></tr>
    </table>
    <div class="fl_left width_300">
        <h3>Correspondence Address (Home Country) :</h3>
        <table cellpadding="0" cellspacing="0">
            <tr><th>Present Address </th><td><?=nl2br($present_address)?>&nbsp;</td></tr>
            <tr><th>Telephone(UK)</th><td><?=$phone_uk?>&nbsp;</td></tr>
            <tr><th>Mobile</th><td><?=$mobile?>&nbsp;</td></tr>
            <tr><th>Email </th><td><?=$email?>&nbsp;</td></tr>
        </table>
    </div>
    <div class="fl_right width_300">
        <h3>Correspondence Address (UK):</h3>
        <table cellpadding="0" cellspacing="0">
            <tr><th>Permanent Address</th><td><?=nl2br($permanent_address)?>&nbsp;</td></tr>
            <tr><th>Telephone(Overseas)</th><td><?=$phone_overseas?>&nbsp;</td></tr>
            <tr><th>Mobile</th><td><?=$mobile?>&nbsp;</td></tr>
            <tr><th>Email </th><td><?=$email?>&nbsp;</td></tr>
        </table>
    </div>
    <div class="clear"></div>
</div>
<div class='form_content'>
    <h3>Next Of Kin (Home Country)</h3>
    <table cellspacing='0' cellpadding='0'>
        <tr><th>Name of the Next of Kin</th><td class="border_right"><?=$kin_name?>&nbsp;</td><th>Relationship with Student</th><td><?=$kin_relation?>&nbsp;</td></tr>
        <tr><th>Address</th><td class="border_right"><?=nl2br($kin_address)?>&nbsp;</td><th>Telephone No</th><td><?=$kin_phone?>&nbsp;</td></tr>
        <tr><th>Mobile No</th><td class="border_right"><?=$kin_mobile?>&nbsp;</td><th>Fax No</th><td><?=$kin_fax?>&nbsp;</td></tr>
        <tr><th>Email</th><td colspan="3"><?=$kin_email?>&nbsp;</td></tr>
    </table>
</div>
<div class='form_content'>
    <h3>Next Of Kin (UK)</h3>
    <table cellspacing='0' cellpadding='0'>
        <tr><th>Name of the Next of Kin</th><td class="border_right"><?=$uk_kin_name?>&nbsp;</td><th>Relationship with Student</th><td><?=$uk_kin_relation?>&nbsp;</td></tr>
        <tr><th>Address</th><td class="border_right"><?=nl2br($uk_kin_address)?>&nbsp;</td><th>Telephone No</th><td><?=$uk_kin_phone?>&nbsp;</td></tr>
        <tr><th>Mobile No</th><td class="border_right"><?=$uk_kin_mobile?>&nbsp;</td><th>Fax No</th><td><?=$uk_kin_fax?>&nbsp;</td></tr>
        <tr><th>Email</th><td colspan="3"><?=$uk_kin_email?>&nbsp;</td></tr>
    </table>
</div>
<div class='form_content'>
    <h3>Spouse</h3>
    <table cellspacing='0' cellpadding='0'>
        <tr><th>Marital Status </th><td colspan="3"><?=$marital_status?>&nbsp;</td></tr>
        <tr><th>Spouse Name</th><td class="border_right" style="width:150px;"><?=$spouse_name?>&nbsp;</td><th>Spouse Birth Date</th><td><?=$spouse_dob?>&nbsp;</td></tr>
        <tr><th>Spouse Passport</th><td colspan="4"><?=$spouse_passport?>&nbsp;</td></tr>
    </table>
</div>
<div class='table_content'>
    <h3>Qualification Information</h3>
    <table class='txt_center' cellspacing='0' cellpadding='0'>
        <tr class="title"><th>Qualification</th><th>Awarding Body</th><th>Year</th><th>Grade</th></tr>
        <?php if(count($qualifications)>0){
        foreach($qualifications as $qua) { ?>
        <tr>
            <td><?=$qua['qualification']?>&nbsp;</td>
            <td><?=$qua['awarding_body']?>&nbsp;</td>
            <td><?=$qua['year']?>&nbsp;</td>
            <td><?=$qua['grade']?>&nbsp;</td>
        </tr>
            <?php }}  ?>
        <tr><th style="text-align:right;">IELTS Score/Other</th><td colspan="3"><?=$ielts_score?>&nbsp;</td></tr>
    </table>
</div>
<div class='form_content'>
    <h3>Documents Information</h3>
    <?php $doc=explode(',',$doc_submitted)?>
    <table cellspacing='0' cellpadding='0'>
        <?php if($doc[0]==1) {?>
        <tr>
            <th><input type="checkbox" checked /></th>
            <td><a href="<?=base_url()?>uploads/photograph/<?=$photograph?>" target="_blank">Photograph</a>&nbsp;</td>
        </tr>
            <?php }?>
        <?php if($doc[1]==2) {?>
        <tr>
            <th><input type="checkbox" name="document_submitted[]" value="2" <?php if($doc[1]==2) {
                        echo 'checked';
                           }?> /></th>
            <td><a href="<?=base_url()?>uploads/passports/<?=$doc_pass_visa?>" target="_blank">Passport Copy With Valid Visa</a>&nbsp;</td>
        </tr>
            <?php }?>
        <?php if($doc[2]==3) {?>
        <tr>
            <th><input type="checkbox" name="document_submitted[]" value="3" <?php if($doc[2]==3) {
                        echo 'checked';
                           }?> /></th>
            <td><a href="<?=base_url()?>uploads/cirtificates/<?=$doc_certificates?>" target="_blank">Copy Of Certificates</a>&nbsp;</td>
        </tr>
            <?php }?>
        <?php if($doc[3]==4) {?>
        <tr>

            <th><input type="checkbox" name="document_submitted[]" value="4" <?php if($doc[3]==4) {
                        echo 'checked';
                           }?> /></th>
            <td><a href="<?=base_url()?>uploads/ielts_others/<?=$doc_ielts_other?>" target="_blank">IELTS/Others</a>&nbsp;</td>
        </tr>
            <?php }?>
        <?php if($doc[4]==5) {?>
        <tr>
            <th><input type="checkbox" name="document_submitted[]" value="5" <?php if($doc[4]==5) {
                        echo 'checked';
                           }?> /></th>
            <td><a href="<?=base_url()?>uploads/financials/<?=$doc_financial?>" target="_blank">Financial Documents </a>&nbsp;</td>
        </tr>
            <?php }?>
        <tr>
            <th>Documents Required:</th>
            <td><?=$doc_required?>&nbsp;</td>
        </tr>
        <tr>
            <th>Comments</th>
            <td colspan="3"><?=nl2br($comments)?>&nbsp;</td>
        </tr>
        <tr>
            <th>Working Experience</th>
            <td colspan="3"><?=nl2br($working_experience)?>&nbsp;</td>
        </tr>
    </table>
</div>
<div class='form_content'>
    <h3>Programme Details:</h3>
    <table cellspacing='0' cellpadding='0'>
        <tr><th>Name of the Programme: </th><td colspan="3"><?=$program_name?>&nbsp;</td></tr>
        <tr><th>Awarding Body: </th><td colspan="3"><?=$awarding_body_name?>&nbsp;</td></tr>
        <tr><th>Duration:</th><td class="border_right" style="width:150px;"><?=$program_duration?>&nbsp;</td><th>Mode:</th><td><?=$mood_of_study?>&nbsp;</td></tr>
        <tr><th>Start Date:</th><td class="border_right"><?=$pro_start_date?>&nbsp;</td><th>End Date :</th><td><?=$pro_end_date?>&nbsp;</td></tr>
    </table>
</div>
<div class='form_content'>
    <h3>Disability/Special Needs:</h3>
    <table cellspacing='0' cellpadding='0'>
        <tr><td>To help us provide assistance wherever possible please state briefly any disabilities or conditions requiring special support or facilities:</td></tr>
        <tr><td><?=nl2br($special_need)?>&nbsp;</td></tr>
    </table>
</div>
<div class='form_content'>
    <h3>Mandatory Questionnaire:</h3>
    <table cellspacing='0' cellpadding='0'>
        <tr><td width="10" class="border_right">1)</td><td class="border_right"> Are you informed by our counsellor/representative fully about <?=$sess_ins_data['name']?> and programmes offered ?</td><td width="50" class="border_right"><input type="checkbox" name="yes" />Yes</td><td width="50"><input type="checkbox" name="no" /> No</td></tr>
        <tr><td class="border_right">2)</td><td class="border_right"> Are aware that <?=$sess_ins_data['name']?> will not find you part time work or offer placement services during your course of study ?</td><td width="50" class="border_right"><input type="checkbox" name="yes" />Yes</td><td width="50"><input type="checkbox" name="no" /> No</td></tr>
        <tr><td class="border_right">3)</td><td class="border_right"> Are you aware that you have to pay 100% tuition fees before enrolment ?</td><td width="50" class="border_right"><input type="checkbox" name="yes" />Yes</td><td width="50"><input type="checkbox" name="no" /> No</td></tr>
        <tr><td class="border_right">4)</td><td class="border_right"> Do you know that your English will be retested on arrival at the college, and any additional
English courses required must be paid for ?</td><td width="50" class="border_right"><input type="checkbox" name="yes" />Yes</td><td width="50"><input type="checkbox" name="no" /> No</td></tr>
        <tr><td class="border_right">5)</td><td class="border_right"> Are you aware that you should have a minimum of 80% attendance during your study at <?=$sess_ins_data['name']?> ?</td><td width="50" class="border_right"><input type="checkbox" name="yes" />Yes</td><td width="50"><input type="checkbox" name="no" /> No</td></tr>
        <tr><td class="border_right">6)</td><td class="border_right"> Do you know that you will be terminated and reported to the UKBA if you remain absence
for than 10 consecutive days ?</td><td width="50" class="border_right"><input type="checkbox" name="yes" />Yes</td><td width="50"><input type="checkbox" name="no" /> No</td></tr>
        <tr><td class="border_right">7)</td><td class="border_right"> Are you aware that you are only allowed one attempt and two resubmissions/resit for each
course unit ?</td><td width="50" class="border_right"><input type="checkbox" name="yes" />Yes</td><td width="50"><input type="checkbox" name="no" /> No</td></tr>
        <tr><td class="border_right">8)</td><td class="border_right"> Are you aware that you cannot change the course without prior written permission of <?=$sess_ins_data['name']?>?</td><td width="50" class="border_right"><input type="checkbox" name="yes" />Yes</td><td width="50"><input type="checkbox" name="no" /> No</td></tr>
        <tr><td class="border_right">9)</td><td class="border_right"> Do you know that you cannot defer the start date of the course and must be reported to the
UKBA if you do not enrol within 2 weeks of the enrolment period ?</td><td width="50" class="border_right"><input type="checkbox" name="yes" />Yes</td><td width="50"><input type="checkbox" name="no" /> No</td></tr>
        <tr><td class="border_right">10)</td><td class="border_right"> Are you aware that you should have sufficient funds to cover your study and living expenses ?</td><td width="50" class="border_right"><input type="checkbox" name="yes" />Yes</td><td width="50"><input type="checkbox" name="no" /> No</td></tr>
         <tr><td class="border_right">11)</td><td class="border_right"> Are you aware that you will not be able to start your academic course until and unless
you have sufficient knowledge in English ?</td><td width="50" class="border_right"><input type="checkbox" name="yes" />Yes</td><td width="50"><input type="checkbox" name="no" /> No</td></tr>
        <tr><td class="border_right">12)</td><td class="border_right"> Have you been refused a visa for any country including the UK ?</td><td width="50" class="border_right"><input type="checkbox" name="yes" />Yes</td><td width="50"><input type="checkbox" name="no" /> No</td></tr>
        <tr><td class="border_right">13)</td><td class="border_right"> Do you know that your tuition fees will not be refunded if you provide us any false information
and/or sumit any false/forged documents to obtain a college coffer letter and/or visa ?</td><td width="50" class="border_right"><input type="checkbox" name="yes" />Yes</td><td width="50"><input type="checkbox" name="no" /> No</td></tr>
         <tr><td class="border_right">14)</td><td class="border_right"> Are you aware that <?=$sess_ins_data['name']?> will inform the relevant authorities of your registration, attendance
and progression details ?</td><td width="50" class="border_right"><input type="checkbox" name="yes" />Yes</td><td width="50"><input type="checkbox" name="no" /> No</td></tr>
        <tr><td class="border_right">15)</td><td class="border_right"> Do you know that your registration with the College will be terminated and be reported
to the UKBA if you provide us any false information and/or sumit any false/forged
documents ?</td><td width="50" class="border_right"><input type="checkbox" name="yes" />Yes</td><td width="50"><input type="checkbox" name="no" /> No</td></tr>
    </table>
</div>
<div class='form_content'>
    <h3>Declaration:</h3>
    <table cellspacing='0' cellpadding='0'>
        <tr><td>I confirm that the information given on this form is correct and complete, and that I myself have completed all sections.
I give consent to the processing of these data by <?=$sess_ins_data['name']?> for educational purposes under the provision of the Data Protection
Act 1998. I also confirm that I have read and understood the terms and conditions of admission at <?=$sess_ins_data['name']?>.</td></tr>
    </table>
</div>
<div class="form_content" style="margin-top:15px;">
    <table cellpadding="0" cellspacing="0">
        <tr><th>Signature of the Student: &nbsp;</th><td class="border_right" style="width:120px;">&nbsp;</td><th style="width:90px;">Date: &nbsp;</th><td class="border_right" style="width:120px;">&nbsp;</td></tr>
    </table>
</div>