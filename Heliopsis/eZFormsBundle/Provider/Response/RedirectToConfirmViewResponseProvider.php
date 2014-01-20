<?php
/**
 * @author: Benjamin Choquet <bchoquet@heliopsis.net>
 * @copyright: Copyright (C) 2014 Heliopsis. All rights reserved.
 * @licence: proprietary
 */

namespace Heliopsis\eZFormsBundle\Provider\Response;

use eZ\Publish\API\Repository\Values\Content\Location;
use Heliopsis\eZFormsBundle\Provider\ResponseProviderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RedirectToConfirmViewResponseProvider implements ResponseProviderInterface
{
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var string
     */
    private $confirmViewType;

    /**
     * @param UrlGeneratorInterface $urlGenerator
     */
    function __construct(UrlGeneratorInterface $urlGenerator, $confirmViewType )
    {
        $this->urlGenerator = $urlGenerator;
        $this->confirmViewType = $confirmViewType;
    }

    /**
     * @return Response
     */
    public function getResponse( Location $location, $data )
    {
        return new RedirectResponse(
            $this->urlGenerator->generate(
                '_ezpublishLocation',
                array(
                    'locationId' => $location->id,
                    'viewType' => $this->confirmViewType,
                )
            )
        );
    }
}
