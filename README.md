Install
========================

Clone the repository in your Web Server folder.
```
git clone https://github.com/Lefafa/symfony-training.git
```
Go to the new project folder.
```
cd symfony-training
```
Install with composer.
```
composer install
```
Delete cache and log folders.
```
rm -rf app/cache/*
rm -rf app/logs/*
```
Give write-acccess to these folders.
```
HTTPDUSER=`ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
```
On MacOS:
```
sudo chmod -R +a "$HTTPDUSER allow delete,write,append,file_inherit,directory_inherit" app/cache app/logs
```
```
sudo chmod -R +a "`whoami` allow delete,write,append,file_inherit,directory_inherit" app/cache app/logs
```
on Linux:
```
sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX app/cache app/logs
```
```
sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX app/cache app/logs
```
If you have any problems with permissions, look at this link: [Setting up or Fixing File Permissions][1]

Create the database:
```
php app/console doctrine:database:create
```
Create the schema of the database:
```
php app/console doctrine:schema:update --force
```
Load the fixtures:
```
php app/console doctrine:fixtures:load
```
If you work on localhost, go to: [http://localhost/symfony-training/web/app_dev.php][2]


[1]: http://symfony.com/doc/current/setup/file_permissions.html
[2]: http://localhost/symfony-training/web/app_dev.php
