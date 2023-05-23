# SMART FAQ that auto sorts based on interest/views/interactions

- also create a .config.inc file in the same directory with the password for accessing mysql:
```$mysql_user="your user here";
$mysql_password="your password here";```
- in mysql, after creating the schema (which I named `hundred`), grant the above credentials rights for INSERT and SELECT and DELETE:
```grant select, insert on <schema>.<table> to 'user'@'localhost' identified by 'password'```
- table structure in mysql for this thing would be:
```
+---------+--------------+------+-----+---------+----------------+
| Field   | Type         | Null | Key | Default | Extra          |
+---------+--------------+------+-----+---------+----------------+
| id      | int(11)      | NO   | PRI | NULL    | auto_increment |
| title   | varchar(255) | NO   |     | NULL    |                |
| content | text         | YES  |     | NULL    |                |
| views   | int(11)      | NO   |     | NULL    |                |
+---------+--------------+------+-----+---------+----------------+
```


this lives ine one of these places:
- https://100.evervee.me/8/
- https://omgvee.github.io/100/
