<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <?php include_once 'shared/html_header.php';?>
    <body>
        <div id="body_content">
            <?php include_once 'shared/header.php';?>
            <?php if($container==''){$container='home';}?>
            <?php include_once $container.'_container.php';?>
            <div class="clear"></div>
            <?php include_once 'shared/footer.php';?>
        </div>
    </body>
</html>