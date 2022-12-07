<p align="center">
    <p align="center"><img src="public/partez.png" height="40"/></p>
    <br/>
    <p align="center">A simple & fast PHP starter kit for web app.</p>
    <p align="center">
        <a href="https://github.com/Antoine-Bollinger/partez/issues">🐛 Report Bug</a> | <a href="https://packagist.org/packages/abollinger/partez">See on Packagist 📦️</a>
    </p>
</p>

[![Total Downloads](https://img.shields.io/packagist/dt/abollinger/partez)](https://packagist.org/packages/abollinger/partez)
[![Latest Stable Version](https://img.shields.io/packagist/v/abollinger/partez)](https://packagist.org/packages/abollinger/partez)
[![License](https://img.shields.io/packagist/l/abollinger/partez)](https://packagist.org/packages/abollinger/partez)

This kit is meant to help developpers to quickly create a basic PHP app with router.
This project is published on **[Packagist](https://packagist.org/packages/abollinger/partez)** so you can use it via composer.

![Home](public/images/preview.jpg)

<!-- TABLE OF CONTENTS -->
<details open="open">
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#getting-started">Getting started</a>
      <ul>
        <li><a href="#requirements">Requirements</a></li>
        <li><a href="#steps">Steps</a></li>
      </ul>
    </li>
    <li><a href="#how-it-works">How it works</a></li>
      <ul>
        <li><a href="#the-router">The router</a></li>
        <li><a href="#the-pages">The pages</a></li>
        <li><a href="#the-public-folder">The public folder</a></li>
        <li><a href="#the-API">The API</a></li>
      </ul>
    <li><a href="#bricolo">Bricolo</a></li>
    <li><a href="#build-with">Build with</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#contact">Contact</a></li>
  </ol>
</details>

## Getting started

### Requirements

All you need is [Composer](https://getcomposer.org/) to create the project, install the dependencies and run the server (in developpement mode).

### Steps

1. First create a new folder for you project and open a terminal in that folder
2. Run the following command. This will create all the necessaries files and install the dependencies of the project:

```bash
composer create-project abollinger/partez . "1.2.*"
```
3. Finally run the simple command:

```bash
composer serve
``` 

and then open your browser at <a href="http://localhost:8000">localhost:8000</a> to see the result.

💡 You can customize the ```composer serve``` script in the composer.json file.

## How it works

### The router

Pages' routes are manually defined in the ```src/config/routes.yaml``` file. To see what a route must contain, let see the ```/about``` route:
```yaml
- route: /about
  name: About
  controller: Abollinger\Partez\Controller\HomeController
```
This means: 
- The page can be accessed at the route ```<serverName>/about```
- The name that will appear in the page's title is ```About```. Also note that you can define a title here (```title: Titre```) if you prefere.
- The name define the controller file called: ```src/controller/About.controller.php```
- The controller called will be ```Abollinger\Partez\Controller\AboutController``` 

As you can see, you are free to customized all this parameters, but it is important to respect this format. The controller will render the page as explained below.

### The pages

Pages are rendered by the controller in the ```src/controller``` path. This controller must be an extension of the main controller define in ```config/controller.php```.
If the page's controller you must define the ```init()``` method that will call the ```renderView("page.html.twig")``` method which render the twig template.

The twig templates are localized in the ```templates/``` at the root of the project. Basic twig layout is defined as ```templates/layout.html.twig``` and each page's twig template extends this layout.

### The public folder

The ```public/``` directory contains basics js, css and images folder. Please feel free to customized this part.

### The API

A ```api/``` directory has been created at the root, with for the moment a single ```api/index.php``` returning a JSON object. Of course, this is meant to become a real API with connection to database.

## Bricolo

We've create a basic tool named Bricolo, localized in ```bricolo/bricolo.php```. For the moment, the only feature is to create a new page using:
```bash
composer bricolo addpage <pagename>
```
This will automatically create the Controller file in ```src/controller/<Pagename>.controller.php``` ( copy of the template at ```bricolo/templates/controller.php```).

🚩 Don't forget to rename this new controller (default is NewController) and to declare the route in the config/routes.yaml following the example above, and change the twig template used (default is ```templates/views/template.html.twig```).

⛔ Do not delete the ```templates/views/template.html.twig``` as it is the default template used by each new page you create via Bricolo!

## Build with

- This kit is build in **[PHP](https://www.php.net/)**, using as much as possible the **MVC pattern**. We use the **[Twig](https://twig.symfony.com/)** template engine to generate the pages. 
- Style is now powered by **[Bootstrap v5.2](https://getbootstrap.com/)**, using the simple CDN link.
- You can add JS scripts in the public folder or wherever you want, as mentioned earlier.

The basic structure is: 

```bash
.
├── api/
│   └── index.php
├── bricolo/
│   ├── templates/
│   └── bricolo.php
├── config/
│   ├── boostrap.php
│   ├── controller.php
│   ├── helpers.php
│   ├── router.php
│   ├── routes.yaml
│   └── texts.yaml
├── public/
│   ├── css/
│   ├── images/
│   └── js/
├── src/
│   ├── controller/
│   │   └── [Controllers, typo is <Name>.controller.php]
│   ├── model/
│   │   ├── includes/
│   │   ├── views/
│   │   │   └── [views]
│   │   └── layout.twig
│   └── router/
│       └── App.router.php
│── templates/
│   ├── includes/
│   ├── views/
│   │   └── [views, typo <name>.html.twig]
│   └── layout.twig
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

## Contact

Antoine Bollinger - [LinkedIn](https://www.linkedin.com/in/antoinebollinger/) - antoine.bollinger@gmail.com
