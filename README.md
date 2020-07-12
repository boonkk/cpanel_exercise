# About
Service for CRUD operations on cPanel users implemented using DAO pattern.
# Prequisites
 In the project 'root/userDaoWHM' there needs to be **config.php** file 
 with correct access data to WHM Api:
- user
- api token key - key generated in WHM panel
- server url, eg. "https://somedomain.com:2087/json-api/" (**:2087/json-api/** is must, can not work if changed)
- api version (1 Preferred)

Change name and fill fields of **config.example.php** file.
For more info view the **config.example.php** file comments.
