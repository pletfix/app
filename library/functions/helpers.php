<?php

if (!function_exists('dummy_function')) {
    /**
     * This is just a stupid empty function.
     */
    function dummy_function()
    {
    }
}

if (!function_exists('sort_column')) {
    /**
     * Generate a link to sort a table by a column
     *
     * @param string $fieldName Name of the database field to sort after
     * @param string $displayText Text to display as link text
     * @param array $classes css Classes to add to the link (optional)
     * @return string The generated link
     */
    function sort_column($fieldName, $displayText, $classes = [])
    {
        $sortby = request()->input('sortby');
        $orderby = request()->input('order') == 'ASC' ? 'DESC' : 'ASC';
        $url = request()->url() . '?' . http_build_query(array_merge(request()->input(), ['sortby' => $fieldName, 'order' => $orderby]));
        $title = $orderby == 'DESC' ? t('common.sort_desc') : t('common.sort_asc');
        $icon = $sortby == $fieldName ? ' <span class="glyphicon glyphicon-chevron-' . ($orderby == 'DESC' ? 'down' : 'up') . '" aria-hidden="true"></span>' : '';

        return '<a href="' . $url . '" title="' . $title . '" class="' . implode(' ', $classes) . '">' . $displayText . $icon . '</a>';
    }
}

if (!function_exists('is_active_path')) {
    /**
     * Determine if the given path is the current one.
     *
     * @param string $path
     * @return bool
     */
    function is_active_path($path)
    {
        if (empty($path)) {
            return empty(request()->path());
        }

        return substr(request()->path(), 0, strlen($path)) == $path;
    }
}

if (!function_exists('locale_url')) {
    /**
     * Prefix the current URL with the given language code.
     *
     * @param string $lang
     * @return string
     */
    function locale_url($lang)
    {
        $url = request()->baseUrl() . (!empty($lang) ? '/' . $lang : '');

        $path = request()->path();
        if (empty($path)) {
            return $url;
        }

        if (($pos = strpos($path, '/')) !== false) {
            $firstSegment = substr($path, 0, $pos);
            return $url . (is_supported_locale($firstSegment) ? substr($path, $pos) : '/' . $path);
        }
        else {
            return $url . (is_supported_locale($path) ? '' : '/' . $path);
        }
    }
}