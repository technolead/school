<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <?php include_once 'shared/html_header.php';?>
    <body>
        <div id="body_content">
            <?php include_once 'shared/student_header.php';?>
            <div id="topPanel">
                <?php
                if($parent_id!=0) {
                    $top_image=sql::row('wb_page_image',"menu_id='$parent_id'");
                }else {
                    $top_image=sql::row('wb_page_image',"menu_id='1'");
                }
                ?>
                <img src="uploads/page_image/<?=$top_image['image']?>" alt="<?=$top_image['image_title']?>" />
                <?php if(count($nav_array)>0) {
                    echo common::nav_menu_link($nav_array);
                }?>
            </div>
            <div class="clear"></div>
           <div id="std_portal">
               <div class="fl_left" style="background:#fff;width:740px;padding:10px;">
                    <?php include_once $dir.'/'.$page.'.php';?>
                </div>
               <div class="fl_right" style="width:190px;padding:10px;">
                    <?php
                        $right_data=common::get_right_data(1);
                        if(count($right_data)>0):
                            foreach ($right_data as $right_con):
                          ?>
                              <h2><?=$right_con['title']?></h2>
                              <p><?=$right_con['des']?></p>
                              <img src="uploads/right_content/<?=$right_con['image']?>" width="185" alt="" />
                         <?php
                            endforeach;
                        endif;
                    ?>
               </div>
               <div class="clear"></div>
            </div>
            <div class="clear"></div>
            <?php include_once 'shared/footer.php';?>
        </div>
    </body>
</html>