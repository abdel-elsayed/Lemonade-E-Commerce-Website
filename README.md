# Php_Project
This project is an E-commerce website that is created using PHP and MySQL  

# Authors
* [Warren Simpson](https://github.com/Warren28)
* [Abdelrahman Elsayed](https://github.com/abdel-elsayed)
* [Marko Hannallah](https://github.com/marconabil123)

## Front Page
![](images/frontPageDemo.png)              


## Login and Sign up
![](images/loginPageDemo.png)
To access the website, users can either login or sign up.
Upon logging in, session variables are used to store the information of the user to be used throughout the website.


## First time signed up
![](images/profile1Demo.png)
On signing up, the user's information are stored in session variables 
and sent over to the database using prepared SQL statements to prevent SQL injection.

## Adding Items
![](images/bagsPageDemo.png)


## Wishlist
![](images/profile2Demo.png)
Session variables are used to store the items in the wishlist as long as the user is logged in.
Upon logging out, the wishlist items are stored in the database so it can be accessed later by the user when logged back in.

## Function
* Login/signup
* Like/unlike items
* add
