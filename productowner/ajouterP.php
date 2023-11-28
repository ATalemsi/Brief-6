<!-- ajouterProject.php -->
<?php
include '../config.php'; // Include your database configuration file
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ajouter-p"])) {
    $projectName = $_POST["project-name"];
    $productOwnerID = $_POST["product-owner"];

    try {
        // Insert new project into the Projects table
        $stmt = $pdo->prepare("INSERT INTO projects (ProjectName, ProductOwnerID) VALUES (?, ?)");
        $stmt->execute([$projectName, $productOwnerID]);

        echo "Project added successfully!";
        header("Location: project.php"); 
        exit();
    } catch (PDOException $e) {
        echo "Error adding project: " . $e->getMessage();
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
            background: linear-gradient(to bottom, rgba(245, 246, 252, 0.52), rgba(117, 19, 93, 0.73)),
            url('img/data-warehousen.jpg') center fixed;
            background-size: cover;
        }
    </style>
    <title>Add Project</title>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-96">
        <form id="ajouter-project-form" method="post" action="">
            <div class="mb-4">
                <label for="project-name" class="block text-gray-600 text-sm font-semibold mb-2">Project Name</label>
                <input type="text" id="project-name" name="project-name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" placeholder="Project Name" required>
            </div>
            <div class="mb-4">
                <label for="product-owner" class="block text-gray-600 text-sm font-semibold mb-2">Product Owner</label>
                <select id="product-owner" name="product-owner" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:border-blue-500">
                    <?php
                        // Assuming $pdo is your PDO database connection
                        $query = "SELECT ID_User, Nom, Prenom FROM Users WHERE UserRole = 'product_owner'";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute();
                        $productOwners = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($productOwners as $productOwner) {
                            echo "<option value=\"{$productOwner['ID_User']}\">{$productOwner['Nom']} {$productOwner['Prenom']}</option>";
                        }
                    ?>
                </select>
            </div>

            <button type="submit" class="w-full bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200" name="ajouter-p">
                Add Project
            </button>
        </form>
    </div>
</body>
</html>
