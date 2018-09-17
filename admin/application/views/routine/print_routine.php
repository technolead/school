<div class='table_content'>
    <div class="pagination_links">
        <div class="left b">Class Routine</div>

        <div class="clear"></div>
    </div>
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



    <?php
    $inc=1;?>
    <table cellpadding="0" cellspacing="1">
        <tr class='title'>

            <th>Day</th>
            <th>period</th>
            <th>Period</th>
            <th>Period</th>
            <th>Period</th>
            <th>Period</th>
            <th>Period</th>
            <th>Period</th>
            <th>Period</th>


        </tr>
    <?foreach($routine as $row):?>
        <tr <?php if($inc%2==0) {
            echo "class='even'";
        }else {
            echo "class='odd'";
        }?>>

            <td><?=$row['day']?></td>

            <?
                $details=combo::get_routine_details($row['class_routine_id'],$row['day']);
                for($i=0;$i<8;$i++){
                    if(count($details[$i])>0){
                        $view=$details[$i]['period']." Period"."<br />".
                              $details[$i]['module_name']."<br />".
                              $details[$i]['time']."<br />".
                              $details[$i]['user_name']."<br />";
                    }else{
                        $view="&nbsp;<br />";
                    }
                    ?>

                    <td><?=$view?></td>
                    <?
                }

            ?>

            

        </tr>
        <?php $inc++;
    endforeach;
    ?>
        
    </table>
</div>
    