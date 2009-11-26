CREATE TABLE auto_log (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  dt TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP,
  db_entity INTEGER ,
  event_group VARCHAR(100) ,
  str_log VARCHAR(4000),
 PRIMARY KEY (`id`)
)

create event auto_signout on schedule every 600 second do call auto_signout();

CREATE EVENT auto_sync_users ON SCHEDULE EVERY 1 DAY do call auto_sync_users();

set global event_scheduler=1;

CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `event_registrations` AS select `b`.`id` AS `id`,`b`.`Event_id` AS `event_id`,`b`.`RegisteredDate` AS `registereddate`,`b`.`UnregisteredDate` AS `unregistereddate`,`d`.`Name` AS `event_type`,concat(`d`.`Name`,_latin1': ',`e`.`Name`) AS `event_name`,concat(`au`.`first_name`,_latin1' ',`au`.`last_name`) AS `fullname`,`ag`.`name` AS `user_group`,`up`.`PhoneNumer` AS `PhoneNumer`,`up`.`ImageUrl` AS `imageurl` from ((((((`bokin_eventregistration` `b` join `bokin_event` `e`) join `bokin_division` `d`) join `bokin_userprofile` `up`) join `auth_user` `au`) join `auth_group` `ag`) join `auth_user_groups` `aug`) where ((`b`.`Event_id` = `e`.`id`) and (`e`.`Division_id` = `d`.`id`) and (`b`.`User_id` = `up`.`User_id`) and (`up`.`User_id` = `au`.`id`) and (`au`.`id` = `aug`.`user_id`) and (`aug`.`group_id` = `ag`.`id`))



CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `events` AS select `e`.`id` AS `id`,`d`.`Name` AS `division`,`e`.`Name` AS `event`,count(1) AS `cnt`,`e`.`CloseDate` AS `CloseDate` from ((`bokin_eventregistration` `b` join `bokin_event` `e`) join `bokin_division` `d`) where (isnull(`b`.`UnregisteredDate`) and (`b`.`Event_id` = `e`.`id`) and (`e`.`Division_id` = `d`.`id`)) group by `b`.`Event_id`