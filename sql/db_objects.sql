CREATE TABLE auto_log (
  id INTEGER  NOT NULL AUTO_INCREMENT,
  dt TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP,
  db_entity INTEGER ,
  event_group VARCHAR(100) ,
  str_log VARCHAR(4000),
 PRIMARY KEY (`id`)
)



DELIMITER $$

DROP FUNCTION IF EXISTS `fbsr2`.`get_userid`$$
CREATE FUNCTION `fbsr2`.`get_userid` () RETURNS INT
BEGIN

	DECLARE userid INT;
     	select max(id) into userid from auth_user;
	if userid < 100000 then
		set userid= 100000;
	else 
		set userid=userid+1;
	end if;
     	RETURN userid;

END$$

DELIMITER ;




DELIMITER $$

DROP PROCEDURE IF EXISTS `fbsr2`.`auto_signout`$$
CREATE DEFINER=`fbsr`@`%` PROCEDURE `auto_signout`()
BEGIN

insert into auto_log (dt, db_entity, event_group)
select current_timestamp(), ber.id, 'throw user out'  
from bokin_event be, bokin_eventregistration ber
where 
be.id=ber.event_id 
and be.closedate < current_timestamp() 
and ber.unregistereddate is null;  

update bokin_eventregistration ber
set ber.unregistereddate = (select be.closedate 
				from bokin_event be 
				where be.id=ber.event_id )  
where 
	exists ( select ber.id from bokin_event be
		where 
		be.id=ber.event_id 
		and be.closedate < current_timestamp() 
		and ber.unregistereddate is null);

insert into auto_log (dt, db_entity, event_group)
select current_timestamp(), be.id, 'close event'  
from bokin_event be
where 
be.closedate is null 
and not exists (  select event_id 
		from bokin_eventregistration ber 
		where 
			be.id=ber.event_id 
			and ber.unregistereddate is null); 

update bokin_event be 
set be.closedate=(select max(ber.unregistereddate) 
			from bokin_eventregistration ber 
			where ber.event_id=be.id)
where 
	be.closedate is null 
	and not exists (  select event_id 
				from bokin_eventregistration ber 
				where 
					be.id=ber.event_id 
					and ber.unregistereddate is null);
END$$

DELIMITER ;



create event auto_signout on schedule every 600 second do call auto_signout();


set global event_scheduler=1;



CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `event_registrations` AS select `b`.`id` AS `id`,`b`.`Event_id` AS `event_id`,`b`.`RegisteredDate` AS `registereddate`,`b`.`UnregisteredDate` AS `unregistereddate`,`d`.`Name` AS `event_type`,concat(`d`.`Name`,_latin1': ',`e`.`Name`) AS `event_name`,concat(`au`.`first_name`,_latin1' ',`au`.`last_name`) AS `fullname`,`ag`.`name` AS `user_group`,`up`.`PhoneNumer` AS `PhoneNumer`,`up`.`ImageUrl` AS `imageurl` from ((((((`bokin_eventregistration` `b` join `bokin_event` `e`) join `bokin_division` `d`) join `bokin_userprofile` `up`) join `auth_user` `au`) join `auth_group` `ag`) join `auth_user_groups` `aug`) where ((`b`.`Event_id` = `e`.`id`) and (`e`.`Division_id` = `d`.`id`) and (`b`.`User_id` = `up`.`User_id`) and (`up`.`User_id` = `au`.`id`) and (`au`.`id` = `aug`.`user_id`) and (`aug`.`group_id` = `ag`.`id`))



CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `events` AS select `e`.`id` AS `id`,`d`.`Name` AS `division`,`e`.`Name` AS `event`,count(1) AS `cnt`,`e`.`CloseDate` AS `CloseDate` from ((`bokin_eventregistration` `b` join `bokin_event` `e`) join `bokin_division` `d`) where (isnull(`b`.`UnregisteredDate`) and (`b`.`Event_id` = `e`.`id`) and (`e`.`Division_id` = `d`.`id`)) group by `b`.`Event_id`