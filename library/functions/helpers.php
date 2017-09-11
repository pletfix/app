<?php

if (!function_exists('dummy_function')) {
    /**
     * This is just a stupid empty function.
     */
    function dummy_function()
    {
    }
}

///////////////////////////////////////////////////////////////////////
// table

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
        $title = $orderby == 'DESC' ? ' sort descending' : ' sort descending';
        $icon = $sortby == $fieldName ? ' <span class="glyphicon glyphicon-chevron-' . ($orderby == 'DESC' ? 'down' : 'up') . '" aria-hidden="true"></span>' : '';

        return '<a href="' . $url . '" title="' . $title . '" class="' . implode(' ', $classes) . '">' . $displayText . $icon . '</a>';
    }
}