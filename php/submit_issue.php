<?php
// submit_issue.php

// Database connection
$host = "localhost";
$dbname = "COMMUNITY_REPORT_ISSUE";
$user = "root"; // replace with your MySQL username
$pass = "";     // replace with your MySQL password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    // Set error mode
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $reporterName = $_POST['reporter'] ?? '';

    // Basic validation
    if (empty($title) || empty($description) || empty($reporterName)) {
        echo json_encode(['status' => 'error', 'message' => 'Please fill all required fields']);
        exit;
    }

    try {
        // Check if reporter already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE name = :name LIMIT 1");
        $stmt->execute(['name' => $reporterName]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $userId = $user['id'];
        } else {
            // Insert new user
            $stmt = $pdo->prepare("INSERT INTO users (name) VALUES (:name)");
            $stmt->execute(['name' => $reporterName]);
            $userId = $pdo->lastInsertId();
        }

        // Insert the issue
        $stmt = $pdo->prepare("INSERT INTO issues (user_id, title, description) VALUES (:user_id, :title, :description)");
        $stmt->execute([
            'user_id' => $userId,
            'title' => $title,
            'description' => $description
        ]);

        echo json_encode(['status' => 'success', 'message' => 'Issue submitted successfully']);

    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }

} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
