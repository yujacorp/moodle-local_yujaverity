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
 * Quiz access rule for quizaccess_yujaverity plugin.
 *
 * @package   quizaccess_yujaverity
 * @copyright Copyright (c) 2022 YuJa Inc. (https://www.yuja.com/)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class quizaccess_yujaverity extends quiz_access_rule_base {
    
    /**
     * Check if YuJa Verity is enabled (for now using quiz name)
     */
    private static function is_verity_enabled($quiz) {
        $enabled = get_config('quizaccess_yujaverity', 'enabled');
        if ($enabled && $quiz && isset($quiz->name)) {
            return substr_compare($quiz->name, "(YuJa Verity for Test Proctoring)", -strlen("(YuJa Verity for Test Proctoring)")) === 0;
        }
        return false;
    }

    /**
     * Dispatched by db/events.php
     */
    public static function course_module_viewed_handler($event) {
        global $PAGE, $DB;
        $quiz = $DB->get_record('quiz', ['id' => $event->objectid]);
        if (self::is_verity_enabled($quiz)) {
            $PAGE->add_body_class('yujaverity');
        }
    }

    /**
     * Information, such as might be shown on the quiz view page, relating to this restriction.
     * There is no obligation to return anything. If it is not appropriate to tell students
     * about this rule, then just return ''.
     * @return mixed a message, or array of messages, explaining the restriction
     *         (may be '' if no message is appropriate).
     */
    function description() {
        global $PAGE;
        $hostname = get_string("externalhostname", "quizaccess_yujaverity");
        $PAGE->requires->js_call_amd("quizaccess_yujaverity/checkQuizAccess", "checkQuizAccess", [$hostname]);
        return '';
    }

    /**
     * Return an appropriately configured instance of this rule, if it is applicable
     * to the given quiz, otherwise return null.
     * @param quiz $quizobj information about the quiz in question.
     * @param int $timenow the time that should be considered as 'now'.
     * @param bool $canignoretimelimits whether the current user is exempt from
     *      time limits by the mod/quiz:ignoretimelimits capability.
     * @return quiz_access_rule_base|null the rule, if applicable, else null.
     */
    public static function make(quiz $quizobj, $timenow, $canignoretimelimits) {
        // Check if YuJa Verity is enabled (for now using quiz name)
        if (self::is_verity_enabled($quizobj->get_quiz())) {
            return new self($quizobj, $timenow);
        }
        return null;
    }

}