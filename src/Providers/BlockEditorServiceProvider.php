<?php

namespace OnlineMenukaart\Providers;

use Illuminate\Container\Container;
use OnlineMenukaart\Plugin;

class BlockEditorServiceProvider
{
    /**
     * @var Container
     */
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function register()
    {
        add_action('init', function () {
            wp_register_style(
                'onlinemenukaart-style-css',
                plugins_url('onlinemenukaart/dist/blocks.style.build.css'),
                is_admin() ? array('wp-editor') : null,
                filemtime($this->container['path'] . 'dist/blocks.style.build.css')
            );

            wp_register_script(
                'onlinemenukaart-block-js',
                plugins_url('onlinemenukaart/dist/blocks.build.js'),
                array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor'),
                filemtime($this->container['path'] . 'dist/blocks.build.js'),
                true
            );

            wp_register_style(
                'onlinemenukaart-block-editor-css',
                plugins_url('onlinemenukaart/dist/blocks.editor.build.css'),
                array('wp-edit-blocks'),
                filemtime($this->container['path'] . 'dist/blocks.editor.build.css')
            );

            wp_localize_script(
                'onlinemenukaart-block-js',
                'omkGlobal',
                ['api_token' => Plugin::token()]
            );

            register_block_type(
                'onlinemenukaart/block-menukaart-embed', array(
                    'style'         => 'onlinemenukaart-style-css',
                    'editor_script' => 'onlinemenukaart-block-js',
                    'editor_style'  => 'onlinemenukaart-block-editor-css',
                )
            );
        });
    }
}