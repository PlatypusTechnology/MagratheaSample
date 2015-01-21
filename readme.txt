Creating Virtual Host:



***

Mac OSX 10.7:
		cd /private/etc/apache2/users/
	look for your configuration file (it may be one directory up as well)
		edit that file:
			[
				<VirtualHost *>
				    ServerName MagratheProject
				    ServerAlias MagratheaProject
				    DocumentRoot /Users/[user]/Sites/[path]/app
				    <Directory /Users/[user]/Sites/[path]/app>
				        Options Indexes FollowSymLinks MultiViews
				        AllowOverride All
				        Order allow,deny
				        allow from all
				    </Directory>
				</VirtualHost>
			]
		cd /private/etc/
	edit hosts file:
			[
				127.0.0.1 	path.name.to.my.project
			]
	finally, restart apache:
		sudo apachectl restart



