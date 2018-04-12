# Support for phpdoc headers

```twig
{#
/**
 * My component
 *
 * This is a description for my component.
 *
 * @example
 * {% for i in 1.6 %}
 *   <h{{ i }}>Headline {{ i }}</h{{i}}>
 * {% endfor %}
 *
 * @param String $title Headline text
 * @param int $depth Headline depth
 * /
#}

<h{{ depth }}>{{ title }}</h{{ depth }}>
```
## Supported tags

- Title
- Description
- @param
- @example