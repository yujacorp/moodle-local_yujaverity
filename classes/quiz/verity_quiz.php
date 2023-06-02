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
 * local_yujaverity verity_quiz.php description here.
 *
 * @package    local_yujaverity
 * @copyright  2023 YuJa Inc. (https://www.yuja.com/)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_yujaverity\quiz;

class verity_quiz
{
    public static function enable_verity($quiz_id)
    {
        global $DB;
        $record = $DB->get_record('verity_quiz', ['quiz_id' => $quiz_id]);
        if (!$record) {
            $DB->insert_record_raw('verity_quiz', ['quiz_id' => $quiz_id]);
        }
    }

    public static function disable_verity($quiz_id)
    {
        global $DB;
        $DB->delete_records('verity_quiz', ['quiz_id' => $quiz_id]);
    }

    public static function is_verity_enabled($quiz_id)
    {
        global $DB;
        return get_config("local_yujaverity", "enabled") && $DB->record_exists('verity_quiz', ['quiz_id' => $quiz_id]);
    }
}
