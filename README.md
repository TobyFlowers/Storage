# Storage
APCSA Final Project - File Upload &amp; Storage (PHP)

### Board.php
Homescreen for logged in users, shows file uploads and allows file submissions.
### Delete.php
PHP script for deleting file from MySQL database and from FS on drive in an upload folder
### Home.php
Homescreen for non-logged in users, any un-authenticated request to another page will bounce the user back here. 
### Index.php
XAMPP prebuilt file, bounces user to homescreen
### Login.php
PHP login script, checks if user:pass combination is valid against MySQL records, uses sessions for authentication
### Logout.php
PHP login script that simply destroys the user session and redirects to home.php
### Upload.php
Script that checks if file submissions are valid, and if so adds a record to the MySQL database and also moves the file to an uploads folder. 
