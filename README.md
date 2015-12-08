# Devaloka

A WordPress plugin that brings DI Container, Event Dispatcher to WordPress.

## Features

*   DI Container ([Pimple](https://github.com/silexphp/Pimple))
*   Event Dispatcher ([Symfony EventDispatcher](https://github.com/symfony/event-dispatcher))

## Installation

1.  Install via Composer.

    ```sh
    composer require devaloka/devaloka dev-master
    ```

2.  Move `loader/00-devaloka-loader.php` into `<ABSPATH>wp-content/mu-plugins/`.
