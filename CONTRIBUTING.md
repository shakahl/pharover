# Contribution Guide

Thank you for considering contributing to the project!

## Table of contents

* [Bug Reports](#bug-reports)
* [Coding Style](#coding-style)
    - [DocBlocks](#docblocks)

## Bug Reports

To encourage active collaboration, We strongly encourages pull requests, not just bug reports. "Bug reports" may also be sent in the form of a pull request containing a failing test.

However, if you file a bug report, your issue should contain a title and a clear description of the issue. You should also include as much relevant information as possible and a code sample that demonstrates the issue. The goal of a bug report is to make it easy for yourself - and others - to replicate the bug and develop a fix.

Remember, bug reports are created in the hope that others with the same problem will be able to collaborate with you on solving it. Do not expect that the bug report will automatically see any activity or that others will jump to fix it. Creating a bug report serves to help yourself and others start on the path of fixing the problem.

## Coding Style

This project follows the [PSR-2][psr2] coding standard and the [PSR-4][psr4] autoloading standard.

### DocBlocks

The `@param` tags should not be aligned and arguments should be separated by 2 spaces.

Here's an example block:

```php
/**
 * Register a binding with the container.
 *
 * @param  string|array  $abstract
 * @param  \Closure|string|null  $concrete
 * @param  bool  $shared
 * @return void
 */
public function bind($abstract, $concrete = null, $shared = false)
{
    // …
}
```

[psr2]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
[psr4]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md
