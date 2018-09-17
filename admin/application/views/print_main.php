<html>
    <head>
        <title><?=$page_title?> | College Management</title>
        <meta content="text/html; charset=UTF-8" http-equiv="Content-Type"/>
        <link type="text/css" rel="stylesheet" href="<?=base_url()?>style/print_style.css">
        <script type="text/javascript" src="<?=base_url()?>tools/jquery-1.4.2.min.js"></script>
        <script type="text/javascript">
            var $j=jQuery.noConflict();
            var base_url="<?=base_url()?>";
        </script>
        <script type="text/javascript">
            $j(document).ready(function(){
                $j('.print').click(function(){
                    $j(this).hide();
                    if(window.print()){
                        $j(this).show();
                    }
                });
            });
        </script>
    </head>
    <body>
        <div class="doc_wrapper">
            <?php if(!$letter_print){?>
            <div class="header_wrapper txt_center">
                <div class="">
                    <h1><?=common::get_settings_data_with_flag('site_title');?></h1>
                </div>
            </div>
            <?php }?>
            <?php if($dir=='') {
                $dir='home';
            } if

            ($page=='') {
                $page='index';
}?>
            <div class="pad_10 m_height">
<?php include_once $dir.'/'.$page.'.php';?>
            </div>
            <div style="float:left;margin-top:20px;">
		Verified By................................
            </div>
            <?php if($tsign){
                echo '<div style="float:left;margin-top:20px;text-align:center;width:450px;">Teacher Signature...................................</div>';
            }?>
             <?php if($acc_sign){
                echo '<div style="float:left;margin-top:20px;text-align:center;width:450px;">Signature 1: .................................. Signature 2: ................................</div>';
            }?>
            <div style="float:right;text-align:right;margin-top:20px;">
		Date......................................
            </div>
            <div class="clear"></div>
            <input type="button" name="print" value="Print" id="jprintbutton" class="print"/>
        </div>
    </body>
</html>