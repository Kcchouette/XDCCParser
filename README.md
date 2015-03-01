# XDCC Parser Project Page 
Based from [XDCC Parser 
(web-archive)](http://web.archive.org/web/20120826215828/http://xdccparser.is-fabulo.us/) and fully compatible until [Kcchouette/XDCCParser@c2b0ab4](c2b0ab45e26a4d8a10aaef23a4abd25054093039)
### About XDCC Parser

XDCC Parser is a PHP/AJAX script that parses packlists created by iroffer and presents the packlist in a fully searchable web2.0 environment.

XDCC Parser aims to make XDCC packlists more presentable while staying efficient and lightweight.
Originally developed by DrX, and then xshadowfire.

### Supported browsers

Internet Explorer 7+, Firefox 3+, Opera 9.6+, Chrome, Safari 4, Midori, most modern browsers

### Feedback/Bug Reports/Development

 * On [GitHub](https://github.com/Kcchouette/XDCCParser-global/) 

### FAQ

**Q: This script is retarded, how the hell do you install it?**

*A: We have tried our best to make sure XDCC Parser is error free, but as it is still a relatively new script,
there are bound to be bugs.*

**Q: I set the `ADMIN_USER` and `ADMIN_PASS` but I can't log in to admin.php**

*A: When PHP is running in CGI (with some hosts such as Dreamhost), `PHP_AUTH_USER` and `PHP_AUTH_PW` are not sent to PHP, causing admin authentication to fail.
To bypass this, remove the authentication codeblock from admin.php and use your webserver's basic authentication for admin.php.*
