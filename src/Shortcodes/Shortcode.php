<?php

namespace OnlineMenukaart\Shortcodes;

interface Shortcode
{
    /**
     * @param array $attributes
     *
     * @return string
     */
    public function __invoke(array $attributes);
}