<a name="0.5.2"></a>
## [0.5.2](https://github.com/devaloka/devaloka/compare/v0.5.1...v0.5.2) (2015-12-29)


### Bug Fixes

* **EventDispatcher:** remove deprecated EventDispatcherInterface usage ([50af074](https://github.com/devaloka/devaloka/commit/50af074))
* **NullObject:** property mutation should do nothing ([7d09b99](https://github.com/devaloka/devaloka/commit/7d09b99))
* **NullObject:** remove unnecessary implementation of Serializable Interface ([86f5e15](https://github.com/devaloka/devaloka/commit/86f5e15))
* **NullObject:** static call should return NullObject ([0de17b7](https://github.com/devaloka/devaloka/commit/0de17b7))
* incorrect version number in plugin header comment ([6a5fad2](https://github.com/devaloka/devaloka/commit/6a5fad2))
* remove unnecessary locale file validation ([77152dc](https://github.com/devaloka/devaloka/commit/77152dc))



<a name="0.5.1"></a>
## [0.5.1](https://github.com/devaloka/devaloka/compare/v0.5.0...v0.5.1) (2015-12-19)


### Bug Fixes

* symfony/event-dispatcher ~3.0 requires php >=5.5.9 ([84cad72](https://github.com/devaloka/devaloka/commit/84cad72)), closes [#2](https://github.com/devaloka/devaloka/issues/2)

### Features

* introduce Devaloka MU Plugin Installer ([7f9b699](https://github.com/devaloka/devaloka/commit/7f9b699))


### BREAKING CHANGES

* drop PHP 5.4 support.



<a name="0.5.0"></a>
# [0.5.0](https://github.com/devaloka/devaloka/compare/484a795...v0.5.0) (2015-12-08)


### Bug Fixes

* implement EventDispatcherInterface::getListenerPriority() ([484a795](https://github.com/devaloka/devaloka/commit/484a795))
