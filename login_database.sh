echo 'create database login;' | mysql --host=localhost --user=root --password=raspberry
echo " \
CREATE TABLE users ( \
  id int(11) NOT NULL auto_increment, \
  username varchar(64) NOT NULL default '', \
  password varchar(64) NOT NULL default '', \
  PRIMARY KEY  (id) \
) ;" | mysql --host=localhost --user=root --password=raspberry --database login

CREATE TABLE openvpnusers ( \
  id int(11) NOT NULL auto_increment, \
  username varchar(64) NOT NULL default '', \
  firstname varchar(64) NOT NULL default '', \
  lastname varchar(64) NOT NULL default '', \
  packageurl varchar(64) NOT NULL default '', \
  PRIMARY KEY  (id) \
) ;" | mysql --host=localhost --user=root --password=raspberry --database login

echo "INSERT INTO users (username,password) VALUES('admin','raspberry');" | \
mysql --host=localhost --user=root --password=raspberry --database login

