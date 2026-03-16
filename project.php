<?php
session_start();

/* DATABASE CONNECTION */
$conn = mysqli_connect("localhost", "root", "", "ems_db");
if (!$conn) die("Database Error");

/* LOGOUT */
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ems.php");
}

/* LOGIN */
if (isset($_POST['login'])) {
    $u = $_POST['username'];
    $p = $_POST['password'];

    $q = mysqli_query($conn, "SELECT * FROM Users WHERE username='$u' AND password='$p'");
    if (mysqli_num_rows($q) == 1) {
        $_SESSION['user'] = $u;
    } else {
        $error = "Invalid Login";
    }
}

/* ADD DEPARTMENT */
if (isset($_POST['add_department'])) {
    mysqli_query($conn, "INSERT INTO Departments VALUES (NULL,'$_POST[name]','$_POST[location]')");
}

/* ADD DESIGNATION */
if (isset($_POST['add_designation'])) {
    mysqli_query($conn, "INSERT INTO Designations VALUES (NULL,'$_POST[title]','$_POST[dept]')");
}

/* ADD EMPLOYEE */
if (isset($_POST['add_employee'])) {
    mysqli_query($conn, "INSERT INTO Employees VALUES (
        NULL,
        '$_POST[fname]',
        '$_POST[lname]',
        '$_POST[email]',
        '$_POST[phone]',
        '$_POST[hire]',
        '$_POST[dept]',
        '$_POST[desig]'
    )");
}

/* DELETE EMPLOYEE */
if (isset($_GET['delete'])) {
    mysqli_query($conn, "DELETE FROM Employees WHERE employee_id=".$_GET['delete']);
}

/* LOGIN PAGE */
if (!isset($_SESSION['user'])) {
?>
<h2>Login</h2>
<form method="post">
    <input name="username" placeholder="Username" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button name="login">Login</button>
</form>
<?php if (isset($error)) echo $error; exit; } ?>

<!-- DASHBOARD -->
<h2>Employee Management System</h2>
<a href="?page=dept">Add Department</a> |
<a href="?page=desig">Add Designation</a> |
<a href="?page=emp">Add Employee</a> |
<a href="?page=view">View Employees</a> |
<a href="?logout=1">Logout</a>
<hr>

<?php
$page = $_GET['page'] ?? '';

/* ADD DEPARTMENT PAGE */
if ($page == "dept") {
?>
<h3>Add Department</h3>
<form method="post">
    <input name="name" placeholder="Department Name" required>
    <input name="location" placeholder="Location" required>
    <button name="add_department">Save</button>
</form>
<?php }

/* ADD DESIGNATION PAGE */
if ($page == "desig") {
$deps = mysqli_query($conn, "SELECT * FROM Departments");
?>
<h3>Add Designation</h3>
<form method="post">
    <input name="title" placeholder="Designation" required>
    <select name="dept">
        <?php while ($d=mysqli_fetch_assoc($deps)) { ?>
        <option value="<?= $d['department_id'] ?>"><?= $d['department_name'] ?></option>
        <?php } ?>
    </select>
    <button name="add_designation">Save</button>
</form>
<?php }

/* ADD EMPLOYEE PAGE */
if ($page == "emp") {
$deps = mysqli_query($conn, "SELECT * FROM Departments");
$des  = mysqli_query($conn, "SELECT * FROM Designations");
?>
<h3>Add Employee</h3>
<form method="post">
    <input name="fname" placeholder="First Name" required>
    <input name="lname" placeholder="Last Name" required>
    <input name="email" placeholder="Email" required>
    <input name="phone" placeholder="Phone">
    <input type="date" name="hire" required>

    <select name="dept">
        <?php while ($d=mysqli_fetch_assoc($deps)) { ?>
        <option value="<?= $d['department_id'] ?>"><?= $d['department_name'] ?></option>
        <?php } ?>
    </select>

    <select name="desig">
        <?php while ($g=mysqli_fetch_assoc($des)) { ?>
        <option value="<?= $g['designation_id'] ?>"><?= $g['title'] ?></option>
        <?php } ?>
    </select>

    <button name="add_employee">Save</button>
</form>
<?php }

/* VIEW EMPLOYEES PAGE */
if ($page == "view") {
$res = mysqli_query($conn, "
SELECT e.employee_id, e.first_name, e.last_name,
d.department_name, g.title
FROM Employees e
JOIN Departments d ON e.department_id=d.department_id
JOIN Designations g ON e.designation_id=g.designation_id
");
?>
<h3>Employees List</h3>
<table border="1" cellpadding="5">
<tr>
<th>Name</th><th>Department</th><th>Designation</th><th>Action</th>
</tr>
<?php while ($r=mysqli_fetch_assoc($res)) { ?>
<tr>
<td><?= $r['first_name']." ".$r['last_name'] ?></td>
<td><?= $r['department_name'] ?></td>
<td><?= $r['title'] ?></td>
<td><a href="?page=view&delete=<?= $r['employee_id'] ?>">Delete</a></td>
</tr>
<?php } ?>
</table>
<?php } ?>
