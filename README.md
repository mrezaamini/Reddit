<p align="center"><img src="https://github.com/mrezaamini/Reddit/blob/main/redditGif.gif" width="600"></p>

## About Project:
Reddit is a well-known social news aggregation, web content rating, and discussion website. Registered members submit content to the site such as links, text posts, images, and videos, which are then voted up or down by other members. We tried to implement a simple version of reddit in this project (this project is implemented as the final project for our Internet Engineering Course in shahid beheshti university, Tehran, Iran. So the platform language is Persian). We used SQL database and php laravel technology to implement this project. This simple version of reddit consists of different parts that we discussed bellow. 

## Register and Login:
In Register page client can make a user with name, surname, email(unique and valid) , username (unique) and password (at least 8 characters consists of uppercase, lowercase and numbers). After that the validated user will added to database (SQL). user can login with the username and password. After logging in user can sign out with the button that is assigned for logging out.

## Main page: 
In this page user can see the posts from the forum that the user belongs to. In Addition, user can sort this post based on post time, number of likes/dislikes, etc. User can view hottest posts in the main page and there is a search bar on top of the main page that user can use to search in posts, people or forums (communities) and get redirected to the specific result.

## User part:
Each user can perform different kind of works. A user can create, join or edit forums. A user can create, modify, comment, like/dislike and save posts in forums, in addition user can reply to posts and comments. About personal informations its obvious that user can modify and change account information and password. and in each forum user can sort posts and forums based on likes/dislikes, publish date, etc. Each forum has a creator and some admins that creator can assign them.

## Search part:
In This simple reddit project clients can search in the search bar through posts and forums with keywords and people names. After finding out the result user can click on the specific result and get redirected to it.

## Additional parts:
As we discussed above users can save posts. In this project you can see password in login and register page (for better experience use IE). You can change theme from light to dark mode. You can report posts or block users from accessing to forums and posting or making changes (like commenting, etc).

## Running project:
For running this project you can use artisan (Note: remember to have sql data base enabled on your system, for example you can use wamp on windows).
use following instructions to run project:

`php artisan migrate:refresh` </br>
`php artisan cache:clear` </br>
`php artisan route:clear` </br>
`php artisan optimize` </br>

these first scripts is needed only for the first time you want to initialize your project and it will clear every cache and tables in the data base. after that each time you want to run the project only use script bellow in the terminal and enjoy.

`php artisan serve` </br> 

after that your project will run on port 8000 and you can watch data base from the phpadmin route (you can change or set database username and password in .env file)

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

