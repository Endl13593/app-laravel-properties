<?php

namespace App\Models\Contrato;

use Exception;

class TipoDePessoa
{
    const FISICA    = 1;
    const JURIDICA  = 2;

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
            static::FISICA   => ['id' => self::FISICA,   'name' => 'Pessoa Física'],
            static::JURIDICA => ['id' => self::JURIDICA, 'name' => 'Pessoa Jurídica'],
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
