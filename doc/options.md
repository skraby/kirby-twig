# Options documentation

## Customizing the Twig environment

```php
// Define a directory as a Twig namespace, that can be used as:
//   {% include '@mynamespace/something.twig' %}
'wearejust.twig.namespaces' => [
  'mynamespace' => 'mydirectory',
],

// Define a directory as a Twig namespace using a path given by Kirby.
// Must be called in Kirby's 'ready' option to have access to the Kirby object.
// Can be used as:
//   {% include '@mynamespace/something.twig' %}
'ready' => function () {
  return [
    'wearejust.twig.namespaces' => [
      'mynamespace' => kirby()->root()->index() . '/mydirectory',
    ]
  ];
},

// Load an extension
'wearejust.twig.env.extensions.intl' => 'Twig\\Extra\\Intl\\IntlExtension',

// Expose an existing function in templates
'wearejust.twig.env.functions' => [
  'myfunction' => 'myCustomFunction'
],

// Expose an existing function in templates as a filter
'wearejust.twig.env.filters' => [
  'myfilter' => 'myCustomFilter'
],

// Expose a twig test function for templates
'wearejust.twig.env.tests' => [
  'of_type' => function ($var, $typeTest) {
      switch ($typeTest)
      {
        default:
          return false;
          break;

        case 'array':
          return is_array($var);
          break;

        case 'bool':
          return is_bool($var);
          break;

        case 'string':
          return is_string($var);
          break;
      }
  },
],
```

See [Using your own functions in templates](functions.md) for details about Twig functions and filters.

## Advanced

```php
// Should we use .php templates as fallback when .twig
// templates don't exist? Set to false to only allow Twig templates
'wearejust.twig.usephp' => true

// Use Twig’s PHP cache?
// Enabling Twig's cache can give a speed boost to pages with changing
// content (e.g. a search result page), because Twig will use a compiled
// version of the template when building the response.
// But if you have static text content in your Twig templates, you won’t
// see content changes until you manually remove the `site/cache/twig` folder.
'wearejust.twig.cache' => false

// Disable autoescaping or specify autoescaping type
// http://twig.sensiolabs.org/doc/api.html#environment-options
'wearejust.twig.autoescape' => false | 'html'

// Should Twig throw errors when using undefined variables or methods?
// Defaults to the value of the 'debug' option
'wearejust.twig.strict' => option('debug', false)
```
