<?php

@include_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/helpers.php';

use Kirby\Cms\App;
use Kirby\Template\Snippet;

Kirby::plugin('wearejust/twig', [
    'options' => [
        'usephp' => true
    ],
    'components' => [
        'template' => function (App $kirby, string $name, string $contentType = 'html', string $defaultType = 'html') {
            return new Wearejust\Kirby\Twig\Template($name, $contentType, $defaultType);
        },
        'snippet' => function (Kirby $kirby, string $name, array $data = [], bool $slots = false) {
            $snippets = A::wrap($name);

            foreach ($snippets as $name) {
                $name = (string)$name;
                $file = $kirby->root('snippets') . '/' . $name . '.php';

                if (file_exists($file) === false) {
                    $file = $kirby->root('snippets') . '/' . $name . '.twig';
                    if (file_exists($file)) {
                        return twig('@snippets/' . $name . '.twig', $data);
                    } else {
                        $file = $kirby->extensions('snippets')[$name] ?? null;

                        if (null !== $file && Str::endsWith(strtolower($file), '.twig')) {
                            return twig($name . '.twig', $data);
                        }
                    }
                }

                if ($file) {
                    break;
                }
            }

		    return Snippet::factory($name, $data, $slots);
        }
    ]
]);
