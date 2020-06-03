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

   - Using the Command in Your Terminal: `git clone https://github.com/cp3402-students/2020-sp1-project-group23-cp3402`
   - **Or** Downloading and Extracting the zip file [Here](https://github.com/cp3402-students/2020-sp1-project-group23-cp3402/archive/master.zip)

2. Moving the Extracted Files to `{Wordpress Install}/wp-content/themes/2020-sp1-project-group23-cp3402`
3. Login to your WordPress backend
4. Go to Appearance → Themes
5. Activate the Theme named "Jazz Club Townsville"

---

## Wordpress Site Setup

### Plugins

- Shortcodes Ultimate

### Content Layout

> Note: Make the Home Page a Static Page in `Appearance -> Customize -> Home Page Settings`

- Home Page: Static Wordpress Page Utilising Shortcodes
- Gallery: Static Wordpress Page Utilising Shortcodes
- Events: Category Page Aggregating Wordpress Posts with the Category: Events
- Locations: Static Wordpress Page
- Club History: Static Wordpress Page Utilising Shortcodes
- Events: Category Page Aggregating Wordpress Posts with the Category: Bands
- Locations: Static Wordpress Page
- Join The Club: Static Wordpress Page

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

## Theme Deployment

Included in the Repository is a `github-hook.php` file which will be used to update the theme on both the production and staging websites.

- Within the hook file there is an array called `$hostnames` at the top of the `onPush` function implementation this is where Host Information Following the Structure
  - The Index/Key of the Array is the Web Address of the Host
    - The Keyed Index `wordpressPath` is where your Wordpress installation is from the root of the storage device
    - The Keyed Index `githubBranch` is the branch of the theme repository you want your host to download

An Example of this is:

```php
"Hostname/IP Address" => array(
  "wordpressPath" => "/path/to/wordpress",
  "githubBranch" => "master"
)
```

> Note For Our Wordpress Sites we had to store the `github-hook.php` in a folder in the root HTTP Server called github-hook and renamed the hook to index.php so it was accessible within the Wordpress environment (eg. `/path/to/wordpress/github-hook/index.php`)

Once the `github-hook.php` is setup go to the settings tab on the github repository and select "Webhooks" and then select the "Add Webhook" button
(Repository Settings -> Webhooks -> Add Webhook)

Once There Fill in the Submission Form Accordingly

- `Payload URL` should be the URL you use to access the `github-hook.php` file from your browser (eg. `http://hostname/github-hook.php` or in our case `http://ec2-54-88-118-20.compute-1.amazonaws.com/github-hook/`)
- `Content type` can be either `application/x-www-form-urlencoded` or `application/json` the webhook supports both formats
- `Secret` should be the same as the variable `$hookSecret` at the top of `github-hook.php`
- `Which events would you like to trigger this webhook?` only "Just the push event." should be selected as the webhook doesn't process any other events besides push events from github
- Make Sure the `Active` checkbox is also ticked
- Finally Add the Webhook

---

## License

UnderStrap WordPress Theme, Copyright 2013-2018 Holger Koenemann
UnderStrap is distributed under the terms of the [GNU GPLv2](http://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html)
