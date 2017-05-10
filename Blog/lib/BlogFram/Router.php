<?php
/**
 * Created by PhpStorm.
 * User: Folkix
 * Date: 04/05/2017
 * Time: 15:49
 */

namespace BlogFram;


class Router
{
    protected $route = [];

    const NO_ROUTE = 1;

    public function addRoute(Route $route)
    {
        if (!in_array($route, $this->route))
        {
            $this->routes[] = $route;
        }
    }

    /**
     * @return array
     */
    public function getRoute($url)
    {
        foreach ($this->route as $route)
        {
            if (($varsValues = $route->match($url)) !== false)
            {
                if ($route->hasVars())
                {
                    $varsNames = $route->varsNames();
                    $listVars = [];

                    foreach ($varsValues as $key => $match)
                    {
                        if ($key !== 0)
                        {
                            $listVars[$varsNames[$key - 1]] = $match;
                        }
                    }

                    $route->setVars($listVars);
                }

                return $route;
            }
        }

        throw new \RuntimeException('Aucune route ne correspond à l\'URL', self::NO_ROUTE);
    }
}