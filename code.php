RewriteEngine On

# =====================================================
# 0) EXCLUDE ADMIN from external .php removal redirect
#    (Admin can keep .php in URLs if needed)
# =====================================================
RewriteCond %{REQUEST_URI} !^/admin [NC]
RewriteCond %{THE_REQUEST} \s/([^.]+)\.php[\s?] [NC]
RewriteRule ^ /%1 [R=301,L]

# =====================================================
# 1) Internal rewrite: clean URL → .php
#    (Works for BOTH frontend AND admin)
# =====================================================
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME}.php -f
RewriteRule ^(.+)$ $1.php [L,QSA]


<!-- froent end code for above  -->




RewriteEngine On

# =====================================================
# 0) EXCLUDE ADMIN from external .php removal redirect
#    (Admin can keep .php in URLs if needed)
# =====================================================
RewriteCond %{REQUEST_URI} !^/admin [NC]
RewriteCond %{THE_REQUEST} \s/([^.]+)\.php[\s?] [NC]
RewriteRule ^ /%1 [R=301,L]

# =====================================================
# 1) Internal rewrite: clean URL → .php
#    (Works for BOTH frontend AND admin)
# =====================================================
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME}.php -f
RewriteRule ^(.+)$ $1.php [L,QSA]

<!-- backend code  -->