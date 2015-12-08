# Devaloka

A WordPress plugin that brings DI Container, Event Dispatcher to WordPress.

## Features

*   DI Container ([Pimple](https://github.com/silexphp/Pimple))
*   Event Dispatcher ([Symfony EventDispatcher Component](https://github.com/symfony/event-dispatcher))

## Requirements

*   [Pimple](https://github.com/silexphp/Pimple)
*   [Symfony EventDispatcher Component](https://github.com/symfony/event-dispatcher)

## Installation

1.  Install via Composer.

    ```sh
    composer require devaloka/devaloka
    ```

2.  Move `loader/00-devaloka-loader.php` into `<ABSPATH>wp-content/mu-plugins/`.

## Components

*   [Event Converter](https://github.com/devaloka/devaloka-event-converter)
*   [Translation](https://github.com/devaloka/devaloka-translation)
*   [Templating](https://github.com/devaloka/devaloka-templating)
*   View Component
*   WordPress Service Provider
*   Plugin
*   Theme
