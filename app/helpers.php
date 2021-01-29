<?php
/** This Method To Get Notification Type  */
if (!function_exists('getNameFromType')) {
    function getNameFromType($type)
    {
        switch ($type) {
            case 'App\Notifications\AssignmentUploadedNotification':
                return "Uploade Assignment";
            case 'App\Notifications\TeamAssignmentNotification':
                return "Assignment Created";
            case 'App\Notifications\Tasks\CreateTaskNotification':
                return "Task Created";
            case 'App\Notifications\Tasks\MarkTaskAsDoneNotification':
                return "Task Ended";
            case 'App\Notifications\AddNewMember':
                return "Added To New Team";
            case 'App\Notifications\MeetingStartingNotification':
                return "Meeting Started";
            default:
                return $type;
        }
    }
}
/** This Method To Get User FullName That Passed From Notification Data
 * If And Only If The Notification Type Is [AssignmentUploadedNotification]
 */
if (!function_exists('getFullnameFromID')) {
    function getFullnameFromID($username, $id)
    {
        $user = \App\Models\User::where('username', '=', $username)->first();
        return auth()->id() != $id ? "You Uploaded Assignment" : $user->fullname . " Uploaded Assignment";
    }
}

/** Get Assignment Data From Table
 * If And Only If The Notification Type Is [AssignmentUploadedNotification]
 */
if (!function_exists('getAssignmentNameFromID')) {
    function getAssignmentNameFromID($assignment)
    {
        $name = \App\Models\Assignment::where('name', '=', $assignment)->first();
        return "On Assignment ". $name->name;
    }
}
if (!function_exists('getTaskCreatedByTeam')) {
    function getTaskCreatedByTeam($team_name)
    {
        return "On Team ". $team_name;
    }
}


if (!function_exists('getTaskCreatedByUser')) {
    function getTaskCreatedByUser($created_by)
    {
        return $created_by . " Create Task";
    }
}

if (!function_exists('getCompletedTask')) {
    function getCompletedTask($task)
    {
        return $task . " Donned";
    }
}


if (!function_exists('getAddedMemberToTeam')) {
    function getAddedMemberToTeam($member)
    {
        return $member == auth()->user()->fullname ? "You Added To New team" : $member. " Added to New team";
    }
}
// get Manger Name That Press On Meeting Button
if (!function_exists('getTeamManagerThatStartMeeting')) {
    function getTeamManagerThatStartMeeting($teamName)
    {
        return $teamName . " Start Meeting";
    }
}

// get team name from meeting notification
if (!function_exists('getTeamBelongToAction')) {
    function getTeamBelongToAction($team)
    {
        return "On Team ". $team;
    }
}



/** Filter Notification Type To Be Dynamic And More Efficient */
if (!function_exists('getFunctionTypeByDataPassed')) {
    function getFunctionTypeByDataPassed($type, array $data)
    {
        switch ($type) {
            case 'App\Notifications\AssignmentUploadedNotification' :
                return getAssignmentNameFromID($data['assignment']);
            case 'App\Notifications\TeamAssignmentNotification' :
                return $data['team'];
            case 'App\Notifications\Tasks\CreateTaskNotification' :
                return getTaskCreatedByTeam($data['team_name']);
            case 'App\Notifications\Tasks\MarkTaskAsDoneNotification' :
                return getTaskCreatedByTeam($data['team']);
            case 'App\Notifications\AddNewMember' :
            case 'App\Notifications\MeetingStartingNotification' :
                return getTeamBelongToAction($data['team']);
            default:
                return 'Un Signed';

        }
    }
}

/** Filter Notification Type And Return An Action Happen To Make This Notification */
if (!function_exists('getNotificationActionByDataPassed')) {
    function getNotificationActionByDataPassed($type, array $data, $notifiable_id)
    {
        switch ($type) {
            case 'App\Notifications\AssignmentUploadedNotification' :
                return getFullnameFromID($data['username'], $notifiable_id);
            case 'App\Notifications\TeamAssignmentNotification':
                return $data['team'] . " Team Created Assignment";
            case 'App\Notifications\Tasks\CreateTaskNotification' :
                return getTaskCreatedByUser($data['created_by']);
            case 'App\Notifications\Tasks\MarkTaskAsDoneNotification' :
                return getCompletedTask($data['task']);
            case 'App\Notifications\AddNewMember' :
                return getAddedMemberToTeam($data['member']);
            case 'App\Notifications\MeetingStartingNotification' :
                return getTeamManagerThatStartMeeting($data['manager']);
            default:
                return 'Un Signed';
        }
    }
}

if (!function_exists('convertFromTimeStampToHumanTime')) {
    function convertFromTimeStampToHumanTime($time)
    {

        return $time->diffForHumans();
    }
}
