# morsum_demo
recipes demo fwk for morsum challenge

#Overview
I found interesting to develop a demo code about recipes software. You can create ingredients and then do the recipes using them and defining the unit of measurament and quantity (a tought to create a bigger application and bussiness idea).
So you can extend this code in anyway!!

#How to install
1)install apache + mysql php >= 5.2<br />
2)create database recipe_demo (there is a .sql in root folder)
3)define the URL in config folder example: localhost/morsum_demo_recipes

That's all, you will be able to see a panel with demo data and a couple of recipes and ingredients loaded!

#Architecture MVC
application => controllers, models and views.
config => variables to set for framework works.
libs => the core of the framework.
public => css,images,js, and all public information.

#Configuration
inside root folder config:
1)Default Controller => define default controller if it is not defined (index method default)
2)Environment => Development (all php errors on) or Production
3)Project Url => the base path of the project
4)DB Configuration => parameters for pdo db connection
5)MVC Paths => define path for controller,model and view folder
6)Constants Path => define constants.

#URI Routing
For example, let’s say you want your URLs to have this prototype:
example.com/recipe/our_recipes/rec_id/1/

The first segment define controller
The second segment define method
Then the continuos segments indicates parameters in pairs key/value
key => rec_id
value => 1

#Libraries
inside root folder libs:
1)Router => generate url that index.php? pass
2)Controller => Load model for use, clear post data.
3)Model => Extends from Database Class to access by pdo to mysql and has defined several methods for quick use of mysql insertion.
4)View => Load information passed by Controller.
5)Database => PDO connection definition.
6)Functions => General functions for the application, any function that want to be global accesible should be declare inside this file.

#Controller
inside root folder application/controllesr:
Extends of A_Controller, defines method and make the connection between model and view, recive requests and load the view with the necessary data.

In general is a good practice define different controllers for each entity of the database to keep the business tidy, in this case i used Recipe controller to manage code for recipes and ingredients, could be separate.

There is a Panel controller, it's an idea to know how the business is running (just html and jquery code, but interesing to show).


#Template Dashboard Admin
This framework uses a free bootstrap template: http://medialoot.com/item/lumino-admin-bootstrap-template/
It's easy and light dashboard, sufficient for the purpose of this demo.

