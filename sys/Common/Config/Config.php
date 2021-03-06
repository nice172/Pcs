<?php
namespace Pcs\Common\Config;

use Pcs\Common\Path\Path;

class Config
{
    private static $configMap = [];

    public static function init()
    {
        $configLoader = ConfigLoader::getInstance();
        $configPath = Path::getConfigPath();
        self::$configMap = $configLoader->load($configPath);
    }

    public static function get($key, $default = null)
    {
        $targets = explode('.', $key);
        $configMap = self::$configMap;
        do {
            if (empty($key)) {
                break;
            }

            foreach ($targets as $target) {
                if (!isset($configMap[$target])) {
                    break 2;
                }

                $configMap = $configMap[$target];
            }

            return $configMap;

        } while (0);

        return $default;
    }

    public static function clear()
    {

    }


}