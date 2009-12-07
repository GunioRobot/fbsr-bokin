DELIMITER $$

DROP PROCEDURE IF EXISTS `auto_signout`$$
CREATE DEFINER=`fbsr`@`%` PROCEDURE `auto_signout`()
BEGIN
/* =======Henda user út úr event sem er búinn að lokast ==========================================*/
/* logga að user hafi verið hent út*/
insert into auto_log (dt, db_entity, event_group)
select current_timestamp(), ber.id, 'throw user out'  
from bokin_event be, bokin_eventregistration ber
where 
be.id=ber.event_id 
and be.closedate < current_timestamp() 
and ber.unregistereddate is null;  

/* henda user út*/
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


/* =======Loka event sem er ekki með neina usera ==========================================*/
/* logga event lokun*/
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

/*loka event*/
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
