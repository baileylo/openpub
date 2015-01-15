<?php

namespace Baileylo\Core\Mongo;

class YamlDriver extends \Doctrine\ODM\MongoDB\Mapping\Driver\YamlDriver
{
    /**
     * Loads a mapping file with the given name and returns a map
     * from class/entity names to their corresponding file driver elements.
     *
     * @param string $file The mapping file to load.
     *
     * @return array
     */
    protected function loadMappingFile($file)
    {
        return yaml_parse_file($file);
    }
}
