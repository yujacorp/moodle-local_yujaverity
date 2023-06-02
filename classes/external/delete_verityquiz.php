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
 * local_yujaverity delete_verityquiz.php description here.
 *
 * @package    local_yujaverity
 * @copyright  2023 YuJa Inc. (https://www.yuja.com/)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_yujaverity\external;

use external_function_parameters;
use external_multiple_structure;
use external_single_structure;
use external_value;
use external_api;
use context_module;
use local_yujaverity\quiz\verity_quiz;

/**
 * Web service for delete_verityquiz
 */
class delete_verityquiz extends external_api {
    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function execute_parameters() {
        return new external_function_parameters([
            'quiz_id' => new external_value(PARAM_INT, 'quiz id', VALUE_REQUIRED)
        ]);
    }

    /**
     * Returns description of method return value
     * @return null
     */
    public static function execute_returns() {
        return null;
    }

    /**
     * Enable Verity for a quiz
     * @param array $quizid quiz ID to enable it for
     */
    public static function execute($quizid) {
        $params = self::validate_parameters(self::execute_parameters(), ['quiz_id' => $quizid]);

        // Perform security checks.
        $quizid = $params['quiz_id'];
        $context = context_module::instance($quizid);
        self::validate_context($context);
        require_capability('mod/quiz:manage', $context);

        verity_quiz::disable_verity($quizid);
    }
}
