Sharetaxi
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Omega Squad: George, Janel, Rainer
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Contents:
(I) 	connect
(II)	register 
(III)	session
(IV)	login 
(V)	logout 
(VI)	welcome
(VII)	settings
(VIII)	profile
(NTS) 	notes
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
(I) Connect
- Required for accessing the Database. Holds the access names for the Database.
**********************************************************************************************************************************************************
(II) Register
- Registration for a new account is done here before you can login.
- Upon form submission, it checks if the restrictions are met, and then continues to insert the account in the database if not problems are encountered.
- Restrictions: 
1) Username
	(a) Username should be at least 3 characters long
	(b) Username is restricted to letters, numbers, and underscores
2) Email
	(a) Email should not already be in use in the database
3) Password
	(a) Password should be at least 8 characters long
	(b) Password should have at least 1 lowercase character
	(c) Password should have at least 1 uppercase character
	(d) Password should have at least 1 number
	(e) Password cannot be the same with Username
4) Confirm Password
	(a) Confirm Password should match Password
**********************************************************************************************************************************************************
(III) Session
- Begins the Session.
- Primarily requires "include('session.php');" for other pages to be able to access the username of the user.
- Unless of course if you don't just use $_SESSION['login_user'] instead.
- $_SESSION['login_user'] is taken from the login page after it has been verified that that is the right account.
- $_SESSION['id'] is also taken from the login page.
-$user_check is used in the database accessing.
- $login_session = name
- $user_id = user_id
**********************************************************************************************************************************************************
(IV) Login
- The Login Page.
- Asks for Username and Password.
- They are both retrieved from Database.
- If met, goes to Welcome Page with the username and id in tow.
**********************************************************************************************************************************************************
(V) Logout
- Destroys the session and goes back to Login.
**********************************************************************************************************************************************************
(VI) Welcome
- The Welcome Page where other Pages can be accessed by.
- Shows the route (and its details) that the user has selected, if any.
- If the route exists, it also links to the message room of said route.
- Otherwise, it only has links to Settings and Profile.
**********************************************************************************************************************************************************
(VII) Settings
- Settings Page; not many options to get yet.
- Can change Username.
- Can change Password.
- Displays the Email of the User.
Change Username:
	(a) Username should be at least 3 characters long
	(b) Username is restricted to letters, numbers, and underscores
Change Password:
	(a) Old Password has to be right in relation to user_id.
	(b) New Password should be at least 8 characters long.
	(c) New Password should have at least 1 lowercase character.
	(d) New Password should have at least 1 uppercase character.
	(e) New Password should have at least 1 number.
	(f) New Password cannot be the same with Username.
Confirm Changed Password: 
	(a) Confirm Password should match New Password.
**********************************************************************************************************************************************************
(VIII) Profile
- Shows the User's name.
- A User's profile can only be accessed by the User who owns it.
**********************************************************************************************************************************************************
(NTS) Notes
- The dummy user has the following values:
	-id = 1
	-name = test
	-password = Test1234
	-email = test@test.com
- There are 8 dummy routes and 1 dummy pool.
