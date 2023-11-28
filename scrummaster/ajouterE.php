<?php
include '../config.php'; // Include your database configuration file
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ajouter-team"])) {
    $teamName = $_POST["team-name"];
    $scrumMasterID = $_POST["scrum-master"];

    try {
        // Insert new team into the Teams table
        $stmt = $pdo->prepare("INSERT INTO Teams (TeamName, ScrumMasterID) VALUES (?, ?)");
        $stmt->execute([$teamName, $scrumMasterID]);

        echo "Team added successfully!";
        header("Location: team.php"); 
        exit();
    } catch (PDOException $e) {
        echo "Error adding team: " . $e->getMessage();
    }
}
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
    <title>Add teams</title>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-96">
        <form id="ajouter-teams-form" method="post" action="">
            <div class="mb-4">
                <label for="team-name" class="block text-gray-600 text-sm font-semibold mb-2">Team Name</label>
                <input type="text" id="team-name" name="team-name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" placeholder="Team Name" required>
            </div>

            <!-- Dropdown for selecting Scrum Master -->
            <div class="mb-4">
                <label for="scrum-master" class="block text-gray-600 text-sm font-semibold mb-2">Scrum Master</label>
                <select id="scrum-master" name="scrum-master" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:border-blue-500">
                    <?php
                        
                        $query = "SELECT * FROM Users WHERE UserRole = 'scrum_master'";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute();
                        $scrumMasters = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($scrumMasters as $scrumMaster) {
                            echo "<option value=\"{$scrumMaster['ID_User']}\">{$scrumMaster['Nom']}</option>";
                        }
                    ?>
                </select>
            </div>

            <button type="submit" class="w-full bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200" name="ajouter-team">
                Add Team
            </button>
        </form>
    </div>
</body>
</html>
</html>