NightOwl
========

# Requirements

1. Php 5
  ```
  sudo add-apt-repository -y ppa:ondrej/php
  sudo apt-get update
  sudo apt-get install php5.6
  sudo apt-get install php5.6-mbstring php5.6-mcrypt php5.6-mysql php5.6-xml
  ```
  
  For OSX
  
  ```
  brew install php56 php56-mcrypt
  ```

2. Mysql

# To run

1. create a DB named nightowl
2. `DATABASE_URL=mysql://root:password@localhost/nightowl php artisan migrate`
3. `DATABASE_URL=mysql://root:password@localhost/nightowl php artisan serve`
