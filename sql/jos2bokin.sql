

insert into auth_user (id, first_name,last_name, username, email, password, is_staff, is_active, is_superuser, last_login, date_joined)  
SELECT u.id, u.name,'',u.username, u.email, u.password, '0','1','0', u.lastvisitDate, u.registerDate FROM jos_users u


insert into bokin_userprofile (SSN, ImageURL, PhoneNumer, User_id)
SELECT j.cb_kennitala, ifnull(concat('http://fbsr.is/images/comprofiler/',j.avatar), 'http://fbsr.is/components/com_comprofiler/plugin/language/default_language/images/tnnophoto.jpg'), ifnull(replace(j.cb_gsm,' ',''),'118'), j.user_id FROM jos_comprofiler j