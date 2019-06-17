# Notes

-   Front-end is a mixture of React and Blade. The reason why I went with React is that the I wanted to use one of the datatable libraries to achieve `sort`, `search`, `filter`, `pagination`, etc. features. It's easier in my opinion.

# Setup

-   `git clone https://github.com/shawnGao87/contactinfor.git'

-   `cd contactinfo`
-   `npm install`
-   `composer install`
-   `cp .env.example .env`
-   create database / schema named contactinfo
-   change

```
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

TO

```
DB_DATABASE=contactinfo
DB_USERNAME=YOUR_DATABASE_USERNAME
DB_PASSWORD=YOUR_DATABASE_PASSWORD
```

ADD
`GOOGLE_MAPS_API_KEY=AIzaSyAq823MjPN5Np0ASfOS5lLXtOmxif2C-t4`

-   `php artisan migrate`

-`composer dump-autoload` -`php artisan db:seed --class=ContactTableSeeder` It creates 50 dummy contacts each time

make sure .babelrc is there
