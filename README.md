# TSV CP3402 Group 23 - Wordpress Theme

Based on the starter theme: [Understrap](https://github.com/understrap/understrap) - Consult The Understrap Repository for Additional Information

---

## Branch Usage

- **Master Branch** - This Branch is Currently Used For All Ongoing Theme Development
- **Production Branch** - Used to Hold The Current Version of the Theme for the Live Site
- **Miscellaneous Branches** - Will be used to Hold Untested or Broken Commits and Features that are not yet ready

---

## Understanding Theme Layout ([More Details Here](https://github.com/understrap/understrap#confused-by-all-the-css-and-sass-files))

- All Styling Work For This Theme is Done in SCSS and is located in the `./sass/theme/` Folder
- All Additonal Sass Files Must start With an **\_** (eg. \_header.scss) - [Documentation](https://sass-lang.com/guide)

**Do Not Edit The `./style.css` File as this is only used to Identify the theme within Wordpress**

- Your design goes into: `./sass/theme` Folder.
  - Add your styles to the `./sass/theme/_theme.scss` file
  - And your variables to the `./sass/theme/_theme_variables.scss`
  - Or add other .scss files into it and `@import` it into `./sass/theme/_theme.scss`.

- **NOTE FOR ANY ADDITIONAL FILES (Option 3 Above)** - Append The `@import` at the bottom of the file to prevent styling overrides.

 ```scss
 /*Line 1*/ @import "theme/theme_variables";
 ....
 /*Line 5*/ @import "theme/theme";
..
/*Last Line*/ @import "theme/your_new_style_file";
 ```

---

## Installing

1. Clone/Download The [Repository](https://github.com/cp3402-students/2020-sp1-project-group23-cp3402) 
    - Using the Command in Your Terminal:  `git clone https://github.com/cp3402-students/2020-sp1-project-group23-cp3402`
    - **Or** Downloading and Extracting the zip file [Here](https://github.com/cp3402-students/2020-sp1-project-group23-cp3402/archive/master.zip)

2. Moving the Extracted Files to `{Wordpress Install}/wp-content/themes/2020-sp1-project-group23-cp3402`
3. Login to your WordPress backend
4. Go to Appearance → Themes
5. Activate the understrap theme

---

## Active Development

### Installing Dependencies

- Make sure you have installed Node.js on your computer globally
- Then open your terminal and browse to the location of the theme
- Run: `$ npm install`

### Running
To work with and compile your Sass files on the fly start:

- `$ gulp watch`

---

## License

UnderStrap WordPress Theme, Copyright 2013-2018 Holger Koenemann
UnderStrap is distributed under the terms of the [GNU GPLv2](http://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html)
