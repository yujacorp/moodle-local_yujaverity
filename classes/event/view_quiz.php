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

namespace local_yujaverity\event;

use local_yujaverity\quiz\verity_quiz;

class view_quiz
{
    /**
     * Dispatched by db/events.php
     */
    public static function course_module_viewed_handler($event)
    {
        global $PAGE;
        $verity_enabled = verity_quiz::is_verity_enabled($event->objectid);

        if ($verity_enabled) {
            $PAGE->add_body_class('yujaverity');
            $hostname = get_string("externalhostname", "local_yujaverity");
            $PAGE->requires->js_call_amd("local_yujaverity/checkQuizAccess", "checkQuizAccess", [$hostname]);
        }
    }
}