# IMAGEBOARD site, similar to Pinterest

- also create a .config.inc file in the same directory with the password for accessing mysql:
```$mysql_user="your user here";
$mysql_password="your password here";```
- in mysql, after creating the schema (which I named `hundred`), grant the above credentials rights for INSERT, UPDATE, SELECT and DELETE:
```grant select, insert on <schema>.<table> to 'user'@'localhost' identified by 'password'```
- table structure in mysql for this thing would be:

### day9_boards ###
```
+-------------------+--------------+------+-----+---------+----------------+
| Field             | Type         | Null | Key | Default | Extra          |
+-------------------+--------------+------+-----+---------+----------------+
| id                | int(11)      | NO   | PRI | NULL    | auto_increment |
| board_url         | varchar(255) | YES  |     | NULL    |                |
| board_description | text         | YES  |     | NULL    |                |
| status            | varchar(20)  | YES  |     | NULL    |                |
| name              | varchar(255) | YES  |     | NULL    |                |
+-------------------+--------------+------+-----+---------+----------------+

```

### day9_images ###
```
+-------------------+--------------+------+-----+---------+----------------+
| Field             | Type         | Null | Key | Default | Extra          |
+-------------------+--------------+------+-----+---------+----------------+
| id                | int(11)      | NO   | PRI | NULL    | auto_increment |
| image_path        | varchar(255) | YES  |     | NULL    |                |
| image_url         | varchar(255) | YES  |     | NULL    |                |
| image_title       | varchar(255) | YES  |     | NULL    |                |
| image_description | text         | YES  |     | NULL    |                |
+-------------------+--------------+------+-----+---------+----------------+
```

### day9_assoc ###
```
+----------+---------+------+-----+---------+----------------+
| Field    | Type    | Null | Key | Default | Extra          |
+----------+---------+------+-----+---------+----------------+
| id       | int(11) | NO   | PRI | NULL    | auto_increment |
| board_id | int(11) | YES  |     | NULL    |                |
| image_id | int(11) | YES  |     | NULL    |                |
+----------+---------+------+-----+---------+----------------+
```



this lives ine one of these places:
- https://100.evervee.me/9/
- https://omgvee.github.io/100/
