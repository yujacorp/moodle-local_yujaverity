<?php

// Since the Yuja Verity Moodle plugin does not interact with user private data
class YujaVerityPrivacyProvider implements \core_privacy\local\metadata\provider {
    public static function get_reason() {
        return null;
    }
    
    public static function get_purpose() {
        return null;
    }
    
    public static function get_users_table_info() {
        return [];
    }
    
    public static function get_info() {
        return [];
    }


}
