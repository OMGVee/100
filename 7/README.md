# cronjob to cleanup the db
```* * * * * mysql -e "use <schema>; delete from <table> where date_created < (now() - interval 5 minute);"```

- also create a .config.inc file in the same directory with the password for accessing mysql:
```$mysql_user="your user here";
$mysql_password="your password here";```
- in mysql, after creating the schema (which I named `hundred`), grant the above credentials rights for INSERT and SELECT and DELETE:
```grant select, insert on <schema>.<table> to 'user'@'localhost' identified by 'password'```
- table structure in mysql for this thing would be:
```
+--------------+-------------+------+-----+-------------------+----------------+
| Field        | Type        | Null | Key | Default           | Extra          |
+--------------+-------------+------+-----+-------------------+----------------+
| id           | int(5)      | NO   | PRI | NULL              | auto_increment |
| date_created | timestamp   | NO   |     | CURRENT_TIMESTAMP |                |
| url          | text        | YES  |     | NULL              |                |
| shortlink    | varchar(50) | YES  |     | NULL              |                |
+--------------+-------------+------+-----+-------------------+----------------+
```


this lives ine one of these places:
- https://100.evervee.me/7/
- https://omgvee.github.io/100/
