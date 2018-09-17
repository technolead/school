<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <?php include_once 'shared/html_header.php';?>
    <body>
        <div id="body_content">
            <?php include_once 'shared/header.php';?>
            <div id="topPanel">
                <img src="images/about.jpg" alt="about" />
                 <?php if(count($nav_array)>0) {
                    echo common::nav_menu_link($nav_array);
                }?>
            </div>
            <div id="left">
               <?php include_once $dir.'/left_content.php';?>
            </div>
            <div id="content">
            <?php include_once $dir.'/'.$page.'.php';?>
            </div>
            <div class="clear"></div>
            <?php include_once 'shared/footer.php';?>
        </div>
    </body>
</html>