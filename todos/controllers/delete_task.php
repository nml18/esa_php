<?php
session_start();
require '../system/functions.php';
$file_path = '../models/tasks.csv';
$tasks = getTasks($file_path);

# Remove the selected task from the task database
unset($tasks[$_POST['id']]);

# Update the task database
saveTasks($file_path, $tasks);

# Jump back to the main page
header('Location: ../index.php');