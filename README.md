# Matrix_Eternity-SMDR-with-Linux
SMDR With Linux


This software can be used with Matrix's IPPBXs Eternity LE/ME/GE/PE/NE and NAVAN CNX200 models

This Software have 3 sections.
1. Used Perl script to Capture online SMDR/CDR, parse & send it to store the Data in Mysql Database
2. Used MySQL to store the parse data
3. Used PHP(5.4.16 & onward) to represent it in Web GUI

Section1:
	Install Strawberry/active state perl from
	http://www.perl.org/get.html
	Install Perl::modules as mentioned below if not installed by CPAN command(e.g. CPAN DBD::mysql) from command line (if gives error while start the script then only).
	1. DBI
	2. DBD::mysql
	3. IO::Socket

1) Configure/edit Local IP Address and port on which computer will collect the Online SMDR in 'eternity.pl' perl script
2) Configure/edit Mysql Host name, Database name, username & password of mysql in in 'eternity.pl' perl script

Section2:
install mysql(5.6.12 & onward) database from root directory to /smdr/install/install.php
Install WAMP(Windows)(2.4 and onward) or LAMP(linux) portal or stand alone mysql(Download WAMP from http://www.wampserver.com/en/)
Enter below URL in Web browser for DB installation
http://localhost/smdr/install/install.php

Section3:
Install WAMP(Windows)(2.4 and onward) or LAMP(linux) portal to use PHP
http://www.wampserver.com/en/

Place this 'smdr' folder @root directory of httpd(For wamp, place this folder 'smdr' at installation directory of wamp's sub directory named 'www')

Change allow access right from httpd.conf file of Apache to access web server from other computer also

<Directory "C:/wamp/www">
     Order Allow,Deny
     Allow from all
</Directory>

Default User name and Password to login are
username: manish	
password: 1234
