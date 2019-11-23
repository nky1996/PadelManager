```
   cd docker-compose-lamp
   docker-composer up -d 
   cd ..
   cd filmoteca 
   composer update
   php bin/console doctrine:database:create
   php bin/console doctrine:schema:update --force
  ```
 # How do I create Users?
 ```
  cd filmoteca
  php bin/console fos:user:create
 ```
  # How do I see this proyect?
  > afterwards you will need to navigate throught your navigator to
  > localhost:8000/PruebaSymfony/PadelManager/web/c3po.php/login
 
 
# What if I don't want to do all those steps above?

 > There is already existen enviroment setted up where you can check how it works!
 > check in http://vps757614.ovh.net/PruebaSymfony/new/web/c3po.php/login

