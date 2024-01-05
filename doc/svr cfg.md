
nginx put 405 
To add HTTP and WebDAV methods like PUT, DELETE, MKCOL, COPY and MOVE you need to compile nginx with HttpDavModule (./configure --with-http_dav_module). Check nginx -V first, maybe you already have the HttpDavModule (I installed nginx from the Debian repository and I already have the module).

Then change your nginx-config like that:

location / {
root     /var/www;
dav_methods  PUT;
}
