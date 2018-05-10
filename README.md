# SIBERS-Test
Test task from Sibers

[Beginning of work](#start) 

[Architecture description](#start) 

<a name="start"><h2>Beginning of work</h2></a>  
1. Enter the authorization parameters you need in /../application/config/admin.php (at the moment login: admin, password: 123456789)
2. Enter the connection parameters with the database in /../application/config/db.php 
3. We pass to http://{local domain name}/

<a name="start"><h2>Architecture description</h2></a>

![Image alt](https://github.com/AlexandrBuilder/image/blob/master/image/architecture.PNG)

**ACL** - Access Control List
- admin.php - is needed to describe access to pages

**config** - configuration file
- admin.php - file of the administrator's login and password
- db.php - file for specifying connection parameters to the database
- routes.php - url parameter creation file

**core** - main folder
- Controller.php - abstract class forming the basic functions of the controllers
- Model.php - abstract class forming the basic functions of models
- View.php - class forming functions of the views
- Router.php - class forming work with URL requests

**lib** - contains auxiliary classes and sets of functions
- Db.php - class forming connection to the database and queries to it
- Pagination.php - class forming pagination
- Dev.php - auxiliary functions for debugging


