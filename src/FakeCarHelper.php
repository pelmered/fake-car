<?php

namespace Faker\Provider;

use Exception;
use InvalidArgumentException;
use Random\RandomException;

class FakeCarHelper
{
    /**
     * @throws Exception
     */
    public static function getArrayData(array $arrayData, int $count = 1)
    {
        $data = static::isWeighted($arrayData)
            ? static::getWeighted($arrayData, $count)
            : static::getRandomElementsFromArray($arrayData, $count);

        if (is_array($data) && $count === 1) {
            return array_values($data)[0];
        }

        return $data;
    }

    /**
     * Determines if an array is weighted(associative).
     *
     * An array is "associative" if it doesn't have sequential numerical keys beginning with zero.
     */
    public static function isWeighted(array $array): bool
    {
        $keys = array_keys($array);

        return array_keys($keys) !== $keys;
    }

    /**
     * Returns a random element from a passed array
     *
     * @param  array  $values
     *
     * @throws Exception
     */
    public static function getRandomElementFromArray($values)
    {
        $elements = static::getRandomElementsFromArray($values, 1);

        return array_values($elements)[0];
    }

    /**
     * Get random elements from input array
     *
     * @param  array  $values  The input array
     * @param  int  $count  The number of random elements you want to get in your response.
     *                      Leave out or set to 0 for random.
     * @return mixed
     *
     * @throws InvalidArgumentException|Exception
     */
    public static function getRandomElementsFromArray(array $values, ?int $count = 1): array
    {
        //dd('getRandomElementsFromArray', $values,$count);
        $valuesLength = count($values);

        if ($count > $valuesLength) {
            throw new InvalidArgumentException('Count larger than array length.');
        }

        if ($count === 0) {
            return [];
        }

        if (! $count) {
            $count = random_int(1, $valuesLength);
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
     * @param  array  $values  Input array with values as key and weight as value. ['value 1' => 30, 'value 7' => 70]
     *
     * @throws Exception
     */
    public static function getWeighted(array $values, int $count = 1): string
    {
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
    public static function getRange(array $range, int $decimals = 0): string
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
