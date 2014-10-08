minimal-php
===========

Minimal php framework


Apache Config:

<VirtualHost XX.XX.XX.XX:80>
        DocumentRoot /home/www/minimal-php
        ServerName minimal.duwab.com
        <Directory /home/www/minimal-php>
                Order Allow,Deny
                Allow from all
                AllowOverride all
        </Directory>
</VirtualHost>
