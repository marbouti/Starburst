Quick Installation Guide: 
1- edit config.php file based on your mysql database settings. 
2- create the database tables by sunning starburst.sql; 
2-1- starburst.sql automatically creates a username 'admin' with password 'admin'; to add users you should directly insert data into starburst_users table or edit .sql file. 
2-2- starburst.sql automatically creates the main discussion prompt. You can edit it directly from the database or change .sql file.  
3- copy the code into a web accessible place that supports PHP(5.2.11)/MySql(5.0.81); it probably works with earlier versions, but has not been tested. 

Notes: 
1- Starburst tracks all reading/posting actions and stores them in the database in starburst_logs table. 
2- This is a functional prototype forum and editing functions have not been implemented. To edit/remove a post or add/edit/remove users you have to do it from the database. 
3- This version keeps the plain (un-encrypted) passwords in the database. Please use it at your own risk regarding security issues. 
4- The visualization part is based on JavaScript InfoVis Toolkit (http://philogb.github.io/jit/).

Ppotential Future Development 
-dealing with the problem of very long threads
-creating a version with multiple starbursts
-add search/find function 
-add edit users
-edit posts
