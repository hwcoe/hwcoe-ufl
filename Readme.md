HWCOE UFL 
================

Official template for Herbert Wertheim College of Engineering. Based on UFCLAS UFL 2015 and template by 160over90. Maintained by HWCOE MARCOM.

Installation
-------------

Download and unzip files into a folder named 'hwcoe-ufl' in the themes directory. Activate theme in your site.


Requirements and Suggested Plugins
-----------------------------------

### Required

- WordPress 4.4 or above
- Support for .svg files
- Advanced Custom Fields Pro - visual interface for custom fields 

### Recommended Plugins

- List Category Posts - replacement for custom recent posts widget

See https://github.com/hwcoe/hwcoe-ufl/wiki/Plugins-Tools for additional recommended plugins and tools.

Documentation
--------------

- [Documentation Wiki](https://github.com/hwcoe/hwcoe-ufl/wiki)

Changelog
---------
### 2.8.1
- Move gtag code to correct location inside `<head>` tag
- Correct default UF directory link in footer
- Accessibility improvements
	- Remove redundant role attribute from nav elements
	- Add text-decoration to category and post nav links
	- Increase color contrast for article and sidenav links
	- Add more visible focus styles for links and form elements
	- Add/move nav and header landmarks where needed
	- Add aria-label attributes to duplicate landmarks where needed
	- Make sure focus updates on skip-nav link click 
	- Add accessibility focus on audience menu

### 2.8.0
- Implement fallback page menu for primary nav 
- Allow site tagline to be a link
- Update print stylesheet to remove link URLs (per leadership) and improve directory printout display
- Correct sidenav code to be valid HTML
- Fix select text color in widgets
- Fix single post widget display in legacy homepage layout

### 2.7.1
- Provide fallback styles for Media & Text Gutenberg blocks in IE11

### 2.7.0
- Make some theme functions pluggable for better child theme and plugin support
- Fix padding issue with TinyMCE fields
- Allow display of site tagline as subheading in Title Text header type
- Update alert link display

### 2.6.0
- Provide "Remove content container" option for Members Only and No Sidebars or Widgets page templates
	- Move Page Options ACF field group from local PHP into synchronized JSON
- Update Node dependencies

### 2.5.0
- Remove default archive widget from post sidebar
	- Change default archive widget in archive template from dropdown to list
- Add [clear] shortcode to theme to allow adding clearfix to post content
- Add styles for Slickr Flickr plugin; remove bullets for SF gallery list items

### 2.4.2
- Fix print styles so extraneous info won't print
- Navigation Menu Widget: adjust formatting for .sub-menu list
- Fix caption color contrast in widgets
- Reduce body padding-top for the following templates:
	- Default
	- Members Only Page
	- No Sidebars or Widgets - Container
	- Right Sidebar, No Left Navigation - Container

### 2.4.1
- Limit Event Name character length in event submission form template
- Bugfix: Update handle for Customizer inline styles function (changed in 2.3.4 for child theme support)
- Bugfix: Add markup to SVGs to improve accessibility and scaling support in Edge browser
	- Append `#Layer_1` to `$custom_logo` variable rather than including it in header markup
	- Update svg4everybody js plugin
- Bugfix: Ensure "use post featured image" setting does not prevent uploaded homepage hero image displaying on external stories

### 2.4.0
- Add General Content module to Home Page - No Container template
- Fix commenting on landing page content modules
- Fix display issues with Stats module H2 breaking layout at longer lengths

### 2.3.4
- Templates with sidebars - make content area 100% width if no active sidebars exist 
- Remove widget files not included in theme
- Child theme support bugfixes 
	- Change relevant instances of get_stylesheet_directory to get_template_directory
	- Update handle for parent stylesheet 

### 2.3.3
- Add formatting to data tables in the main-content area
- Override some Tablepress CSS rules with HWCOE theme formatting
- Edits to styles for Secondary Featured Content:
	- Remove bullets and margins from unordered lists
	- Update H2 and span styles within ULs to play nice with RSSImport
- Update Node dependencies

### 2.3.2
- Add comments.php
- Fix non-homepage widgets and refactor widget styles
- Add bullets to unordered list items in Text and Custom HTML widgets

### 2.3.1
- Fix issue with lengthy .btn elements overflowing at small screen sizes
- Make aside element 100% width at small screen sizes
- Adjust primary nav positioning when admin bar is present
- Have Latest Post Slider Options show up on post edit screen when a Posts page is set

### 2.3.0
- Add Options Output page template to display lists of posts with custom meta information
- Fix layout for image galleries (classic editor shortcode and block editor gallery)
- Display image title (standalone image) or description (gallery image) in prettyPhoto lightbox (Classic editor only)
- Hide social buttons in prettyPhoto lightbox 

### 2.2.1
- Correct Subpage Header thumbnail image dimensions to fill width of default template content area

### 2.2.0
- Update package dependencies and gruntfile
- Add theme version to enqueueing of scripts and styles
- Bugfix: Add support for page excerpts
- Bugfix: Add href for half width legacy slider link
- Accessibility improvements
	- Increase text/bg color contrast for certain elements
	- Edit #skip-link:focus positioning and z-index so it's visible on home page
	- Add #main element on home page template, adjust location of #main element on legacy slider/widgets layout
	- Add ARIA labels to describe purpose for generic links (e.g. "read more") in modules and templates
	- Eliminate duplicate IDs for search form elements

### 2.1.1
- Bugfix: Remove WPAUTOP from ACF TinyMCE Editor to get rid of random p tags being added in ACF text/WYSIWYG fields
- Bugfix: Adjust text size, margins, etc. in secondary featured content to improve display in small screen breakpoints

### 2.1.0
- Bugfix: Edit `ufl-landing-page-hero` shortcode to display original uploaded image size rather than `large` 1024x512 thumbnail
- Display page title on landing page templates if no featured image or hero image shortcode exists
- Update landing page Archive Content module and button styles
- Update landing page Subpage List module display
- Style feature additions and bug fixes:
	- Remove large bottom margin from H3
	- Allow .big-list to display at small screen sizes
	- Add padding in small screen view of content modules
	- Adjust background image alignment for Secondary Content with Image module
	- Remove horizontal scrolling for small-screen view of Triple Image Callout module
	- Modify styles for List Category Post listings
	- Adjust responsive image display
	- Adjust ul and ol list item styling
	- Define styles for `aside` element
	- Refactor styles and remove unnecessary redundancies

### 2.0.x
- Bugfix: Remove gform_pre_render hook from GF custom code as it causes a `Cannot modify header information` warning. 
	- **Backward incompatible change** See [Issue #10](https://github.com/hwcoe/hwcoe-ufl/issues/10#issuecomment-419129443)
- Bugfix: Update Title Override Text so it does not affect page title in navigation menus. 
	- **Backward incompatible change** see [Issue #9](https://github.com/hwcoe/hwcoe-ufl/issues/9#issue-357292449)
- Remove `Title Override` field (`Page Options` field group) from blank and home page templates  

### 1.3.x

- Add Gravity Forms add-on functions for enabling "maintenance mode" and enhanced multi-select field options
- Add styles for post-list 
- Bugfix: Adjust default $content_width; make video embeds responsive
- Add list bullets to unordered lists
- Fix numbering bug in ordered lists
- Add "reversed" option for ordered lists
- Fix bug with header display of social media icons 
- Make global menu visible with Title Text header type
- DRYify aux nav in header-text and header-logo
- Limit Footer Options admin page display to site administrators

### 1.2.0

- Add HWCOE_Events_Widget for use with Events Manager plugin
- Update styles for Events Manager plugin events list
- Add Events Manager templates
- Update WP-FullCalendar styles
- Update default background images 
- Update content and forms CSS
- Clean up stats module CSS and change default focus background
- Revise comments

### 1.1.x

- ACF: Implement synchronized JSON for enhanced performance and version control of ACF field groups
- Add favicon.ico
- Correct ACF function calls in footer.php
- Update node.js devDependencies
- Accessibility improvements in stylesheets
- Clean up Sass

### 1.0.x

- Initial beta release
- Add custom logo size and position controls to customizer
- Update ACF settings

### 0.1.x

- Update Readme file
- Update styles and php from CLAS 2015 theme for HWCOE