CREATE or replace VIEW `auto_jos_comprofiler` (ssn,imageurl,phonenumber, user_id, nylidi) AS
  SELECT 
	cb_kennitala as ssn,
	ifnull(concat('http://fbsr.is/images/comprofiler/',jc.avatar),
			'http://fbsr.is/components/com_comprofiler/plugin/language/default_language/images/tnnophoto.jpg') as imageurl,
	if(right(replace(replace(replace(jc.cb_gsm,' ',''),'+',''),'-',''),7)='',
'118',right(replace(replace(replace(jc.cb_gsm,' ',''),'+',''),'-',''),7))
 as phonenumber,	
	jc.id as user_id,
	ifnull(jc.cb_nylidi, 0) as nylidi
  FROM jos_comprofiler jc
	where jc.cb_kennitala is not null and jc.cb_kennitala <> ''; 