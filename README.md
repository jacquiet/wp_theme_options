
# Module 'Theme Options' README
------------------------------------------------------------
CONTENTS

1. Overview
2. Installation
3. Gulp Options
4. Configuration
5. Important Notes




1. OVERVIEW
------------------------------------------------------------
Theme Options (TO) is a stand-alone module, which display the options of the theme under Appearance - Theme Options.

Under the hood, TO is a OO single-page configuration MVC application, which utilises the SOLID design pattern. The core of TO is
broken down into meaningful files. Here's the structure:

- Controller    - contains Controller.php, which communicates with the views
- Helper        - contains Helper.php, which is a wrapper for helper methods
- Metabox       - contains Metabox.php, which is a wrapper for meta field creation methods
- Model         - contains Model.php, which communicates with the database
- Router        - contains Router.php, which handles url requests
- View          - contains the application's views

TO also contains:

- assets        - wrapper for static resources - css, sass, js, images, fonts
- widgets       - components, which has their own view and can communicate with the database directly

The theme is also integrated with Gulp, so common tasks like sass pre-compilation, js concatenation and minification are automated.




2. INSTALLATION
------------------------------------------------------------
The theme is integrated with Gulp. To use the pre-defined Gulp tasks you need to install:
	node        - https://nodejs.org/en/download/
	npm         - https://docs.npmjs.com/cli/install
	gulp        - https://www.npmjs.com/package/gulp

Once ready, open a command prompt in the theme's main directory and run:
npm install

The above command will install all dependencies, located in themedir/package.json - devDependencies.
If you want to add more plugins, insert them in devDependencies array in package.json.

There's are several gulp tasks, defined in gulpfile.js:

	gulp app:watch  - combines tasks [sass:watch] and [js:watch]
	gulp sass:watch - precompilation of sass files upon save
	gulp js:watch   - concatenation of js files upon save
	gulp js:concat  - concatenation of js files
	gulp js:minify  - minification of js files

If you want to add more tasks, define them in gulpfile.js




3. GULP OPTIONS
------------------------------------------------------------
Open a command prompt or terminal in the theme's main directory.

You have 5 commands at your disposal:

	gulp app:watch
	This is an on-going task, which conbines tasks [sass:watch] and [js:watch]

	gulp sass:watch
	This is an on-going task, which watches your sass files for updates and compiles them to themedir/style.css

	gulp js:watch
	This is an on-going task, which watches for updates all js files defined in gulpfile.js - jsPaths and concatenates them to themedir/assets/js/main.js

	gulp js:concat
	This is a one-time task, which concatenates all files defined in gulpfile.js - jsPaths to assets/js/main.js

	gulp js:minify
	This is a one-time task, which minifies assets/js/main.js to assets/js/main.min.js




4. CONFIGURATION
------------------------------------------------------------
To activate Theme Options for your theme, please follow these steps:
    - Include init.php (found in the main module dir) in your theme's functions.php file

That's it! You're ready to start using Theme Options.

If you want to customize the module, you can configure its settings. To do this, open init.php and configure your module from the global variable 'module'.
Some of the configuration options include:

    - mode      - 'development' or 'production'
    - name      - the name of the module
    - pages     - the module pages
    - display   - callback function which displays the module page
    - create    - callback function which creates the module
    - base_view - base view for the module
    - params    - GET and POST params, used by the module

If you want to add module pages, make sure to add the new page in the module settings in init.php and also make sure to add the new view under moduledir/core/View



5. IMPORTANT NOTES:
------------------------------------------------------------
- This theme loads a single javascript file, which contains all javascript libraries - jquery, sly, core.js, etc. The goal of this approach is to increase the overall performance of the site by reducing the number of HTTP requests. Less scripts to include, less HTTP requests to handle. This optimization is primarily for mobile devices, where the number of HTTP requests can really matter.

- The javascript functionality of moduledir/components is located in moduledir/assets/javascripts/core/core.js - App Class - components object wrapper. App Class contains a private method called initComponents which performs 'smart load' for components. InitComponents searches for components and matches the found results with the components defined in App Class - components object wrapper. This means that only the page-specific components will be loaded on the current page. This goal of this approach is to minimize called javascript code.

- The theme's styles are precompiled using SASS files, located in moduledir/assets/sass.

- Make sure to run 'gulp js:concat' and 'gulp js:minify' before going in Production mode.

- Make sure to set the module to the correct mode, from init.php - global $module - $module['mode']

- To extend javascript functionality, insert your code in moduledir/js/core/core.js file. Please maintain the modular pattern used for App Class (encapsulating private methods and exposing only public methods)