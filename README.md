# Group 11 Team Project - E-spresso

E-spresso is a coffee shop website that sells coffee shop based products like drinks, beans, pods as well as pastries and sweet treats! It currently has working pages for the home, products, product details, about us, login/sign up, basket and working checkout and dashboard for both users and admins.

## How to use

- If you would like to view and use this website on our server go to "https://cs2team11.cs2410-web01pvm.aston.ac.uk/public/".

- To run this locally you must have:
	- An IDE (We used Visual Studio Code)
	- PHP installed (We used XAMPP)
	- Node.js installed as well as composer

	- In the terminal run `npm install`, `composer install`
	- Copy the info in .env-example into a new file called .env
	- In the terminal run `php artisan key:generate`
	- Then you can run `php artisan migrate` to import the database
	- And then `php artisan db:seed` to add products to the database
	- And finally `php artisan serve` to run the site and be used in your browser

## Features

- Navigate products using the filters on the products page.
- Add items to basket when clicking on an item details
- Edit items in your basket on the basket page
- Checkout your cart to create an order
- Sign up and create an account
- Login with your account 
- Add a blog to the blogs page
- A toggle button to switch between light and dark mode
- User dashboard to view orders and change personal information
- Option in user dashboard to subscribe 
- Admin dashboard to view all users and change personal information

## Pages available

- Home
- Products
- Product details
- About us
- Blogs
- Basket
- Checkout
- Sign up
- Log in
- User dashboard
- Admin dashboard
