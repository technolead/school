<div id="sidebar">
    <?php
        $right_data=common::get_right_data($parent_id,$menu_id);
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
<div id="main">
    <h1><?=$rows[0]['content_title']?></h1>
    <?=$rows[0]['content_des']?>
    <div id="autoIndex">
    </div>
</div>