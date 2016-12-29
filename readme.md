## Role Based Access Control
Role Based Access Control implemented in this repository is based on users, roles, resources, and permissions. This is purely a demo project, but is aimed at making it extensible to anything as a resource, and any action associated with it. We have three models
```
1. User
2. Role
3. Resource
```
The following relation ships bind the resources,users and roles
```
1. User-Role
2. Resource-Role (permissions)
```
Resource-Role is basically a permission model, with an additional json column, stating its permissions.
It is basically inspired but Amazon Web Services' way of modeling access control, by way of users, policies and user-policy mapping. A policy is nothing but a json document stating the access level.
Instead of having an policy framework, we have resources, and permissions which tell what actions are allowed for which role.

## Assumptions
1. Assuming that there will be some admin panel to add resources, roles and users and also allocate permissions, have made only a nominal API for Users, Roles and Resources
2. Have made a middleware to check RBAC. However the access control check can be done at any level, a middleware is made and routes specify which action and resource is used to access the route

## Installation
- php installation
```
sudo LC_ALL=en_US.UTF-8 add-apt-repository ppa:ondrej/php 
sudo apt-get update
sudo apt-get install php7.0-fpm php7.0-mysql php7.0-curl php7.0-mcrypt php7.0-mbstring php7.0-xml php-xdebug whois
php -v #should reflect version 7
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```
- Mysql 5.7 installation
```
wget https://dev.mysql.com/get/mysql-apt-config_0.6.0-1_all.deb
dpkg -i mysql-apt-config_0.6.0-1_all.deb #select MySQL 5.7 if not already selected and apply.
sudo apt-get install mysql-server
mysqladmin -u root -p version
```
- Project space setup
```
git clone git@github.com:somiithm/RBAC.git <folder name>
cd <folder name>
composer install
cp .env.example .env
php artisan migrate
php artisan db:seed
php artisan serve
```
- open link http://localhost:8000

> .env must have all the right credentials to access Mysql 5.7

## Users Created by DB seeding
- Admin 
```
email - admin@user.com
password - Admin
```
- ReadUser
```
email - read@user.com
password - ReadUser
```
- WriteUser
```
email - write@user.com
password - WriteUser
```
- DeleteUser
```
email - delete@user.com
password - DeleteUser
```
- ReadWriteUser
```
email - readwrite@user.com
password - ReadWriteUser
```
