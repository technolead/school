<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url('report/std_payment_report')?>' method='post'>
        <table>
            <tr>
                <th><input type="radio" name="fee" value="admission" checked /></th>
                <td>Admission Fee</td>
            </tr>
            <tr>
                <th><input type="radio" name="fee" value="monthly"  /></th>
                <td>Monthly Fee</td>
            </tr>

            <tr>
                <th><input type="radio" name="fee" value="exam"  /></th>
                <td>Exam Fee</td>
            </tr>
            <input type="hidden" name="payment_type" value="paid" />

            <tr><th>&nbsp;</th>
                <td><input type='submit' name='con_report' value='Continue to Generate Report' class='button' />  <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>