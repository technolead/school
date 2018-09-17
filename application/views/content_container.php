<div id="topPanel">
    <?php
    if($parent_id!=0) {
        $top_image=sql::row('wb_page_image',"menu_id='$parent_id'");
    }else {
        $top_image=sql::row('wb_page_image',"menu_id='$menu_id'");
    }
    ?>
    <img src="uploads/page_image/<?=$top_image['image']?>" alt="<?=$top_image['image_title']?>" />
    <?php if(count($nav_array)>0) {
        echo common::nav_menu_link($nav_array);
    }?>
</div>
<div class="clear"></div>
<div id="main_body">
    <div id="left">
        <?php include_once $dir.'/left_content.php';?>
    </div>
    <div id="content">
        <?php include_once $dir.'/'.$page.'.php';?>
    </div>
    <div class="clear"></div>
</div>