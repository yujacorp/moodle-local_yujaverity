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
 * Implementation of the quizaccess_yujaverity plugin.
 *
 * @package   quizaccess_yujaverity
 * @copyright Copyright (c) 2022 YuJa Inc. (https://www.yuja.com/)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string["pluginname"] = "YuJa Verity";

$string['externalhostname'] = 'zone1.verity.yuja.com';

$string['settings_enable'] = 'Block YuJa Verity Quizzes';
$string['settings_enabledesc'] = 'Prevent users from accessing a YuJa Verity monitored quiz without the YuJa Verity extension';