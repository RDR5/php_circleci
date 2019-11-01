<?php

//Navigation if user is NOT logged in
$main_nav = '<ul>
		<li><a href="../../../../../../forum/index.php">Home</a></li>
		<li><a href="../../../../../../forum/View/login.php">Login</a></li>
		<li><a href="../../../../../../forum/View/register.php">Register</a></li>
</ul>';

//Naigation if user is logged in
$main_nav2 = '<ul>
		<li><a href="../../../../../../forum/index.php">Home</a></li>
		<li><a href="../../../../../../forum/View/userprofile.php">My Profile</a></li>
		<li><a href="../../../../../../forum/View/elements/newpost.php">Add New Post</a></li>
		<li><a href="../../../../../../forum/View/logout.php">Logout</a></li>
</ul>';

//Naigation if admin is logged in
$main_nav3 = '<ul>
		<li><a href="../../../../../../forum/index.php">Home</a></li>
		<li><a href="../../../../../../forum/View/userprofile.php">My Profile</a></li>
		<li><a href="../../../../../../forum/View/elements/newpost.php">Add New Post</a></li>
		<li><a href="../../../../../../forum/View/user/admindashboard.php">Admin Dashboard</a></li>
		<li><a href="../../../../../../forum/View/logout.php">Logout</a></li>
</ul>';