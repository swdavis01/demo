demo
====

PHP
A Symfony project created on November 30, 2016, 10:41 pm.  
Symfony 3 Demo Site  

Install Symphony components using composer  

## Install console  
./composer.phar require symfony/console

## App Kernel  
app/AppKernel.php  
Local bundles as well as third party bundles installed from composer  
are registered in the registerBundles() function. 

## Create Core Bundle  
php bin/console generate:bundle --bundle-name=CoreBundle  
This is a shared bundle that can be reused across projects.  
The database object entities live in this bundle.  
The services that access the database live in this bundle.  

## Create Security bundle
php bin/console generate:bundle --bundle-name=SecurityBundle  
This is a shared bundle that can be reused across projects.  
To do:  
Look into handlers    
Handlers/SuccessHandler.php 
Handlers/LogoutHandler.php 
Handlers/AccessDeniedHandler.php


## Create Public Bundle
php bin/console generate:bundle --bundle-name=PublicBundle
This is a standalone bundle specific to this project

## Create Admin Bundle
php bin/console generate:bundle --bundle-name=AdminBundle
This is a standalone bundle specific to this project

## Doctrine
### Generate entities from the database schema
Generate entities with annotations from existing database:  
DON'T DO THIS. Create / update database schema from entities instead.
php bin/console doctrine:mapping:convert --force annotation ./src  
Create getters and setters:  
php bin/console doctrine:generate:entities CoreBundle 

Create / update database schema from entities  
php bin/console doctrine:schema:update --force --complete

Or, alternatively, let Doctrine dump the SQL commands it would execute:
php bin/console doctrine:schema:update --dump-sql --complete

Check if mapping in sync   
php bin/console doctrine:schema:update --force --complete   

Clear cache
php bin/console doctrine:cache:clear-metadata 
php bin/console doctrine:cache:clear-query  
php bin/console doctrine:cache:clear-result

## Session Management
app/config/config.yml  
framework:  
session:  
cookie_lifetime: 86400  
gc_maxlifetime: 1800  
gc_probability: 1  
gc_divisor: 1

## Install XDebug  
sudo apt-get install php-xdebug  

## Admin Theme  
https://gurayyarar.github.io/AdminBSBMaterialDesign/documentation/#/  
Authentication disabled for admin_theme in:  
src\Swd\SecuredBundle\Resources\config\security.yml  

## ip-address
192.168.56.101

## Cache  
php bin/console cache:clear --env=dev
If problems:
sudo rm -Rf var/cache/*


Today  
Look into Doctrine join table
Move auth to core
Connect login to them

## 2017-01-02
Got stuck with doctrine / orm issue.  
Setup annotations in entity but they were having no effect.  
After wasting a full day of holidays realised that by default orm using xml definitions at:  
src/Swd/CoreBundle/Resources/config/doctrine  
To change set orm section in config:  
app\config\config.yml
mappings:  
    CoreBundle:
        type: annotation  
Could then delete folder:  
src/Swd/CoreBundle/Resources/config/doctrine  
because no longer used.  
         
### Mapping
Replaced the many-to-many annotation mapping directly between two main entity classes with a one-to-many annotation in the main entity classes and two 'many-to-one' annotations in the Associative Entity class.  

## 2017-01-05  
- Added voters to check that the logged in user has sufficient permissions to edit the user list.  
- Added UserType class to enable user form to be used from anywhere.

## 2017-04-16
- Decided to remove Doctrine. Mapping many to many tables causing too many problems.
- Replaced with PHP PDO.

## 2017-04-23
- Started Asset class.

