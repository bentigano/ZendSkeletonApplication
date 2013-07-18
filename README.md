ZendSkeletonApplication
=======================

Introduction
------------
This is a simple, skeleton application using the ZF2 MVC layer and module
systems. It started with ZF's original ZendSkeletonApplication and is 
getting tweaked and simplified to show how to work with ZF2 MVC.

htaccess (on Xampp in a subdirectory)
------------
    RewriteEngine On
    # The following rule tells Apache that if the requested filename
    # exists, simply serve it.
    RewriteCond %{REQUEST_FILENAME} -s [OR]
    RewriteCond %{REQUEST_FILENAME} -l [OR]
    RewriteCond %{REQUEST_FILENAME} -d [OR]
    RewriteRule ^(xampp|phpmyadmin|favicon.ico|robots.txt) - [L]
    RewriteRule ^.*$ - [NC]
    RewriteRule ^(?!ZendSkeletonApplication/public/).*$ ZendSkeletonApplication/public%{REQUEST_URI} [L,NC]
