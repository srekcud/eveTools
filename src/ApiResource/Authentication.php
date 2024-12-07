<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;

#[ApiResource(
    operations: [
        new Post(
            uriTemplate: '/auth/login',
            shortName: 'Auth',
//            processor: ::class,
        ),
    ]
)]
class Authentication
{
}
