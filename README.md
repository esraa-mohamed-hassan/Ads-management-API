<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## Installation Steps

- [ Clone project ](https://github.com/esraa-mohamed-hassan/Ads-management-API.git).
- Run this commands in terminal.
    - composer update
    - php artisan migrate --seed
    - php artisan serve
    
- Here's Documentation of Postman to Test API Requests:
  - [ Postman Documentation ](https://documenter.getpostman.com/view/17426521/2s83KNjnMw).

- Run this command to send mail
    - php artisan schedule:run

- Run this command to Test Ads API for all files testing
    - php artisan test
    
    
 - Run this command to Test Ads API for each file
    - php artisan test --filter TagsTest
    - php artisan test --filter CategoriesTest
    - php artisan test --filter AdvertisersTest
    - php artisan test --filter AdsTest 

