# WP

[![Latest Stable Version][stable-image]][stable-url]
[![Latest Unstable Version][unstable-image]][unstable-url]
[![License][license-image]][license-url]
[![Build Status][travis-image]][travis-url]

A WordPress plugin that provides WordPress objects as services via DI Container.

## Features

*   Providing WordPress objects as services via DI Container.  
    (`wpdb`, `WP_Embed`, `WP_Scripts` and `WP_Styles`)

*   Replacing `WP_Widget_Factory` with new extended one,  
    (Injecting DI Container into Widget, making Widget to be able to subscribe
    events.)

## Installation

1.  Install via Composer.

    ```sh
    composer require devaloka/wp
    ```

[stable-image]: https://poser.pugx.org/devaloka/wp/v/stable
[stable-url]: https://packagist.org/packages/devaloka/wp

[unstable-image]: https://poser.pugx.org/devaloka/wp/v/unstable
[unstable-url]: https://packagist.org/packages/devaloka/wp

[license-image]: https://poser.pugx.org/devaloka/wp/license
[license-url]: https://packagist.org/packages/devaloka/wp

[travis-image]: https://travis-ci.org/devaloka/wp.svg?branch=master
[travis-url]: https://travis-ci.org/devaloka/wp
