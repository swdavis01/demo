demo
====

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
Generate maps first:  
php bin/console doctrine:mapping:import --force CoreBundle xml

Generate entities with annotations:  
php bin/console doctrine:mapping:convert --force annotation ./src  
Create getters and setters:  
php bin/console doctrine:generate:entities CoreBundle 

Doctrine keeps config in:
src/Swd/CoreBundle/Resources/config/doctrine/     

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

## Cache  
php bin/console cache:clear --env=dev
If problems:
sudo rm -Rf var/cache/*


Today  
Look into Doctrine join table
Move auth to core
Connect login to them
 

