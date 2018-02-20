Sharetaxi
=======

MAD		:: Joe, Allena, Thessa

Fresa	:: Michael, Grace, Jon

---

## Table of Contents
 
 * Create
 * Update
 * Delete
 * Other

---
 
## CREATE

**create_src.php**

Prompts user to input a source. Uses Google's autocorrect service to complete addresses. Changes the map based on user input. Also features a button that gets the location of the user and displays it in the map.

**create_dest.php**

Same as create_src.php but for destination. Prevents direct access and redirects users back to create_src.php.

**create.php**

Adds a route to the pool given the source and destination's latitude and longitude. Also prevents direct access by redirecting users back to create_src.php. Also checks if there are no duplicate routes.

---
 
## UPDATE

**update_src.php**

Prompts user to input a new source. Uses Google's autocorrect service to complete addresses. Changes the map based on user input. Also features a button that gets the location of the user and displays it in the map.

**update_dest.php**

Same as update_src.php but for destination.

**update.php**

Updates the source and destination latitude and longitude values. 

---
 
## DELETE

**delete_src.php**

Prompts a user to input route id. Yes, this is not how it should work in the actual application but this was supposed to be a simple button in the Market/Homescreen Module, unfortunately at the time of coding we had no access to it.

**delete.php**

Deletes the row in the pool and route table based on the route id.

---

## OTHER

**connect.php**

For connecting to db. It also has the temporary variable $_SESSION['id'] = 1 for the user id.

**sharetaxi.sql**

Db based on the latest PDF document since the links on the post and its comments were not fully updated.