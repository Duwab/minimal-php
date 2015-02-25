<VirtualHost *:80>
    ServerName er.linecoaching.com
    DocumentRoot /var/www/
    ProxyPass / http://91.121.112.64:3000/
    ProxyPassReverse / http://91.121.112.64:3000/
    ProxyPreserveHost On
</VirtualHost>
<VirtualHost *:3000>
        DocumentRoot /var/www
    Redirect / http://er.linecoaching.com/
</VirtualHost>


https://technique.arscenic.org/lamp-linux-apache-mysql-php/apache/modules-complementaires/article/mod_proxy-rediriger-en-tout