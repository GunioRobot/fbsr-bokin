DELIMITER $$

DROP FUNCTION IF EXISTS `get_userid`$$
CREATE DEFINER=`fbsr`@`%` FUNCTION `get_userid`() RETURNS int(11)
BEGIN
/* =======Skilar næsta lausa nýliða user id (yfir 100000) á þá ekki að rekast á fbsr.is userid========*/
	DECLARE userid INT;
     	select max(id) into userid from jos_users;
	if userid < 100000 then
		set userid= 100000;
	else 
		set userid=userid+1;
	end if;
     	RETURN userid;

END$$

DELIMITER ;
