ALTER TABLE `reg_semester` ADD `semester_section` VARCHAR( 100 ) NOT NULL AFTER `staffs_id` ;
ALTER TABLE `agents`
  DROP `address_2`,
  DROP `telephone_2`,
  DROP `mobile_2`;
ALTER TABLE `agents` ADD `admission_date` DATE NULL DEFAULT NULL AFTER `agent_type` ;

--08-08-2010--
ALTER TABLE `staffs` ADD `photograph` VARCHAR( 100 ) NOT NULL AFTER `qualification_verification` ,
ADD `documents` VARCHAR( 100 ) NOT NULL AFTER `photograph` ,
ADD `comments` VARCHAR( 255 ) NOT NULL AFTER `documents` ;

---16-08-2010-----------
ALTER TABLE `std_con_absent` ADD `levels_id` INT NOT NULL AFTER `semester_id` ;
ALTER TABLE `std_con_absent` ADD `is_last` TINYINT NOT NULL DEFAULT '1' AFTER `is_recent` ;

----2010-08-26---------
ALTER TABLE `permission`
  DROP `institution_id`,
  DROP `institution`,
  DROP `branch`;
ALTER TABLE `permission` ADD `exemption` TINYINT NOT NULL DEFAULT '0' AFTER `std_attendance` ;
ALTER TABLE `permission` ADD `alert` TINYINT NOT NULL DEFAULT '0' AFTER `user` ;

----2010-10-15------
ALTER TABLE `wb_page_image` ADD `menu_id` INT NOT NULL AFTER `image_id` ;
ALTER TABLE `wb_page_image` CHANGE `page_name` `image_title` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL ;
ALTER TABLE `wb_page_image` ADD `status` TINYINT NOT NULL DEFAULT '1' AFTER `image` ;
