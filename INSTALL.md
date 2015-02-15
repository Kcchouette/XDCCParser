#INSTALL
##Requirements:
 * PHP5 (Smarty 3.x is _NOT_ compatible with PHP4)
 * [Smarty Template Engine](https://github.com/smarty-php/smarty/) - we offer the last release if you clone
 * A modern web browser - Internet Explorer 6 is _NOT_ supported

##Highly Recommended:
 * PHP XCache extension (will work without it, but will be noticeably slower if there are many packs.) 
 * PHP CURL extension - without CURL, packlists served by dinoex's built in http server will not be downloaded correctly.
 * Normal txt files on a proper webserver (apache, lighty, nginx, etc) and local txt files will still be fine.

See your host for questions regarding the requirements.


##Instructions:

1. make sure templates_c and cache are chmoded to 777
2. edit admin.php and change the user and password!
3. visit admin.php to add and delete bots.
4. access URIs can be http, https, ftp, or a file path.
	examples:
	http://yoursite.com/packlist.txt
	ftp://user:pass@yoursite.com/packlist.txt
	/home/xdcc/bot/packlist.txt

 * to show only group specific packs, add a group filter in admin.php.
	please do not include opening and closing tags (e.g. [,]).
	example: onegroupnamehere
	multiple groups example: (groupnameone|groupnametwo|groupnamethree)
	WRONG: [durhuricanread]

###Bookmarks:
 * bookmarks can be added in the admin panel
 * Various other settings such as skin and irc channel can be found in core.php

We want your feedback! Give us feedback and submit bug reports.

