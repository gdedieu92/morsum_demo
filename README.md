# morsum_demo
recipes demo fwk for morsum challenge

#Overview
I found interesting to develop a demo code about recipes software. You can create ingredients and then do the recipes using them and defining the unit of measurament and quantity (a tought to create a bigger application and bussiness idea).
So you can extend this code in anyway!!

#How to install
1)install apache + mysql php >= 5.2<br />
2)create database recipe_demo (there is a .sql in root folder)<br />
3)define the URL in config folder example: localhost/morsum_demo_recipes<br />
<br />
That's all, you will be able to see a panel with demo data and a couple of recipes and ingredients loaded!

#Architecture MVC
application => controllers, models and views.<br />
config => variables to set for framework works.<br />
libs => the core of the framework.<br />
public => css,images,js, and all public information.<br />

#Configuration
inside root folder config:<br />
1)Default Controller => define default controller if it is not defined (index method default)<br />
2)Environment => Development (all php errors on) or Production<br />
3)Project Url => the base path of the project<br />
4)DB Configuration => parameters for pdo db connection<br />
5)MVC Paths => define path for controller,model and view folder<br />
6)Constants Path => define constants.<br />

#URI Routing
For example, let’s say you want your URLs to have this prototype:<br />
example.com/recipe/our_recipes/rec_id/1/<br />
<br />
The first segment define controller<br />
The second segment define method<br />
Then the continuos segments indicates parameters in pairs key/value<br />
key => rec_id<br />
value => 1<br />

#Libraries
inside root folder libs:<br />
1)Router => generate url that index.php? pass<br />
2)Controller => Load model for use, clear post data.<br />
3)Model => Extends from Database Class to access by pdo to mysql and has defined several methods for quick use of mysql insertion.<br />
4)View => Load information passed by Controller.<br />
5)Database => PDO connection definition.<br />
6)Functions => General functions for the application, any function that want to be global accesible should be declare inside this file.<br />

#Controller
inside root folder application/controllesr:<br />
Extends of A_Controller, defines method and make the connection between model and view, recive requests and load the view with the necessary data.
<br />
In general is a good practice define different controllers for each entity of the database to keep the business tidy, in this case i used Recipe controller to manage code for recipes and ingredients, could be separate.
<br />
There is a Panel controller, it's an idea to know how the business is running (just html and jquery code, but interesing to show).


#Template Dashboard Admin
This framework uses a free bootstrap template: http://medialoot.com/item/lumino-admin-bootstrap-template/<br />
It's easy and light dashboard, sufficient for the purpose of this demo.

