DELIMITER $$

DROP PROCEDURE IF EXISTS `fbsr2`.`auto_sync_users`$$
CREATE DEFINER=`fbsr`@`%` PROCEDURE `auto_sync_users`()
BEGIN

/* =======insert í auth_user ==========================================*/
savepoint s1;
BEGIN
DECLARE CONTINUE HANDLER FOR SQLEXCEPTION begin
/* on exception*/
insert into auto_log (dt, db_entity, event_group)
select current_timestamp(), u.id, 'insert user error'  
FROM jos_users u
where u.id not in (select au.id from auth_user au);
rollback to savepoint s1;
end;

/* log insert*/
insert into auto_log (dt, db_entity, event_group)
select current_timestamp(), u.id, 'insert user'  
FROM jos_users u
where u.id not in (select au.id from auth_user au);

/* do insert*/
insert into auth_user (id, first_name,last_name, username, email, password, is_staff, is_active, is_superuser, last_login, date_joined)  
SELECT u.id, u.name,'',u.username, u.email, u.password, '0','1','0',
 u.lastvisitDate, u.registerDate FROM jos_users u
where u.id not in (select au.id from auth_user au);
END;


/* =======insert í bokin_userprofile ===================================*/
savepoint s2;
BEGIN
DECLARE CONTINUE HANDLER FOR SQLEXCEPTION begin
/* on exception*/
insert into auto_log (dt, db_entity, event_group)
select current_timestamp(), j.user_id, 'insert user profile error'  
FROM jos_comprofiler j
where j.user_id not in (select bup.User_id from bokin_userprofile bup);
rollback to savepoint s2;
end;

/* log insert*/
insert into auto_log (dt, db_entity, event_group)
select current_timestamp(), j.user_id, 'insert user profile'  
FROM jos_comprofiler j
where j.user_id not in (select bup.User_id from bokin_userprofile bup);

/* do insert*/
insert into bokin_userprofile (SSN, ImageURL, PhoneNumer, User_id)
SELECT 
  j.cb_kennitala, 
  ifnull(concat('http://fbsr.is/images/comprofiler/',j.avatar), 
  'http://fbsr.is/components/com_comprofiler/plugin/language/default_language/images/tnnophoto.jpg'),
  ifnull(replace(replace(replace(j.cb_gsm,' ',''),'+',''),'-',''),'118'), 
  j.user_id 
FROM jos_comprofiler j
where j.user_id not in (select bup.User_id from bokin_userprofile bup);
END;


END$$

DELIMITER ;
