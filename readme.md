功能說明
1. 工作歷程紀錄
2. 簽核紀錄查詢 - 需連外部MSSQL撈資料, 如果沒有請勿開.
3. 履歷表e化
4. 權限管理

Git Clone

```
git clone https://git.itec.com.tw/mos.tu/note.git note
```


Docker Run


```
# Create Network
$ docker network create --driver bridge lan1
$ docker run --name apache --network lan1 -v /full-path/project:/var/www/html -d -p 80:80 -p 443:443 mostutw/lap
$ docker run --name mysql --network lan1 -e MYSQL_ROOT_PASSWORD=pass -d -p 3306:3306 mysql:5.7.33
```




＠如果 Docker 已經熟悉的話，可以考慮使用 docker-compose 來部署環境，管理上也會比較便利


新增資料庫 note
```
> create database note character set utf8mb4 ;
```


Container

---
Apache 容器
```
$ docker exec -it apache bash
```

修改 Apache conf
```
# vim /etc/apache2/sites-available/000-default.conf
```

```
<VirtualHost *:80> 
ServerName localhost 
ServerAdmin mos.tu@mos.idv.tw
DocumentRoot /var/www/html/note/public
    ErrorLog ${APACHE_LOG_DIR}/note.error.log
    CustomLog ${APACHE_LOG_DIR}/note.access.log combined
    <Directory "/var/www/html/note/public">
            AllowOverride All
    </Directory>
</VirtualHost>
```



修改 openssl
```
＃ vim /etc/ssl/openssl.cnf
```

```
# Con SQL SERVER 2008 R2
openssl_conf = default_conf
[default_conf]
ssl_conf = ssl_sect
[ssl_sect]
system_default = system_default_sect
[system_default_sect]
MinProtocol = TLSv1
CipherString = DEFAULT@SECLEVEL=1
```

切換目錄位置並複製 .env.example
```
cd /var/www/html/note && cp .env.example .env
```

修改參數
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=note
DB_USERNAME=root
DB_PASSWORD=pass
```

安裝套件
```
# composer install
```

建立表格及資料及KEY
```
# php artisan migrate
# php artisan db:seed
# php artisan key:generate
```

複製 adminlte 設定檔
```
# cp config/adminlte.php vendor/jeroennoten/laravel-adminlte/config/
```

修改目錄權限
```
# chown -R root:www-data /var/www
# chmod 2775 /var/www
# find /var/www -type d -exec chmod 2775 {} \;
# find /var/www -type f -exec chmod 0664 {} \;
```




登入 http://localhost





如果你要接續申請 SSL 憑證


啟用SSL模組
```
# sudo a2enmod ssl
```

安裝 certbot 憑證機器人 並執行憑證要求
```
# apt install certbot -y && 
certbot certonly --manual --preferred-challenges dns -m mos.tu@mos.idv.tw -d www.mos.idv.tw
```

 憑證要求後會出現以下訊息，請至 DNS 服務商新增一筆 txt 紀錄，並回到訊息內驗證紀錄
```
Please deploy a DNS TXT record under the name:
_acme-challenge.www.mos.idv.tw.
with the following value:
_CxW-1n6UQ2Mjiu1v_zbyZRUgWbaJkkO4sQaK1EaldU
```



成功後會配發憑證
```

```

上傳憑證、中繼憑證及私鑰至伺服器

編輯 /etc/apache2/sites-available/default-ssl.conf  
```
 <VirtualHost _default_:443> 
	SSLEngine on
	SSLCertificateFile /yourpath/cert.pem
	SSLCertificateKeyFile /yourpath/privkey.pem
	SSLCertificateChainFile /yourpath/chain.pem ( 有可能沒有 )
</VirtualHost>
```

範例如下：
```
<IfModule mod_ssl.c>
        <VirtualHost _default_:443>
                Servername www.mos.idv.tw
                ServerAdmin mos.tu@mos.idv.tw
                DocumentRoot /var/www/html/note/public
                <Directory /var/www/html/note/public>
                        AllowOverride All
                </Directory>
                ErrorLog ${APACHE_LOG_DIR}/note.error.log
                CustomLog ${APACHE_LOG_DIR}/note.access.log combined
                <FilesMatch "\.(cgi|shtml|phtml|php)$">
                        SSLOptions +StdEnvVars
                </FilesMatch>
                <Directory /usr/lib/cgi-bin>
                        SSLOptions +StdEnvVars
                </Directory>
                SSLEngine On
                SSLCertificateFile /etc/ssl/import/letsencrypt/live/www.mos.idv.tw/fullchain.pem
                SSLCertificateKeyFile /etc/ssl/import/letsencrypt/live/www.mos.idv.tw/privkey.pem
        </VirtualHost>
</IfModule>
```

在 000-default.conf 加入轉向到 https 的設定

範例如下：
```
<VirtualHost *:80>
    ServerName www.mos.idv.tw
    ServerAdmin mos.tu@mos.idv.tw
    DocumentRoot /var/www/html/note/public
    ErrorLog ${APACHE_LOG_DIR}/note.error.log
    CustomLog ${APACHE_LOG_DIR}/note.access.log combined
    <Directory "/var/www/html/note/public">
            AllowOverride All
    </Directory>
    RewriteEngine on
    RewriteCond %{SERVER_NAME} =www.mos.idv.tw [OR]
    RewriteRule ^ https://%{SERVER_NAME}%{REQUEST_URI} [END,NE,R=permanent]
</VirtualHost>
```

重新載入Apache設定檔
```
service apache2 reload
```
