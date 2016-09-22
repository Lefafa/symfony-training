<?php

namespace AppBundle\Twig;

use AppBundle\Antispam\Antispam;

class AntispamExtension extends \Twig_Extension
{
    /**
     * @var Antispam
     */
    private $antispam;

    /**
     * Constructor
     */
    public function __construct(Antispam $antispam)
    {
        $this->antispam = $antispam;
    }

    /**
     * Our function uses the function of Antispam service
     */
    public function checkIfArgumentIsSpam($text)
    {
        return $this->antispam->isSpam($text);
    }

    /**
     * Twig executes this method to know what functions the service adds
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('checkIfSpam', array($this, 'checkIfArgumentIsSpam')),
            );
    }

    /**
     * The method getName() identifies our Twig extension, it is required
     */
    public function getName()
    {
        return 'Antispam';
    }
}