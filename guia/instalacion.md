# Instrucciones de instalación y despliegue

## En local
Deberemos instalar, siguiendo el orden, las siguientes aplicaciones:
* Apache2:

~~~
sudo apt update  
sudo apt install apache2
~~~
 
1 PHP7:

~~~
sudo apt install php7.1 apache2 libapache2-mod-php7.1 php7.1-cli php7.1-pgsql php7.1-sqlite3 sqlite sqlite3 php7.1-intl php7.1-mbstring php7.1-gd php7.1-curl php7.1-xml php7.1-xdebug php7.1-json
~~~

2 PostreQSL:

Instalación:

~~~
sudo apt install postgresql-9.6 postgresql-client-9.6 postgresql-contrib-9.6
~~~

Creación BBDD y usuario:

~~~
sudo -u postgres createdb chici
sudo -u postgres createuser -P chici
~~~

Comprobar que entra correctamente:

~~~
psql -h localhost -U chici -d chici
~~~

3 Composer:

Ejecutar las siguientes líneas:

~~~
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"

sudo mv composer.phar /usr/local/bin/composer

sudo apt install php-xml php-mbstring php-intl

composer global require --prefer-dist friendsofphp/php-cs-fixer squizlabs/php_codesniffer yiisoft/yii2-coding-standards phpmd/phpmd
~~~

4. Descargar Yii

Desde la carpeta web
~~~
php composer.phar create-project yiisoft/yii2-app-advanced advanced 2.0.13
~~~
o descargar del siguiente enlace [Yii2 advanced](https://github.com/yiisoft/yii2/releases/download/2.0.13/yii-advanced-app-2.0.13.tgz)

5. Configurar los dominios (chiback.dev y chifront.dev), para el backend y el frontend:

[Despligue-hosts](https://github.com/hftomler/chipionacity/blob/master/backend/web/imagenes/imgGuia/despliegue-hosts.png)
