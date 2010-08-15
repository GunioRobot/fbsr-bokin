select user_id, sum(ifnull(UnRegisteredDate - RegisteredDate, now()-RegisteredDate))/3600 as delta from bokin_eventregistration ber group by user_id order by delta desc;

select ju.name, sum(ifnull(UnRegisteredDate - RegisteredDate, now()-RegisteredDate))/3600 as delta from bokin_eventregistration ber, jos_users ju where ber.user_id=ju.id group by user_id order by delta desc;



select ju.name, sum(ifnull(UnRegisteredDate - RegisteredDate, now()-RegisteredDate))/3600 as delta from bokin_eventregistration ber, jos_users ju where ber.user_id=ju.id and registereddate > now()- INTERVAL 7 day group by user_id order by delta desc;
