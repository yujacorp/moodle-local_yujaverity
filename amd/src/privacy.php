<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle. If not, see <http://www.gnu.org/licenses/>.

/**
 * Privacy API implementation for the quizaccess_yujaverity plugin.
 *
 * @package   quizaccess_yujaverity
 * @copyright Copyright (c) 2022 YuJa Inc. (https://www.yuja.com/)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Privacy API implementation for exporting user data.
 *
 * @param int $userid The ID of the user whose data needs to be exported.
 * @return array An array containing the user data to be exported.
 */
function quizaccess_yujaverity_export_user_data($userid) {
    // Retrieve and format the user data specific to your plugin.
    // Replace this with your actual implementation.
    $user = get_user_by_id($userid);

    return [
        'id' => $user->id,
        'username' => $user->username,
        'email' => $user->email,
        // Add more fields as needed.
    ];
}

/**
 * Privacy API implementation for deleting user data.
 *
 * @param int $userid The ID of the user whose data needs to be deleted.
 * @return bool True if the data deletion was successful, false otherwise.
 */
function quizaccess_yujaverity_delete_data_for_user($userid) {
    // Delete the user data specific to your plugin.
    // Replace this with your actual implementation.
    $success = delete_user_data($userid);

    return $success;
}
