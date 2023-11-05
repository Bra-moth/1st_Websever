# Admin


<h3>1. Introduction</h3>

A a web-based application designed to manage student residences. It provides a user-friendly interface for managing students, residences, rooms, and allocations.

<h3>2. Technologies Used</h3>

- Frontend: HTML, CSS, Some few bits of JavaScript
- Backend: PHP, MySQL
- Server: Apache

<h3>3. Database Schema</h3>

The database schema consists of the following tables:

- Students: Stores information about students, such as their name, email, and phone number.
- Residences: Stores information about residences, such as their name and capacity.
- Rooms: Stores information about rooms, such as their room number and capacity.
- Allocations: Stores information about room allocations, such as the student and room IDs.
- Applications: Stores information about student applications for residences.

<h3>4. Code Explanation</h3>
- Home.php{
    -ManagerLogin
    -Student Login
    -Signup
    -Admin
}

- login.php{

   -student_dashboard-
      -application.php
      - update_information.php
      - Moveout.php
      - Status_check.php
  
}
- signup.php
{
   <User Registration>
}


- manager.php{
   -track_student.php{
     -Using Some join commands to fetch from multiple tables, eg. Status, RoomID, 	ResidenceName etc.
	}
   }


- Admin.php{
  _Record Keeping_
    _Overview of the residence Details as Random Sample_
     _But we can create information from dataset kept in the recods_
	}
	
     }



<h4>4.1. Connecting to the Database</h4>

<?php


define('DB_NAME', 'crycry');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_HOST', 'localhost');


if (!$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)) {
    die("Failed to connect");
}
?>

<---   require "../private/database.php"; --->
With every Php file, Contains the HTML & CSS


