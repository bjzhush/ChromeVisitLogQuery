<?php
class Boot_Registry extends Zend_Registry
{
    public static function getTable($table)
    {
        $table = 'Db_' . $table;
        if (!self::isRegistered($table)) {
            self::set($table, new $table());
        }

        return self::get($table);
    }
}
