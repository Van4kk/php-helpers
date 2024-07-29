<?php

if (! function_exists('array_find')) {
    /**
     * Find the first element in an array that satisfies a callback.
     * In addition, the implementation of these functions is quite similar to `array_filter`
     * and relatively trivial to implement, so the maintenance effort should be low.
     * @param array $array The array that should be searched.
     * @param callable $callback The callback function to call to check each element.
     * The first parameter contains the value, the second parameter contains the corresponding key.
     * If this function returns `true`, the value is returned from `array_find` and the callback will not
     * be called for further elements.
     * @return mixed The function returns the value of the first element for which the <code>$callback</code> returns `true`.
     * If no matching element is found the function returns `NULL`.
     * <code>
     * <?php
     * $array = [
     *      'a' => 'dog',
     *      'b' => 'cat',
     *      'c' => 'cow',
     *      'd' => 'duck',
     *      'e' => 'goose',
     *      'f' => 'elephant'
     * ];
     *
     * // Find the first animal with a name longer than 4 characters.
     * var_dump(array_find($array, function (string $value) {
     *      return strlen($value) > 4;
     * })); // string(5) "goose"
     *
     * // Find the first animal whose name begins with f.
     * var_dump(array_find($array, function (string $value) {
     *      return str_starts_with($value, 'f');
     * })); // NULL
     *
     * // Find the first animal where the array key is the first symbol of the animal.
     * var_dump(array_find($array, function (string $value, $key) {
     *      return $value[0] === $key;
     * })); // string(3) "cow"
     *
     * // Find the first animal where the array key matching a RegEx.
     * var_dump(array_find($array, function ($value, $key) {
     *      return preg_match('/^([a-f])$/', $key);
     * })); // string(3) "dog"
     * ?>
     * </code>
     */
    function array_find(array $array, callable $callback): mixed
    {
        foreach ($array as $key => $value) {
            if ($callback($value, $key)) {
                return $value;
            }
        }

        return null;
    }
}

if (! function_exists('array_find_key')) {
    /**
     * The function returns the key of the first element for which the <code>$callback</code> returns `true`.
     * If no matching element is found the function returns `NULL`.
     * @param array $array The array that should be searched.
     * @param callable $callback The callback function to call to check each element.
     * The first parameter contains the value, the second parameter contains the corresponding key.
     * If this function returns `true`, the key is returned from `array_find_key` and the callback will not be called
     * for further elements.
     * @return mixed the key of the first element for which the <code>$callback</code> returns `true`. If no matching element is found
     * the function returns `NULL`.
     * <code>
     * <?php
     * $array = [
     *      'a' => 'dog',
     *      'b' => 'cat',
     *      'c' => 'cow',
     *      'd' => 'duck',
     *      'e' => 'goose',
     *      'f' => 'elephant'
     * ];
     *
     * // Find the first animal with a name longer than 4 characters.
     * var_dump(array_find_key($array, function (string $value) {
     *      return strlen($value) > 4;
     * })); // string(1) "e"
     *
     * // Find the first animal whose name begins with f.
     * var_dump(array_find_key($array, function (string $value) {
     *      return str_starts_with($value, 'f');
     * })); // NULL
     *
     * // Find the first animal where the array key is the first symbol of the animal.
     * var_dump(array_find_key($array, function (string $value, $key) {
     *      return $value[0] === $key;
     * })); // string(1) "c"
     *
     * // Find the first animal where the array key matching a RegEx.
     * var_dump(array_find_key($array, function (string $value, $key) {
     *      return preg_match('/^([a-f])$/', $key);
     * })); // string(1) "a"
     * ?>
     * </code>
     */
    function array_find_key(array $array, callable $callback): mixed
    {
        foreach ($array as $key => $value) {
            if ($callback($value, $key)) {
                return $key;
            }
        }

        return null;
    }
}

if (! function_exists('array_any')) {
    /**
     * The function returns `true`, if there is at least one element for which <code>$callback</code> returns `true`.
     * Otherwise, the function returns `false`.
     * @param array $array The array that should be searched.
     * @param callable $callback The callback function to call to check each element.
     * The first parameter contains the value, the second parameter contains the corresponding key.
     * If this function returns `true`, `true` is returned from <code>array_any</code> and the callback will not be
     * called for further elements.
     * @return bool returns `true`, if <code>$callback</code> returns `true` for any element.
     * Otherwise, the function returns `false`.
     * <code>
     * <?php
     * $array = [
     *      'a' => 'dog',
     *      'b' => 'cat',
     *      'c' => 'cow',
     *      'd' => 'duck',
     *      'e' => 'goose',
     *      'f' => 'elephant'
     * ];
     *
     * // Check, if any animal name is longer than 5 letters.
     * var_dump(array_any($array, function (string $value) {
     *      return strlen($value) > 5;
     * })); // bool(true)
     *
     * // Check, if any animal name is shorter than 3 letters.
     * var_dump(array_any($array, function (string $value) {
     *      return strlen($value) < 3;
     * })); // bool(false)
     *
     * // Check, if any array key is not a string.
     * var_dump(array_any($array, function (string $value, $key) {
     *      return !is_string($key);
     * })); // bool(false)
     * ?>
     * </code>
     */
    function array_any(array $array, callable $callback): bool
    {
        foreach ($array as $key => $value) {
            if ($callback($value, $key)) {
                return true;
            }
        }

        return false;
    }
}

if (!function_exists('array_all')) {
    /**
     * The function returns `true`, if <code>$callback</code> returns `true` for all elements.
     * Otherwise, the function returns `false`.
     * @param array $array The array that should be searched.
     * @param callable $callback The callback function to call to check each element.
     * The first parameter contains the value, the second parameter contains the corresponding key.
     * If this function returns `false`, `fals`e is returned from <code>array_all</code> and the callback will not
     * be called for further elements.
     * @return bool returns `true`, if <code>$callback</code> returns true for all elements.
     * Otherwise, the function returns `false`.
     * <code>
     * <?php
     * $array = [
     *      'a' => 'dog',
     *      'b' => 'cat',
     *      'c' => 'cow',
     *      'd' => 'duck',
     *      'e' => 'goose',
     *      'f' => 'elephant'
     * ];
     *
     * // Check, if all animal names are shorter than 12 letters.
     * var_dump(array_all($array, function (string $value) {
     *      return strlen($value) < 12;
     * })); // bool(true)
     *
     * // Check, if all animal names are longer than 5 letters.
     * var_dump(array_all($array, function (string $value) {
     *      return strlen($value) > 5;
     * })); // bool(false)
     *
     * // Check, if all array keys are strings.
     * var_dump(array_all($array, function (string $value, $key) {
     *      return is_string($key);
     * })); // bool(true)
     * ?>
     * </code>
     */
    function array_all(array $array, callable $callback): bool
    {
        foreach ($array as $key => $value) {
            if (!$callback($value, $key)) {
                return false;
            }
        }

        return true;
    }
}
