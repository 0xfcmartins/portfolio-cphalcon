# Phalcon PHP

This is a clean of [MVC][mvc-pattern] file structures you can use to develop and employ using Phalcon >= 3.0.x

```
Phacon-php/
├── app
│   ├── cache (.volt compile cache)
│   ├── config (Project configuration and environment vars)
│   │   └── config.php (Phalcon app config)
│   ├── controllers
│   │   ├── BaseController.php
│   │   └── IndexController.php
│   ├── services
│   │   ├── core
│   │   │   ├── ApplicationLoader.php
│   │   │   └── DependencyInjector.php
│   │   └── ServicesManager.php
│   └── views
│       ├── index
│       │   └── index.volt
│       ├── partials
│       │   ├── footer.volt
│       │   └── head.volt
│       └── base.volt
└── public
    └── index.php
```

## License

[devtools]: https://github.com/phalcon/phalcon-devtools
[mvc-pattern]: https://en.wikipedia.org/wiki/Model–view–controller
