<?php
				session_start();
				include('../dbconnect.php');
				$AccountNum=$_SESSION['AccountNum'];
				$EventID=$_REQUEST['EventID'];
				$connect=mysqli_query($conn,"INSERT INTO guestlist VALUES('','$AccountNum','$EventID')")?true:false;
				if($connect)//logging
				{
						//grab eventname
						$result=mysqli_query($conn,"SELECT EventName FROM event WHERE EventID='$EventID'");
						$row=mysqli_fetch_assoc($result);

						//grab user name
						$result1=mysqli_query($conn,"SELECT FirstName, LastName FROM user WHERE AccountNum='$AccountNum'");
						$row1=mysqli_fetch_assoc($result1);
					

						$userid=$AccountNum;

						$user_name=$row1['FirstName']." ".$row1['LastName'];
						$comment=$user_name." is now on the guestlist of ".$row['EventName'];
						mysqli_query($conn, "INSERT INTO log VALUES('','$userid','$comment',NOW())");
				}

?>