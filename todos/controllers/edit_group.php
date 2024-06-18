<?php
session_start();
require '../system/functions.php';
$groups_path = '../models/groups.csv';
$tasks_path = '../models/tasks.csv';
$groups = getGroups($groups_path);
$tasks = getTasks($tasks_path);
$old_group = $groups[$_POST['id']]['group'];
$edited_group = $_POST['group'];
$current_groups = getCurrentGroups($groups_path);

# Check if the group already exists or is empty
if(empty($_POST['group']) || in_array($_POST['group'], $current_groups)){
    $_SESSION['edit_group_error'] = true;
}
else{
    $_SESSION['edit_group_error'] = false;
    # Update every tasks that are concerned by the group
    foreach($tasks as $index => $task){
        if($task['group'] == $old_group){
            $tasks[$index]['group'] = $edited_group;
            var_dump($tasks);
        }
    }
    # Update the group database with the edited group
    $groups[$_POST['id']]['group'] = $edited_group;
    # Update both databases
    saveTasks($tasks_path, $tasks);
    saveGroups($groups_path, $groups);
}

# Jump back to the main page
header('Location: ../index.php?page=edit_group');