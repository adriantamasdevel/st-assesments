<?php 

namespace Shiptheory\Storage;

/**
 * DB Class to save the data
 */
class DB
{
    /**
     * Filepath
     * 
     * @var string
     */
    private static $path = __DIR__ . '/../../storage/';

    /**
     * Data file name
     * 
     * @var string
     */
    private static $filename = 'data';

    /**
     * Save the data to json file as serialised object
     * 
     * 
     * @param array $data
     * @return bool
     */
    public static function save($data): bool
    {
        $storage_data = serialize($data);
        file_put_contents(self::$path.self::$filename, $storage_data);
        return true;
    }

    /**
     * Load the serialized object and return 
     * 
     * @return array
     */
    public static function load(): array
    {
        $data = [];
        if($storage_data = @file_get_contents(self::$path.self::$filename)) {
            $data = unserialize($storage_data);
        } 

        return $data;
    }
}