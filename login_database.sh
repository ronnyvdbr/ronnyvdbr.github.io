echo 'create database login;' | mysql --host=localhost --user=root --password=raspberry
echo " \
CREATE TABLE users ( \
  id int(11) NOT NULL auto_increment, \
  username varchar(64) NOT NULL default '', \
  password varchar(64) NOT NULL default '', \
  PRIMARY KEY  (id) \
) ;" | mysql --host=localhost --user=root --password=raspberry --database login

echo " \
CREATE TABLE openvpnusers ( \
  id int(11) NOT NULL auto_increment, \
  openvpnservername varchar(64) NOT NULL default '', \
  username varchar(64) NOT NULL default '', \
  firstname varchar(64) NOT NULL default '', \
  lastname varchar(64) NOT NULL default '', \
  country varchar(2) NOT NULL default '', \
  province varchar(64) NOT NULL default '', \
  city varchar(64) NOT NULL default '', \
  organisation varchar(64) NOT NULL default '', \
  email varchar(64) NOT NULL default '', \
  packageurl varchar(64) NOT NULL default '', \
  PRIMARY KEY  (id) \
) ;" | mysql --host=localhost --user=root --password=raspberry --database login

echo "INSERT INTO users (username,password) VALUES('admin','raspberry');" | \
mysql --host=localhost --user=root --password=raspberry --database login

