<?php
if ($msg != '') {
    echo "<div class='success'>$msg</div>";
}
?>
<div class='table_content'>
    <table cellspacing="1" cellpadding="1">
        <tr class="title">
            <th>Exam Name</th>
            <th>Exam fee</th>
            <th>Class Payment Date</th>
            <th>Is Paid</th>
            <th>Paid Date</th>
            <th>Action</th>
        </tr>
        <?
            foreach($exams as $exam):
                $exam_row=sql::row("exam","exam_id=$exam");
                $register=sql::row("exam_fee_register","class_map_id=$class_map_id and exam_id=$exam");
                if(count($register)>0){
                    $exam_fee_register_id=$register['exam_fee_register_id'];
                }else{
                    $exam_fee_register_id=0;
                }

                $exam_fee_row=common::get_exam_fee_row($student_id,$exam,$exam_fee_register_id);

        ?>
        <tr class='odd txt_center'>
            <td><?=$exam_row['exam_name'] ?></td>
            <td><?=$exam_row['exam_fee'] ?></td>
            <td><?=(count($register)==0)?'Not taken yet':$register['register_date']?></td>
            <td><?=(count($exam_fee_row)!=0 && $exam_fee_row['is_paid']=='1')?'Yes':'No'?></td>
            <td><?=$exam_fee_row['paid_date'] ?></td>
            <td class="view_links">
            <?php if(common::user_permit('add','std_account')){
                if(count($register)==0) {//class exam fee is not taken yet
            ?>

                <a href="<?=site_url('accounts/receive_exam_fee/' .$class_map_id."/".$exam_row['exam_id']."/".$student_id) ?>" class="receive_link" title="Receive Amount"></a>

            <?} if(count($register)>0){
                    if(count($exam_fee_row)>0 && $exam_fee_row['is_paid']=='0') {?>
                        <!-- Class exam fee is taken, student is listed, but did not pay -->
                        <a href="<?=site_url('accounts/update_exam_fee/' .$exam_fee_row['exam_fee_id']."/".$student_id) ?>" class="receive_link" title="Receive Amount"></a>

                    <?}
                    if(count($exam_fee_row)==0){?>
                        <!-- Class exam fee is taken, student is not listed -->
                        <a href="<?=site_url('accounts/save_student_exam_fee/' .$register['exam_fee_register_id']."/".$student_id) ?>" class="receive_link" title="Receive Amount"></a>
                    <?}
                }
            }?>
            </td>
        </tr>
        <? endforeach;?>
    </table>
</div>

