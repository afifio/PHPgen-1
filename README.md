# PHPgen #

A raw content management system based on simple Files. No use of Database, so it will be usable for small websites that doesn't has a lot of Content. Latest `master` running at [www.exigem.com/gen](http://www.exigem.com/gen/)


## Dependencies ##

*  [PHP][]4 better [PHP][]5
*  PHP XML-[PHP Dom][]


## Installation ##

Get last version from github.com by following command:

    git clone git://github.com/vaddi/PHPgen.git

Edit verify.php to change username and password, otherwise we will use username *admin* and password *nimda*. At the Time there is no function for adminpage, just a placeholder index for later work.


## Usage ##

Simply editing the config.php File to fit you needs. Important Settings are BASE, MAIL, SITE_OWNER ,SITE_PASSWD. 


## Idea ##

Based on a small Website for a Friend we buld up the Base in a few Days. Later we decide to use the System oftener and bring it up to others becaus, its just simple. Beside the maincoding the Idea grown up by more and more Features:

*  All Pages will viewed in one Menu (No Submenu at the Time) 
*  All Pages are stored in simple plain Textfiles
*  Have to be very userfriendly by simple Structure and Usage


## On Going ##

Would be nice to have:

*  Better Plugin-Engine.
*  Submenu for Subpages 
*  CRUD functions for pages and newsfiles.
*  handheld & mobile CSS File


## Credits ##

1.  [Contact-Form][] base Idea to Contactfomular by Patrick Schoch


[Contact-Form]: http://www.pa-s.de/
[PHP-Libary]: http://alexandre.alapetite.fr/doc-alex/domxml-php4-php5/
[PHP Dom]: http://de.php.net/manual/en/book.dom.php
[PHP]: http://php.net/

