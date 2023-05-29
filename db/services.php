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

$services = array(
    'quizaccess_yujaverity' => array(
        'functions' => array(
            'quizaccess_yujaverity_get_data' => array(
                'classname'     => 'quizaccess_yujaverity_external',
                'methodname'    => 'get_data',
                'classpath'     => 'quizaccess/yujaverity/externallib.php',
                'description'   => 'Get the data for the plugin',
                'type'          => 'read',
                'capabilities'  => 'quizaccess/yujaverity:view',
            ),
        ),
    ),
    'yuja-verity-moodle-plugin' => [
        'privacy:metadata' => 'core_privacy\local\metadata\null_provider',
    ],
    
);
