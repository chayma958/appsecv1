<h1>configuration nginx:</h1>
<p>server {
    listen 443 ssl;
    listen [::]:443 ssl;
    include snippets/self-signed.conf;
    include snippets/ssl-params.conf;

    root /var/www/appsecv1;
    index index.php index.html index.htm index.nginx-debian.html;

    server_name localhost;

    modsecurity on;
    modsecurity_rules_file /etc/nginx/modsecurity.conf;
    ssl_certificate /etc/ssl/certs/nginx-selfsigned.crt;
    ssl_certificate_key /etc/ssl/private/nginx-selfsigned.key;
    ssl_protocols TLSv1.2;
    gzip off;    

    location / {
        proxy_pass http://localhost:8000;
        proxy_set_header Host $host;
        proxy_set_header X-Forwarded-Proto https;
        proxy_read_timeout 60s;
        proxy_connect_timeout 60s;
        proxy_set_header X-Real-IP $remote_addr;
 }


    
    location /phpmyadmin {
        alias /usr/share/phpmyadmin;
        index index.php;

        location ~ ^/phpmyadmin/(.*\.php)$ {
            include snippets/fastcgi-php.conf;
            fastcgi_pass unix:/run/php/php8.2-fpm.sock;
            fastcgi_param SCRIPT_FILENAME $request_filename;
        }

        location ~* ^/phpmyadmin/(.*\.(jpg|jpeg|gif|css|png|js|ico|html|xml))$ {
            try_files $uri =404;
        }
    }

    location /ossec-wui/ {
        root /var/www/html;
        index index.php;

        location ~ \.php$ {
            include snippets/fastcgi-php.conf;
            fastcgi_pass unix:/run/php/php8.2-fpm.sock;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            include fastcgi_params;
        }

        location ~* \.(jpg|jpeg|gif|css|png|js|ico|html|xml)$ {
            try_files $uri =404;
        }
    }
}

server {
    listen 80 default_server;
    listen [::]:80 default_server;
    server_name localhost;

    # Redirect all HTTP traffic to HTTPS
    return 301 https://$host$request_uri;

   }
</p>
