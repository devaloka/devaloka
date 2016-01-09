<a name="0.5.3"></a>
## [0.5.3](https://github.com/devaloka/devaloka/compare/v0.5.2...v0.5.3) (2016-01-09)


### Features

* **NavMenu:** introduce NavMenu Interface/Trait ([38df778](https://github.com/devaloka/devaloka/commit/38df778)), closes [#11](https://github.com/devaloka/devaloka/issues/11)
* **PostType:** introduce PostTypeInterface/Trait ([bce122f](https://github.com/devaloka/devaloka/commit/bce122f))
* **Sidebar:** introduce SidebarInterface/Trait ([ade5215](https://github.com/devaloka/devaloka/commit/ade5215))
* **Taxonomy:** introduce TaxonomyInterface/Trait ([c8b9144](https://github.com/devaloka/devaloka/commit/c8b9144))
* **Widget:** introduce WidgetInterface/Trait ([f10dcbc](https://github.com/devaloka/devaloka/commit/f10dcbc))
* **Widget:** introduce ControlAwareWidgetInterface/Trait ([30547cb](https://github.com/devaloka/devaloka/commit/30547cb))



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
