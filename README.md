# UMIS-for-TA
Creating a UMIS only for TA and Faculty

IMPORTANT! First create an admin account , change 2step to 0 (if you are using a made up email) , also change active to 1 (to make the account to be active and to be able to log in)
Note:It only accepts email that ends with ewubd.edu . Change the invalidUid function in addition/functions.add.php page to remove this feature.

role=2 (admin)
role=1 (faculty)
role-0 (ta)

Email and Role are used as Session variables 

First check the loginUser function in additional/function.add.php page. Check the PHPmailer Object. 

For database connection check additional/dbh.add.php

Header and Nav files are- header.php (when not signed in) ,userheader.php (navigation file for non admin), adminheader.php(naviagton file for admin)

Common files used both by admin and non-admin (navigation is shown based on role)- profile.php,SpecialPost.php,ShowSpecialPost.php

SQL file dowloaded from phpmyadmin is saved in sql folder (cse479)

Also have invidual sql to create each table



                                             

