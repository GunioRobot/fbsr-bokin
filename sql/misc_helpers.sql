/*sækja nýlegar villur*/
SELECT * FROM auto_log a
where upper(event_group) like '%ERROR%'
and dt > curdate() -1
LIMIT 0,1000

/* notað í að testa synca notendum, til að eyða öllum notendum*/
delete from auth_user where id > 1;
delete from auto_log;
delete from bokin_userprofile where user_id > 1;
delete from auth_user_groups where user_id > 1;