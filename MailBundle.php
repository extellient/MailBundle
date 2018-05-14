<?php

namespace Extellient\MailBundle;

use Extellient\MailBundle\DependencyInjection\MailExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class MailBundle.
 */
class MailBundle extends Bundle
{
    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function getContainerExtension()
    {
        return new MailExtension();
    }
}
