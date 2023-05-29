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
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Event handler for the quizaccess_yujaverity plugin.
 *
 * @package   quizaccess_yujaverity
 * @copyright Copyright (c) 2022 YuJa Inc. (https://www.yuja.com/)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

public static function course_module_viewed_handler($event) {
    // Retrieve the quiz module instance.
    $cm = $event->context->instance;

    // Perform necessary actions based on the quiz module.
    if ($cm->modname === 'quiz') {
        // Access the quiz information.
        $quizid = $cm->instance;
        $quiz = get_quiz_by_id($quizid);

        // Check if the quiz name contains specific letters indicating YuJa Verity monitoring.
        if (strpos($quiz->name, "(YuJa Verity") !== false) {
            // YuJa Verity monitoring is enabled for this quiz.
            // Your logic here to handle the enabled state.
            // This could include setting a flag, updating UI, or triggering other actions.

            // For example, you can set a flag in the session or user preferences.
            $_SESSION['yujaverity_enabled'] = true;
        } else {
            // YuJa Verity monitoring is not enabled for this quiz.
            // Your logic here to handle the disabled state.
            // This could include displaying a message or performing alternative actions.

            // For example, you can set a flag in the session or user preferences.
            $_SESSION['yujaverity_enabled'] = false;
        }
    }
}

