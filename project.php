<?php
declare(strict_types=1);

session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new mysqli("localhost", "root", "", "ems_db");
$conn->set_charset("utf8mb4");

function e(mixed $value): string {
    return htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8");
}

if (isset($_GET['logout'])) {
    $_SESSION = [];
    session_destroy();
    header("Location: project.php");
    exit;
}

$error = null;

if (isset($_POST['login'])) {
    $username = trim((string)($_POST['username'] ?? ''));
    $password = (string)($_POST['password'] ?? '');
    $stmt = $conn->prepare("SELECT username, password_hash FROM Users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
    if ($user && password_verify($password, $user['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['user'] = $user['username'];
        header("Location: project.php");
        exit;
    }
    $error = "Invalid Login";
}

if (!isset($_SESSION['user'])) {
?>
<h2>Login</h2>
<form method="post">
    <input name="username" placeholder="Username" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button name="login">Login</button>
</form>
<?php if ($error !== null) echo e($error); exit; } ?>

<?php
if (isset($_POST['add_department'])) {
    $name = trim((string)($_POST['name'] ?? ''));
    $location = trim((string)($_POST['location'] ?? ''));
    $stmt = $conn->prepare("INSERT INTO Departments (department_name, location) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $location);
    $stmt->execute();
}

if (isset($_POST['add_designation'])) {
    $title = trim((string)($_POST['title'] ?? ''));
    $departmentId = (int)($_POST['dept'] ?? 0);
    $stmt = $conn->prepare("INSERT INTO Designations (title, department_id) VALUES (?, ?)");
    $stmt->bind_param("si", $title, $departmentId);
    $stmt->execute();
}

if (isset($_POST['add_employee'])) {
    $firstName = trim((string)($_POST['fname'] ?? ''));
    $lastName = trim((string)($_POST['lname'] ?? ''));
    $email = trim((string)($_POST['email'] ?? ''));
    $phone = trim((string)($_POST['phone'] ?? ''));
    $hireDate = (string)($_POST['hire'] ?? '');
    $departmentId = (int)($_POST['dept'] ?? 0);
    $designationId = (int)($_POST['desig'] ?? 0);
    $stmt = $conn->prepare("INSERT INTO Employees
        (first_name, last_name, email, phone, hire_date, department_id, designation_id)
        VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssii", $firstName, $lastName, $email, $phone, $hireDate, $departmentId, $designationId);
    $stmt->execute();
}

if (isset($_GET['delete'])) {
    $employeeId = (int)$_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM Employees WHERE employee_id = ?");
    $stmt->bind_param("i", $employeeId);
    $stmt->execute();
}
?>

<h2>Employee Management System</h2>
<p>Signed in as <?= e($_SESSION['user']) ?></p>
<a href="?page=dept">Add Department</a> |
<a href="?page=desig">Add Designation</a> |
<a href="?page=emp">Add Employee</a> |
<a href="?page=view">View Employees</a> |
<a href="?logout=1">Logout</a>
<hr>

<?php
$page = $_GET['page'] ?? '';

if ($page === "dept") {
?>
<h3>Add Department</h3>
<form method="post">
    <input name="name" placeholder="Department Name" required>
    <input name="location" placeholder="Location" required>
    <button name="add_department">Save</button>
</form>
<?php }

if ($page === "desig") {
    $deps = $conn->query("SELECT department_id, department_name FROM Departments ORDER BY department_name");
?>
<h3>Add Designation</h3>
<form method="post">
    <input name="title" placeholder="Designation" required>
    <select name="dept" required>
        <?php while ($d = $deps->fetch_assoc()) { ?>
        <option value="<?= (int)$d['department_id'] ?>"><?= e($d['department_name']) ?></option>
        <?php } ?>
    </select>
    <button name="add_designation">Save</button>
</form>
<?php }

if ($page === "emp") {
    $deps = $conn->query("SELECT department_id, department_name FROM Departments ORDER BY department_name");
    $des = $conn->query("SELECT designation_id, title FROM Designations ORDER BY title");
?>
<h3>Add Employee</h3>
<form method="post">
    <input name="fname" placeholder="First Name" required>
    <input name="lname" placeholder="Last Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input name="phone" placeholder="Phone">
    <input type="date" name="hire" required>
    <select name="dept" required>
        <?php while ($d = $deps->fetch_assoc()) { ?>
        <option value="<?= (int)$d['department_id'] ?>"><?= e($d['department_name']) ?></option>
        <?php } ?>
    </select>
    <select name="desig" required>
        <?php while ($g = $des->fetch_assoc()) { ?>
        <option value="<?= (int)$g['designation_id'] ?>"><?= e($g['title']) ?></option>
        <?php } ?>
    </select>
    <button name="add_employee">Save</button>
</form>
<?php }

if ($page === "view") {
    $res = $conn->query("SELECT e.employee_id, e.first_name, e.last_name,
        d.department_name, g.title
        FROM Employees e
        JOIN Departments d ON e.department_id = d.department_id
        JOIN Designations g ON e.designation_id = g.designation_id
        ORDER BY e.employee_id DESC");
?>
<h3>Employees List</h3>
<table border="1" cellpadding="5">
<tr><th>Name</th><th>Department</th><th>Designation</th><th>Action</th></tr>
<?php while ($r = $res->fetch_assoc()) { ?>
<tr>
<td><?= e($r['first_name'] . " " . $r['last_name']) ?></td>
<td><?= e($r['department_name']) ?></td>
<td><?= e($r['title']) ?></td>
<td><a href="?page=view&delete=<?= (int)$r['employee_id'] ?>">Delete</a></td>
</tr>
<?php } ?>
</table>
<?php } ?>

