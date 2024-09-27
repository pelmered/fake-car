<?php

namespace Faker\Provider;

use Exception;
use InvalidArgumentException;
use Random\RandomException;

class FakeCarHelper
{
    /**
     * @param  array<int|string, int|string>  $arrayData
     *
     * @throws Exception
     */
    public static function getArrayData(array $arrayData, int $count = 1): mixed
    {
        if (static::isWeighted($arrayData)) {
            /** @var array<int|string, int> $arrayData */
            $data = static::getWeighted($arrayData, $count);
        } else {
            $data = static::getRandomElementsFromArray($arrayData, $count);
        }

        if (is_array($data) && $count === 1) {
            return array_values($data)[0];
        }

        return $data;
    }

    /**
     * Determines if an array is weighted(associative).
     * An array is "associative" if it doesn't have sequential numerical keys beginning with zero.
     *
     * @param  array<int|string, int|string>  $array
     */
    public static function isWeighted(array $array): bool
    {
        $keys = array_keys($array);

        return array_keys($keys) !== $keys;
    }

    /**
     * Returns a random element from a passed array
     *
     * @param  array<int|string, int|string>  $values
     *
     * @throws InvalidArgumentException|RandomException
     */
    public static function getRandomElementFromArray(array $values): int|string
    {
        $elements = static::getRandomElementsFromArray($values, 1);

        return array_values($elements)[0];
    }

    /**
     * Get random elements from input array
     *
     * @param  array<int|string, int|string>  $values  The input array
     * @param  int|null  $count  The number of random elements you want to get in your response.
     *                           Leave out or set to 0 for random.
     * @return array<int|string, int|string>
     *
     * @throws RandomException
     */
    public static function getRandomElementsFromArray(array $values, ?int $count = 1): array
    {
        $valuesLength = count($values);

        if ($count > $valuesLength) {
            throw new InvalidArgumentException('Count larger than array length.');
        }

        if ($count === 0) {
            return [];
        }

        if ($count === null) {
            $count = $valuesLength === 1 ? 1 : random_int(1, $valuesLength);
        }

        return array_intersect_key(
            $values,
            array_flip(
                (array) array_rand($values, $count)
            )
        );
    }

    /**
     * Get one element out of an input array with specified weights to get the distribution
     * of the generated elements as you want them.
     *
     * @param  array<int|string, int>  $values  Input array with values as key and weight as value. ['value 1' => 30, 'value 7' => 70]
     *
     * @throws Exception
     */
    public static function getWeighted(array $values, int $count = 1): string|int
    {
        // TODO: Implement support for $count > 1
        $currentTotal = 0;
        $firstRand    = random_int(1, 100);

        $total = array_sum($values);

        $rand = ($firstRand / 100) * $total;

        foreach ($values as $key => $weight) {
            $currentTotal += $weight;

            if ($rand <= $currentTotal) {
                return $key;
            }
        }

        return '';
    }

    /**
     * @param  array<int>  $range
     *
     * @throws RandomException
     */
    public static function getRange(array $range, int $decimals = 0): int|string
    {
        if (count($range) !== 2) {
            throw new RandomException('Invalid range');
        }

        if ($range[0] > $range[1]) {
            throw new RandomException('Invalid range');
        }

        if ($decimals < 0) {
            throw new InvalidArgumentException('Invalid decimals');
        }
        if ($decimals > 0) {
            $factor = 10 ** $decimals;

            return number_format(random_int($range[0] * $factor, $range[1] * $factor) / $factor, $decimals);
        }

        return random_int($range[0], $range[1]);
    }

    /**
     * @param  array<int>  $range
     *
     * @throws RandomException
     */
    public static function getRangeWithUnit(array $range, string $unit, int $decimals = 0): string
    {
        return static::getRange($range, $decimals).' '.$unit;
    }
}
