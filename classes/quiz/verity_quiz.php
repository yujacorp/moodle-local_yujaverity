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
 * Verity quiz data access functions for local_yujaverity plugin
 *
 * @package    local_yujaverity
 * @copyright  2023 YuJa Inc. (https://www.yuja.com/)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_yujaverity\quiz;

/**
 * Functions relating to modifying Verity quizzes
 */
class verity_quiz {
    /**
     * Enables Verity for the quiz by adding a `verity_quiz` entry
     * @param int $quizid Quiz ID
     */
    public static function enable_verity($quizid) {
        global $DB;
        $record = $DB->get_record('local_yujaverity_verityquiz', ['quiz_id' => $quizid]);
        if (!$record) {
            $DB->insert_record_raw('local_yujaverity_verityquiz', ['quiz_id' => $quizid]);
        }
    }

    /**
     * Disables Verity for the quiz by deleting a `verity_quiz` entry
     * @param int $quizid Quiz ID
     */
    public static function disable_verity($quizid) {
        global $DB;
        $DB->delete_records('local_yujaverity_verityquiz', ['quiz_id' => $quizid]);
    }

    /**
     * Checks whether Verity is enabled for the quiz
     * @param int $quizid Quiz ID
     * @return bool Whether Verity is enabled
     */
    public static function is_verity_enabled($quizid) {
        global $DB;
        return get_config("local_yujaverity", "enabled") &&
            $DB->record_exists('local_yujaverity_verityquiz', ['quiz_id' => $quizid]);
    }
}
