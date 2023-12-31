<?php
require_once('process/dbh.php');
$sql = "SELECT 
            employee.id,
            employee.firstName,
            employee.lastName,
            salary.base,
            salary.bonus,
            salary.total 
        FROM 
            employee, `salary` 
        WHERE 
            employee.id = salary.id";

$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$result) {
    die('Error: ' . mysqli_error($conn));
}

// Fetching data
$employees = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Calculate aggregate functions
$totalSalarySum = array_sum(array_column($employees, 'total'));
$averageSalary = $totalSalarySum / count($employees);
$minSalary = min(array_column($employees, 'total'));
$maxSalary = max(array_column($employees, 'total'));
$totalEmployees = count($employees);

?>

<html>
<head>
    <title>Salary Table | FUTURE TEN</title>
    <link rel="stylesheet" type="text/css" href="styleview.css">
</head>
<body>

<header>
		<nav>
			
		<img src="k.png" style="height: 55px;width: 55px;border-radius: 50%;">
			<ul id="navli">
				<li><a class="homeblack" href="aloginwel.php">HOME</a></li>
				
				<li><a class="homeblack" href="addemp.php">Add Employee</a></li>
				<li><a class="homeblack" href="viewemp.php">View Employee</a></li>
				<li><a class="homeblack" href="assign.php">Assign Project</a></li>
				<li><a class="homeblack" href="assignproject.php">Project Status</a></li>
				<li><a class="homered" href="salaryemp.php">Salary Table</a></li>
				<li><a class="homeblack" href="empleave.php">Employee Leave</a></li>
				<li><a class="homeblack" href="alogin.html">Log Out</a></li>
			</ul>
		</nav>
	</header>
	 
	<div class="divider"></div>
	<div id="divimg">
		
	</div>
	

    <table>
        <tr>
            <th align="center">Emp. ID</th>
            <th align="center">Name</th>
            <th align="center">Base Salary</th>
            <th align="center">Bonus</th>
            <th align="center">Total Salary</th>
        </tr>

        <?php
        foreach ($employees as $employee) {
            echo "<tr>";
            echo "<td>" . $employee['id'] . "</td>";
            echo "<td>" . $employee['firstName'] . " " . $employee['lastName'] . "</td>";
            echo "<td>" . $employee['base'] . "</td>";
            echo "<td>" . $employee['bonus'] . " %</td>";
            echo "<td>" . $employee['total'] . "</td>";
        }
        ?>
    </table>

    <div >
        <!-- Display aggregate functions -->
        <p style="font-family: Montserrat; text-align: center; font-size: 25px"> <u>Average Salary</u>:-  <?php echo $averageSalary; ?></p>
        <p style="font-family: Montserrat; text-align: center; font-size: 25px"> <u>Min Salary</u> :- <?php echo $minSalary; ?></p>
        <p style="font-family: Montserrat; text-align: center; font-size: 25px"> <u>Max Salary</u> :- <?php echo $maxSalary; ?></p>
        <p style="font-family: Montserrat; text-align: center; font-size: 25px"><u>Total Employees</u> :- <?php echo $totalEmployees; ?></p>
    </div>
</body>
</html>
