<?php

namespace Faker\Provider;

use Exception;
use InvalidArgumentException;

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
     *
     * @param  array  $array
     * @return bool
     */
    public static function isWeighted(array $array): bool
    {
        $keys = array_keys($array);

        return array_keys($keys) !== $keys;
    }

    /**
     * Returns a random element from a passed array
     *
     * @param array $values
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
     * @param array $values The input array
     * @param int $count The number of random elements you want to get in your response.
     * Leave out or set to 0 for random.
     *
     * @return mixed
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

        if (!$count) {
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
     * @param array $values Input array with values as key and weight as value. ['value 1' => 30, 'value 7' => 70]
     * @param int $count
     *
     * @return string
     * @throws Exception
     */
    public static function getWeighted(array $values, int $count = 1): string
    {
        $currentTotal = 0;
        $firstRand = random_int(1, 100);

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
}
