<div id="slideshow">
    <ul class="slideshow fl_left">
        <?php if(count($slider_rows)>0):
            $inc=1;
            foreach ($slider_rows as $row):?>
        <li <?php if($inc==1) {
                    echo 'class="show"';
                    }?>><a href="#"><img src="uploads/slider/<?=$row['image']?>" width="820" height="300" title="<?=$row['title']?>" alt="<?=$row['des']?>"/></a></li>
                    <?php $inc++;
                endforeach;
            endif;
            ?>
    </ul>
    <div class="fl_right" style="width:130px;">
        <div class="qitem">
            <a href="#"><img src="images/1.gif" alt="Test 1" title="" width="126" height="126"/></a>
            <span class="caption"><h4>Student</h4><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p></span>
        </div>
        <div class="qitem" style="margin:8px 0;">
            <a href="#"><img src="images/2.gif" alt="Test 1" title="" width="126" height="126"/></a>
            <span class="caption"><h4>Staffs</h4><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p></span>
        </div>
        <div class="qitem">
            <a href="#"><img src="images/3.gif" alt="Test 1" title="" width="126" height="126"/></a>
            <span class="caption"><h4>College</h4><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p></span>
        </div>
    </div>
    <div class="clear"></div>
</div>
<?php include_once $dir.'/'.$page.'.php';?>