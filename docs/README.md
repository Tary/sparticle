LAIKA FRAMEWORK
===============

Requirements:
-------------
#### The Usual Suspects ####

####[ PHP 5.3+ ]( http://php.net/       )
PHP 5.3 is a minimum requirement.

####[ Apache   ]( http://apache.org/    )
I guess it could run on any http server that can accomodate for PHP.

####[ MySQL    ]( http://www.mysql.com/ ) 
Technically speaking, the database does not have to be MySQL.
In theory, the framework could work with any SQL-like database that is supported by the PHP PDO wrapper class.
However, it just happens that I have only tested the code against MySQL. 
Additionally, other drivers can be written for the database engine as a plugin, as the Laika database layer is a wrapper class.


System Configuration:
---------------------

#### Apache:
In order for URLs to be rewritten properly, `mod_rewrite` and htaccess needs to be enabled.   
For compression of web pages, `mod_deflate` or `mod_gzip` needs to be enabled. 


#### PHP:
Short open tags must be enabled in the *php.ini* file:  
`short_open_tags=On`


#### Optional:
Configure the `upload_max_filesize`, `post_max_size`, `max_execution_time` in the *php.ini* file.  
For the progress bar to work properly the [uploadprogress extension](http://pecl.php.net/package/uploadprogress) for PHP needs to be installed.


#### Permissions:
All directories found within the *tmp* directory must have their permissions set properly for logs and cache files to be written properly. On a unix like system, the *user* or *group* should be set to *www* with a chmod of 755 or 775 respectively. The *error.log* file also needs to have write permissions for user *www*.



Application Configuration:
--------------------------

All application level configurations are made by editing the ***user.conf.php*** file found in the config directory.  
On production servers the development flag needs to be turned off:  
    
    define( 'DEVELOPMENT_ENVIRONMENT', false );
    

If the database settings need to be customized, edit the following lines:

    define( 'DB_TYPE', 'mysql'      );
    define( 'DB_NAME', 'laika_db'   );
    define( 'DB_PASS', 'laika'      );
    define( 'DB_USER', 'laika_user' );
    define( 'DB_HOST', 'localhost'  );
    define( 'DB_PORT',  3306        );
    define( 'USE_PDO',  true        ); // set to false to specify specific wrapper class



Laika Script:
-------------

#### Configuration:
Set the first line to point to location of *PHP* executable binary.  

    #!/usr/bin/php  

Set the *MYSQL_PATH* constant to the *MySQL* default path for your system.
   
    define( MYSQL_PATH, "/usr/local/mysql-5.1.53-osx10.6-x86_64/bin/");


#### Usage:
You can generate the basic scaffoling for the MVC pattern and database tables by running the laika cli script.  
For generating the MVC components the commands are as follows:  

> php laika -model *NAME FIELD:TYPE:SIZE*  

> php laika -controller *NAME*  

> php laika -view *NAME*  

The NAME of should be the non-plural name of the MVC component to be generated.  
The Model requires some extra parameters to be passed. These include the name of the database column and its datatype.  
The size of the data is optional. If not specified, it will be set to the MySQL default.

#### Examples:
Switch the working directory into the *scripts* directory.  
Precede the command with a `./` or `php` to ensure the system looks for the script in the current working directory.   

> $ cd scripts

> $ php laika -model comment user:int:16 comment:text

> $ php laika -controller comment

> $ php laika -view comment


#### SQL Dumps:
Additionally, the script can generate sql dumps by passing in the following flags.  
The `dump` flag will generate a full backup of the database.  
The `schema` flag will generate a schema sql dump.  
Use the `schema` flag to make database initialization and migration files.

> $ ./laika -schema

> $ ./laika -dump