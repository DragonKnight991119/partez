<p align="center">
    <h1 align="center"><img src="public/partez.png" height="40"/></h1>
    <br/>
    <p align="center">A simple & fast PHP starter kit for web app.</p>
    <p align="center">
        <a href="https://github.com/Antoine-Bollinger/partez/issues">🐛 Report Bug</a>
    </p>
</p>

[![Total Downloads](https://img.shields.io/packagist/dt/abollinger/php-starter)](https://packagist.org/packages/abollinger/php-starter)
[![Latest Stable Version](https://img.shields.io/packagist/v/abollinger/php-starter)](https://packagist.org/packages/abollinger/php-starter)
[![License](https://img.shields.io/packagist/l/abollinger/php-starter)](https://packagist.org/packages/abollinger/php-starter)

This kit is meant to help developpers to quickly create a basic PHP app with router.
This project is published on **[Packagist](https://packagist.org/packages/abollinger/php-starter)** so you can use it via composer.

![Home](public/images/preview.jpg)

## Getting started

Create a new project with: 

```bash
composer create-project abollinger/partez . "1.2.*"
```

Then simply run the PHP server web with:
```bash
composer serve
``` 

and then open your browser at <a href="http://localhost:8000">localhost:8000</a> to see the result.

💡 You can customize the ```composer serve``` script in the composer.json file.

## How it works

### The router

Pages' routes are manually defined in the ```src/config/routes.yaml``` file. To see what a route must contain, let see the ```/about``` route:
```yaml
- route: "/about"
  name: "About"
  controller: "/About/controller.php"
  onNavbar: true
```
This means: 
- The page can be accessed at the route ```<serverName>/about```
- The name that will appear in the page's title is ```About```
- The controller called is localized as ```src/Controller/About/controller.php```

As you can see, you are free to customized all this parameters, but it is important to respect this format. The controller will render the page as explained below.

### The pages

Pages are rendered by the controller in the Controller path. This controller must be an extension of the main FrontendController (```src/Controller/<pagename>/Controller.class.php```) and render a existing Twig template.

### The public folder

The ```public/``` directory contains basics js, css and images folder. Please feel free to customized this part.

### The API

A ```api/``` directory has been created at the root, with for the moment a single ```api/index.php``` returning a JSON object. Of course, this is meant to become a real API with connection to database.

## Bricolo

We've create a basic tool named Bricolo, localized in ```src/config/Bricolo.class.php```. For the moment, the only feature is to create a new page using:
```bash
composer bricolo addpage <pagename>
```
This will automatically create the Controller file in ```src/Controller/<pagename>/Controller.php```, this one being a copy of the template at ```src/config/templates/controller.php``` and calling the Twig's ```src/Model/views/template.twig``` view. Next steps are to create the twig view and call it in the controller.

⛔ Do not delete the ```src/Model/views/template.twig``` as it is the default template used by each new page you create via Bricolo!

## Build with

- This kit is build in **[PHP](https://www.php.net/)**, using as much as possible the **MVC pattern**. We use the **[Twig](https://twig.symfony.com/)** template engine to generate the pages. 
- Style is now powered by **[Bootstrap v5.2](https://getbootstrap.com/)**, using the simple CDN link.
- You can add JS scripts in the public folder or wherever you want, as mentioned earlier.

The basic structure is: 

```bash
.
├── api/
│   └── index.php
├── config/
│   ├── templates/
│   ├── Bootstrap.class.php
│   ├── Bricolo.class.php
│   ├── Helpers.class.php
│   ├── routes.yaml
│   └── texts.yaml
├── public/
│   ├── css/
│   ├── images/
│   └── js/
├── src/
│   ├── Controller/
│   │   ├── [pages]
│   │   └── Controller.class.php
│   ├── Model/
│   │   ├── includes/
│   │   ├── views/
│   │   │   └── [views]
│   │   └── layout.twig
│   └── Router/
│       └── Router.class.php
└── index.php
```

<!--CONTRIBUTING -->

## Contributing

Any contributions you could make will be amazingly appreciated! Please follow this steps to submit your ideas:

- Fork the project
- Create your feature branch widh ```git checkout -b features/Myfeature```
- Commit your work ```git commit -m "✨ Introducing Myfeature!"```
- Push ```git push origin features/Myfeature```
- Open a Pull Request

We'll make a review of your work and merge it to the master branch if everything's OK.
Do not hesitate, every little contribution is a great way to make this starter kit getting bigger!

<!-- CONTACT -->

## Contact 📧

Antoine Bollinger - [LinkedIn](https://www.linkedin.com/in/antoinebollinger/) - antoine.bollinger@gmail.com
