<div class="pad_10">
    <div class="margin_10_0">
        <?php
        $test=$letter['letter_des'];
        // echo Eval($test);
        $test=str_replace('"', "'", "$test");
        eval("\$test = \"$test\";");
        print $test . "<br>";
        //echo  html_entity_decode($des);
        ?>
    </div>
</div>