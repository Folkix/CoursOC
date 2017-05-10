<?php
/**
 * Created by PhpStorm.
 * User: Folkix
 * Date: 04/05/2017
 * Time: 14:42
 */

namespace BlogFram;

abstract class ApplicationComponent
{
    protected $app;

    public function  __construct(Application $app)
    {
        $this->app = $app;
    }

    public function app()
    {
        return $this->app;
    }
}