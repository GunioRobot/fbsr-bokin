DELIMITER $$

DROP PROCEDURE IF EXISTS `auto_sync_users`$$
CREATE DEFINER=`fbsr`@`%` PROCEDURE `auto_sync_users`()
BEGIN

/* =======breyta nilla í fbsr.is user======================================*/
/*log duplicate fbsr.is ssn*/
insert into auto_log (dt, db_entity, event_group)
select current_timestamp(), ajc.user_id, 'fbsr.is duplicate error'  
from auto_jos_comprofiler ajc, bokin_userprofile bu
where 
	ajc.ssn=bu.ssn
	and ajc.user_id<>bu.user_id
	and ajc.user_id in (select ajc2.user_id from auto_jos_comprofiler ajc2 where ajc2.ssn=ajc.ssn);


savepoint s0;
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION begin
	/* on exception, log error and rollback*/
	insert into auto_log (dt, db_entity, event_group)
	select current_timestamp(), bu.user_id, 'convert to fbsr error'  
	from auto_jos_comprofiler ajc, bokin_userprofile bu
		where 
			ajc.ssn=bu.ssn
			and ajc.user_id<>bu.user_id
			and ajc.user_id not in (select ajc2.user_id from auto_jos_comprofiler ajc2 where ajc2.ssn=ajc.ssn);
	rollback to savepoint s0;
end;
/* log convertion*/
insert into auto_log (dt, db_entity, event_group)
select current_timestamp(), bu.user_id, 'convert to fbsr'  
from auto_jos_comprofiler ajc, bokin_userprofile bu
	where 
		ajc.ssn=bu.ssn
		and ajc.user_id<>bu.user_id
		and ajc.user_id not in (select ajc2.user_id from auto_jos_comprofiler ajc2 where ajc2.ssn=ajc.ssn);
		
update auth_user au 
set au.id=
	(select ajc.user_id from auto_jos_comprofiler ajc, bokin_userprofile bu
		where 
			ajc.ssn=bu.ssn
			and ajc.user_id<>bu.user_id)
where 
exists (select * from auto_jos_comprofiler ajc, bokin_userprofile bu
		where 
			ajc.ssn=bu.ssn
			and ajc.user_id<>bu.user_id
			and ajc.user_id not in (select ajc2.user_id from auto_jos_comprofiler ajc2 where ajc2.ssn=ajc.ssn)
			and au.id=bu.user_id);

update bokin_eventregistration ber 
set ber.user_id=
	(select ajc.user_id from auto_jos_comprofiler ajc, bokin_userprofile bu
		where 
			ajc.ssn=bu.ssn
			and ajc.user_id<>bu.user_id)
where 
exists (select * from auto_jos_comprofiler ajc, bokin_userprofile bu
		where 
			ajc.ssn=bu.ssn
			and ajc.user_id<>bu.user_id
			and ajc.user_id not in (select ajc2.user_id from auto_jos_comprofiler ajc2 where ajc2.ssn=ajc.ssn)
			and ber.user_id=bu.user_id);

update bokin_userprofile bup
set bup.user_id=
	(select ajc.user_id from auto_jos_comprofiler ajc
		where 
			ajc.ssn=bup.ssn
			and ajc.user_id<>bup.user_id)
where 
exists (select * from auto_jos_comprofiler ajc
		where 
			ajc.ssn=bup.ssn
			and ajc.user_id<>bup.user_id
			and ajc.user_id not in (select ajc2.user_id from auto_jos_comprofiler ajc2 where ajc2.ssn=ajc.ssn));
END;
commit;
/* =======insert into auth_user ==========================================*/
savepoint s1;
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION begin
	/* on exception, log error and rollback*/
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
commit;

/* =======insert into bokin_userprofile ===================================*/
savepoint s2;

BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION begin
	/* on exception, log error and rollback*/
	insert into auto_log (dt, db_entity, event_group)
	select current_timestamp(), j.user_id, 'insert user profile error'  
	FROM auto_jos_comprofiler j
	where j.user_id not in (select bup.User_id from bokin_userprofile bup);
	rollback to savepoint s2;
end;

/* log insert*/
insert into auto_log (dt, db_entity, event_group)
select current_timestamp(), j.user_id, 'insert user profile'  
FROM auto_jos_comprofiler j
where j.user_id not in (select bup.User_id from bokin_userprofile bup);

/* do insert*/
insert into bokin_userprofile (SSN, ImageURL, PhoneNumer, User_id)
SELECT 
  j.ssn, 
  j.imageurl,
  j.phonenumber, 
  j.user_id 
FROM auto_jos_comprofiler j
where j.user_id not in (select bup.User_id from bokin_userprofile bup);
END;
commit;

/* =======update auth_user ===================================*/
savepoint s3;
begin
DECLARE EXIT HANDLER FOR SQLEXCEPTION begin
	/* on exception, log error and rollback*/
	insert into auto_log (dt, db_entity, event_group)
	select current_timestamp(),  au.id, 'update auth user error'  
	from auth_user au, jos_users ju
	where
	au.id > 50 		/* exclude django users , only update fbsr.is users*/
	and au.id < 100000 	/* exclude temp users nýliðar created in bokin */
	and au.id=ju.id
	and (
		au.username<> ju.username
		or au.email<>ju.email
		or au.password<>ju.password
		or au.first_name<>ju.name
	);
	rollback to savepoint s3;
end;

/* log update*/
insert into auto_log (dt, db_entity, event_group)
select current_timestamp(),  au.id, 'update auth user'  
from auth_user au, jos_users ju
where
au.id > 50 		/* exclude django users , only update fbsr.is users*/
and au.id < 100000 	/* exclude temp users nýliðar created in bokin */
and au.id=ju.id
and (
au.username<> ju.username
or au.email<>ju.email
or au.password<>ju.password
or au.first_name<>ju.name
);

/* do update*/
update auth_user au 
set au.username = (select ju.username from jos_users ju where au.id=ju.id),
au.email = (select ju.email from jos_users ju where au.id=ju.id),
au.password = (select ju.password from jos_users ju where au.id=ju.id),
au.first_name = (select ju.name from jos_users ju where au.id=ju.id),
au.last_name = ''
where exists(
	select ju.id 
	from jos_users ju
	where
	au.id > 50 		/* exclude django users , only update fbsr.is users*/
	and au.id < 100000 	/* exclude temp users nýliðar created in bokin */
	and au.id=ju.id
	and (
		au.username<> ju.username
		or au.email<>ju.email
		or au.password<>ju.password
		or au.first_name<>ju.name
	)
);
end;
commit;

/* =======update bokin_userprofile ===================================*/
savepoint s4;
begin
DECLARE EXIT HANDLER FOR SQLEXCEPTION begin
	/* on exception, log error and rollback*/
	insert into auto_log (dt, db_entity, event_group)
	select current_timestamp(),  j.user_id, 'update bokin userprofile error' 
	from bokin_userprofile bu, auto_jos_comprofiler j
	where
	bu.user_id > 50 		/* exclude django users , only update fbsr.is users*/
	and bu.user_id < 100000 	/* exclude temp users nýliðar created in bokin */
	and bu.user_id=j.user_id
	and (
		bu.ssn<>j.ssn
		or bu.imageurl<>j.imageurl
		or bu.phonenumer<> j.phonenumber
	);
	rollback to savepoint s4;
end;

/* log update*/
insert into auto_log (dt, db_entity, event_group)
select current_timestamp(),  bu.user_id, 'update bokin userprofile' 
from bokin_userprofile bu, auto_jos_comprofiler j
where
bu.user_id > 50 		/* exclude django users , only update fbsr.is users*/
and bu.user_id < 100000 	/* exclude temp users nýliðar created in bokin */
and bu.user_id=j.user_id
and (
		bu.ssn<>j.ssn
		or bu.imageurl<>j.imageurl
		or bu.phonenumer<> j.phonenumber
);

/* do update*/
update bokin_userprofile bu set
bu.ssn = (select j.ssn from auto_jos_comprofiler j where bu.user_id=j.user_id),
bu.imageurl = (select j.imageurl from auto_jos_comprofiler j where bu.user_id=j.user_id),
bu.phonenumer = (select j.phonenumber from auto_jos_comprofiler j where bu.user_id=j.user_id)
where exists ( 
	select j.user_id 
	from auto_jos_comprofiler j
	where
	bu.user_id > 50 		/* exclude django users , only update fbsr.is users*/
	and bu.user_id < 100000 	/* exclude temp users nýliðar created in bokin */
	and bu.user_id=j.user_id
	and (
		bu.ssn<>j.ssn
		or bu.imageurl<>j.imageurl
		or bu.phonenumer<> j.phonenumber
	)
);

end;
commit;

/* =======update groups ===================================*/
savepoint s5;
begin
DECLARE EXIT HANDLER FOR SQLEXCEPTION begin
	/* on exception, log error and rollback*/
	insert into auto_log (dt, db_entity, event_group)
	select current_timestamp(),  0, 'group insert error' 
	from dual;
	rollback to savepoint s5;
end;
/* setja nýliða í grúppur*/
insert into auth_user_groups (user_id, group_id) select user_id, 2 from auto_jos_comprofiler where nylidi=1 ON DUPLICATE KEY UPDATE group_id = 2;
/* setja inngengna í grúppur */
insert into auth_user_groups (user_id, group_id) select user_id, 1 from auto_jos_comprofiler where nylidi=0 ON DUPLICATE KEY UPDATE group_id = 1;
end;
commit;



END$$

DELIMITER ;
