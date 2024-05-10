<?php

namespace Raakkan\Yali\Core\Plugin\Interfaces;

interface PluginInterface
{
    /**
     * Register the plugin's services.
     *
     * @return void
     */
    public function register();

    /**
     * Boot the plugin's services.
     *
     * @return void
     */
    public function boot();

    /**
     * Load the plugin's routes.
     *
     * @return void
     */
    public function loadRoutes();

    /**
     * Load the plugin's views.
     *
     * @return void
     */
    public function loadViews();

    /**
     * Load the plugin's migrations.
     *
     * @return void
     */
    public function loadMigrations();

    /**
     * Load the plugin's assets.
     *
     * @return void
     */
    public function loadAssets();

    /**
     * Get the plugin's name.
     *
     * @return string
     */
    public function getName();

    /**
     * Get the plugin's version.
     *
     * @return string
     */
    public function getVersion();

    /**
     * Get the plugin's description.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get the plugin's dependencies.
     *
     * @return array
     */
    public function getDependencies();
}
