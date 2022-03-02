<?php
// api/src/OpenApi/JwtDecorator.php

declare(strict_types=1);

namespace App\Swagger;

use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\Core\OpenApi\OpenApi;
use ApiPlatform\Core\OpenApi\Model;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

final class SwaggerDecorator implements OpenApiFactoryInterface
{

    private OpenApiFactoryInterface $decorated;

    public function __construct(
        OpenApiFactoryInterface $decorated
    ) {
        $this->decorated = $decorated;
    }

    public function __invoke(array $context = []): OpenApi
    {
        $openApi = ($this->decorated)($context);
        $schemas = $openApi->getComponents()->getSchemas();

        $schemas['Token'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'token' => [
                    'type' => 'string',
                    'readOnly' => true,
                ],
                'email' => [
                    'type' => 'string',
                    'example' => 'johndoe@example.com',
                ],
                'lastname' => [
                    'type' => 'string',
                    'example' => 'apassword',
                ],
                'firstname' => [
                    'type' => 'string',
                    'example' => 'johndoe@example.com',
                ],
                'username' => [
                    'type' => 'string',
                    'example' => 'apassword',
                ],
                'phone' => [
                    'type' => 'string',
                    'example' => 'johndoe@example.com',
                ],
                'city' => [
                    'type' => 'string',
                    'example' => 'apassword',
                ],
                'country' => [
                    'type' => 'string',
                    'example' => 'johndoe@example.com',
                ],
            ],
        ]);

        $schemas['Credentials'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'email' => [
                    'type' => 'string',
                    'example' => 'johndoe@example.com',
                ],
                'password' => [
                    'type' => 'string',
                    'example' => 'apassword',
                ],
            ],
        ]);

        $pathItem = new Model\PathItem(
            'JWT Token',
            "Récuperation du token",
            "description",
            null,
            null,
            new Model\Operation(
                'postCredentialsItem',
                ["User"],
                [
                    Response::HTTP_OK => [
                        'description' => 'Get JWT token',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/Token',
                                ],
                            ],
                        ],
                    ]
                ],
                'Retrieve token',
                'Retrieve token using credentials',
                null,
                [],
                new Model\RequestBody(
                    'Credientials object',
                    new \ArrayObject([
                        'application/json' => [
                            'schema' => [
                                '$ref' => '#/components/schemas/Credentials',
                            ],
                        ],

                    ])
                )
            )
        );
        $openApi->getPaths()->addPath('/api/login', $pathItem);

        return $openApi;
    }
}
