CREATE or replace VIEW `fbsr2`.`auto_jos_comprofiler` (ssn,imageurl,phonenumber, user_id) AS
  SELECT 
	cb_kennitala,
	ifnull(concat('http://fbsr.is/images/comprofiler/',jc.avatar),
			'http://fbsr.is/components/com_comprofiler/plugin/language/default_language/images/tnnophoto.jpg'),
	case  
	when length(ifnull(replace(replace(replace(jc.cb_gsm,' ',''),'+',''),'-',''),'118')) <= 7 THEN ifnull(replace(replace(replace(jc.cb_gsm,' ',''),'+',''),'-',''),'118')
	when left(ifnull(replace(replace(replace(jc.cb_gsm,' ',''),'+',''),'-',''),'118'),3)='354' then right(ifnull(replace(replace(replace(jc.cb_gsm,' ',''),'+',''),'-',''),'118'), 7)
	else '0'
	end,	


	jc.id
  FROM jos_comprofiler jc;