<?php

namespace App\Models\Propriedade;

use Exception;

class StatusPropriedade
{
    const NAO_CONTRATADO = 1;
    const CONTRATADO     = 2;

    public static function getName($key): ?string
    {
        try {
            return static::map()[$key]['name'];
        } catch (Exception $e) {
            return null;
        }
    }

    public static function getArray($key): ?array
    {
        try {
            return static::map()[$key];
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Retrieve a map of enum keys and values.
     *
     * @return array
     */
    public static function map(): array
    {
        return [
            static::NAO_CONTRATADO => ['id' => self::NAO_CONTRATADO,  'name' => 'Não Contratado'],
            static::CONTRATADO     => ['id' => self::CONTRATADO,      'name' => 'Contratado'],
        ];
    }

    /**
     * Retrieve a map of enum keys and values.
     *
     * @return array
     */
    public static function all(): array
    {
        $data = [];

        foreach (self::map() as $item) {
            $data[] = $item;
        }

        return $data;
    }
}
