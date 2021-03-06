<?php
namespace Vws\Api;

/**
 * Base class representing a modeled shape.
 */
class Shape extends AbstractModel
{
    /**
     * Get a concrete shape for the given definition.
     *
     * @param array    $definition
     * @param ShapeMap $shapeMap
     *
     * @return mixed
     *
     * @throws \RuntimeException if the type is invalid
     */
    public static function create(array $definition, ShapeMap $shapeMap)
    {
        static $map = [
            'structure' => 'Vws\Api\StructureShape',
            'map'       => 'Vws\Api\MapShape',
            'list'      => 'Vws\Api\ListShape',
            'timestamp' => 'Vws\Api\TimestampShape',
            'integer'   => 'Vws\Api\Shape',
            'double'    => 'Vws\Api\Shape',
            'float'     => 'Vws\Api\Shape',
            'long'      => 'Vws\Api\Shape',
            'string'    => 'Vws\Api\Shape',
            'byte'      => 'Vws\Api\Shape',
            'character' => 'Vws\Api\Shape',
            'blob'      => 'Vws\Api\Shape',
            'boolean'   => 'Vws\Api\Shape',
        ];

        if (isset($definition['shape'])) {
            return $shapeMap->resolve($definition);
        }

        if (!isset($map[$definition['type']])) {
            throw new \RuntimeException('Invalid type');
        }

        $type = $map[$definition['type']];

        return new $type($definition, $shapeMap);
    }

    /**
     * Get the type of the shape.
     *
     * @return string
     */
    public function getType()
    {
        return $this->definition['type'];
    }

    /**
     * Get the name of the shape.
     *
     * @return string
     */
    public function getName()
    {
        return $this->definition['name'];
    }

    public function getMin()
    {
        if (!isset($this->definition['min'])) {
            return false;
        }

        return $this->definition['min'];
    }

    public function getMax()
    {
        if (!isset($this->definition['max'])) {
            return false;
        }

        return $this->definition['max'];
    }

    public function getPattern()
    {
        if (!isset($this->definition['pattern'])) {
            return false;
        }

        return $this->definition['pattern'];
    }
}
