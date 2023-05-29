<?php
// TODO: license agreement
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
 * Version metadata for the quizaccess_yujaverity plugin.
 *
 * @package   quizaccess_yujaverity
 * @copyright Copyright (c) 2022 YuJa Inc. (https://www.yuja.com/)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version = 2022111500;
$plugin->requires = 2020061500;
$plugin->component = 'quizaccess_yujaverity';
$plugin->maturity = MATURITY_STABLE;
$plugin->release = '1.0.3';
core_privacy\local\manager::register_provider('yuja-verity-moodle-plugin', '\core_privacy\local\metadata\YujaVerityPrivacyProvider');
