Requirements:
-------------
###[PHP 5.3+](http://php.net/)
###[Apache](http://apache.org/)
###[MySQL](http://www.mysql.com/)


System Configuration:
---------------------

###Apache:
In order for URLs to be rewritten properly, `mod_rewrite` and htaccess needs to be enabled.   
For compression of web pages, `mod_deflate` or `mod_gzip` needds to be enabled. 


###PHP:
Short open tags must be enabled in the *php.ini* file:  
`short_open_tags=On`


###Optional:
Configure the `upload_max_filesize`, `post_max_size`, `max_execution_time` in the *php.ini* file.  
For the progress bar to work properly the [uploadprogress extension](http://pecl.php.net/package/uploadprogress) for PHP needs to be installed.


###Permissions:
All directories found within the *tmp* directory must have their permissions set properly for logs and cache files to be written properly. On a unix like system, the *user* or *group* should be set to *www* with a chmod of 755 or 775 respectively. The *error.log* file also needs to have write permissions for user *www*.


Application Configuration:
--------------------------

All application level configurations are made by editing the ***user.conf.php*** file found in the config directory.



Laika Script:
-------------

### Usage: 
> **php laika -model NAME FIELD:TYPE:SIZE**

> **php laika -controller NAME**

> **php laika -view NAME**


### Examples:
> laika -model comment user:int:16 comment:text

> laika -controller comment

> laika -view comment

> laika -schema

> laika -dump