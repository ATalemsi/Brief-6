<?php
// Include your database configuration
include '../config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $projectID = $_POST["project_id"];
    $scrumMasterID = $_POST["scrum_master_id"];

    // Insert the assignment into the ProjectTeams table
    $stmt = $pdo->prepare("INSERT INTO ProjectTeams (ProjectID, TeamID) VALUES (?, ?)");
    $stmt->execute([$projectID, $scrumMasterID]);

    // Redirect to a success page or back to the form
    header("Location: project.php");
    exit();
}

// Fetch projects and Scrum Masters from the database
$projects = $pdo->query("SELECT * FROM Projects")->fetchAll(PDO::FETCH_ASSOC);
$scrumMasters = $pdo->query("SELECT * FROM Teams INNER JOIN users on users.ID_User=teams.ScrumMasterID  WHERE users.UserRole = 'scrum_master'")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            @apply bg-cover bg-center bg-fixed;
            background-image: linear-gradient(to bottom, rgba(245, 246, 252, 0.52), rgba(117, 19, 93, 0.73)),
            url('img/data-warehousen.jpg');
        }
    </style>
    <title>Assigner Scrum Master</title>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-96">
    <form method="post" action="">
             <div class="mb-4">
                <label or="project_id" class="block text-gray-600 text-sm font-semibold mb-2">Select Project</label>
                <select  name="project_id" id="project_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" required>
                            <?php foreach ($projects as $project) : ?>
                        <option value="<?php echo $project['ProjectID']; ?>"><?php echo $project['ProjectName']; ?></option>
                        <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="scrum_master_id" class="block text-gray-600 text-sm font-semibold mb-2">Select Team</label>
                <select name="scrum_master_id" id="scrum_master_id"class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" required>
                            <?php foreach ($scrumMasters as $scrumMaster) : ?>
                        <option value="<?php echo $scrumMaster['TeamID']; ?>"><?php echo $scrumMaster['TeamName']; ?> SM :<?php echo $scrumMaster['Nom']; ?> <?php echo $scrumMaster['Prenom']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="w-full bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200" name="submit">
                Assigner ScrumMaster
            </button>
        </form>

    </div>
</body>


</html>