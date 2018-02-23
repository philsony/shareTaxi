# MARKETMODULE
Fully functioning. No Design yet. basic page response.
=================================================================================================================================
3 FILES

1. testmarket.php (the "so-called-index")
2. search.php
3. joinpool.php
4. myactive_pools
5. dbconnect.php
6. OTHERS
7. NOTE!
========================================================================================================
TEST MARKET
> uses session to identify user
> CURRENT code uses DUMMY VALUE, substitute when project is gathered

> Header contains
	> MARKET MODULE text
	> search bar
		> converts text to LAT,LNG code by using JQUERY

> Default Market displays the following
	> a POOL with the same ORIGIN with the USERS current position AND
	> a POOL with less than FOUR people AND
	> A POOL whose status is NOT FULL (tentative)
	> ORDERED FROM TOP (NEWEST POOL) TO BOTTOM (OLDEST POOL)
	> OTHER POOLS constraint not mention => WONT DISPLAY THE POOL!

the sql statement stored in variable ($q) does this for us + fetches all the necessary info for the pool
	> the sql statement compares LATITUDE AND LONGITUDE by rounding off to the second decimal place
	> this serves as a "radius" for their location

+++++++++++++++++++++++ JAVASCRIPT FUNCTIONS IN TESTMARKET.PHP +++++++++++++++++++++++++++++++++++++++++

initMap() - is with css display:hidden since we dont need a map, but is needed for geocoding
	- calls textualaddressorig() and textualaddressdest()
JQUERY on_click on FORM (searchform's submit button)
	- converts TEXTUAL ADDRESS to LAT,LNG CODE through GOOGLE GEOCODING API

=======================================================================================================================
SEARCH.PHP
> still uses session
> Current code still uses DUMMY SESSION ID VALUE (change when gathering codes)

> Header
	> FUNCTIONS the same way as the header in TESTMARKET.PHP
	> REFER ABOVE

> MARKET displays the following
	> A POOL with the same ORIGIN with the USERS current position ORRRRRR
	> A POOL WITH THE SAME DESTINATION WITH THE USERS desired DESTINATION
	> A POOL WHOSE STATUS IS NOT FULL
	> A POOL WITH LESS THAN 4 PEOPLE
	> ORDERED FROM TOP (NEWEST POOL) TO BOTTOM (OLDEST POOL)
	> OTHER pools not included here are not displayed!


the sql statement stored in variable ($q) does this for us + fetches all the necessary info for the pool
	> the sql statement compares LATITUDE AND LONGITUDE by rounding off to the second decimal place
	> this serves as a "radius" for their location

++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
SAME FUNCTIONS WITH TESTMARKET.PHP (REFER ABOVE)

======================================================================================================================
joinpool.php

> INSERTS the user to the selected pool GIVEN:
	> he/she is not in the pool yet.
> is just a placeholder
	> since when a user joins a pool, they should be redirected to the chat room directly.

===================================================================================================================
myactive_pool
> the page that allows the OWNER OF CERTAIN POOLS to view his created ROUTES
	> can UPDATE ROUTE info here
	> CAN DELETE ROUTE HERE
	> CAN GO TO MESSAGES HERE
> SEPARATES CREATED POOLS FROM JOINED ONES
	> CREATED POOLS are prioritized

===================================================================================================================
dbConnect.php

> USES MYSQLI_CONNECT
> DB NAME OF sharetaxi

===================================================================================================================

THINGS TO CONNECT FROM OTHER GROUPS
> WHEN no pool is available, there will be a button to create a pool
	>INSERT CREATE A ROUTE HERE
> WHEN THERE IS A POOL, there will be a JOIN POOL button
	> redirect to somewhere (group chat, page, notification, modal, etc.) -> either way it inserts the user to the database
	> INSERT MODULES here
> HEADER
	>MAY PUT PROFILE, SETTINGS, ETC.

==================================================================================================================

NOTE!!
> FRESA, MAD, AND TEAM FLUFF -> ADDED TWO additional columns in ROUTE TABLE (origin_address and destination_address)
so that computations won't be repetitive and access is fast

> refer to sql in this repository
==============================================================================================================
