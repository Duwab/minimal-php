minimal-php
===========

Minimal php framework


Apache Config:
```
<VirtualHost XX.XX.XX.XX:80>
        DocumentRoot /home/www/minimal-php
        ServerName minimal.duwab.com
        <Directory /home/www/minimal-php>
                Order Allow,Deny
                Allow from all
                AllowOverride all
        </Directory>
</VirtualHost>
```

to create a new branch:
git clone https://github.com/Duwab/minimal-php.git folder_name;
cd folder_name;
git branch branch_name;
git checkout branch_name;
git push origin branch_name;
git branch --set-upstream-to=origin/branch_name branch_name

Start to develop!
