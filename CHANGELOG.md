10.0
====

- Most code has been moved to thecodingmachine/splash-router
- Only classes specific to Mouf or embedding some display logic stay in this package

7.0
===

- renamed 'splash' instance to 'splashMiddleware'
- 'splash' is now a PSR-7 middleware based on zendframework/stratigility
- Request and Response objects are based on zendframework/diactoros
- Switched default error router from mouf/whoops-stackphp to franzl/whoops-middleware
- In controllers, if you want to inject the request, you must now type hint against PSR-7's "ServerRequestInterface"
- In controllers, you MUST return PSR-7's ResponseInterface
