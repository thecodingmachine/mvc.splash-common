<?php

namespace Mouf\Mvc\Splash\Services;

use Mouf\MoufManager;
use TheCodingMachine\Splash\Services\UrlProviderInterface;
use TheCodingMachine\Splash\Services\SplashRoute;

/**
 * This class scans the Mouf container in order to find all UrlProviderInterface instances.
 * Use it to discover instances.
 */
class MoufExplorerUrlProvider implements UrlProviderInterface
{
    /**
     * Returns the list of URLs that can be accessed, and the function/method that should be called when the URL is called.
     *
     * @param string $instanceName The identifier for this object in the container.
     *
     * @return SplashRoute[]
     */
    public function getUrlsList($instanceName)
    {
        $moufManager = MoufManager::getMoufManager();
        $instanceNames = $moufManager->findInstances(UrlProviderInterface::class);

        $urls = array();

        foreach ($instanceNames as $instanceName) {
            $urlProvider = $moufManager->getInstance($instanceName);
            /* @var $urlProvider UrlProviderInterface */
            if ($urlProvider === $this) {
                continue;
            }
            $tmpUrlList = $urlProvider->getUrlsList($instanceName);
            $urls = array_merge($urls, $tmpUrlList);
        }

        return $urls;
    }

    /**
     * Returns a unique tag representing the list of SplashRoutes returned.
     * If the tag changes, the cache is flushed by Splash.
     *
     * Important! This must be quick to compute.
     *
     * @return mixed
     */
    public function getExpirationTag() : string
    {
        return filemtime(__DIR__.'/../../../../../../../../mouf/MoufComponents.php');
    }
}
