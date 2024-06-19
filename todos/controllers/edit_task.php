<?php
session_start();
require '../system/functions.php';
$tasks_path = '../models/tasks.csv';
$groups_path = '../models/groups.csv';
$current_groups = getCurrentGroups($groups_path);
$tasks = getTasks($tasks_path, $current_groups);
$group = $_POST['group'];

# Check if the task is empty or not
if(empty($_POST['task'])){
    $_SESSION['edit_task_error'] = true;
}
else{
    $_SESSION['edit_task_error'] = false;
    # Update the task database with the edited task
    $tasks[$group][$_POST['task_id']]['task'] = $_POST['task'];
    # Update the task database
    saveTasks($tasks_path, $tasks);
}

# Jump back to the main page
header('Location: ../index.php?page=edit_task');