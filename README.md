smart
===

Based on _s and Zurb's Foundation 5.

Includes Foundation SCSS files and the SCSS library Bourbon. Please edit style.scss, _mixins.scss and foundation-custom.scss.

If scss is not wanted, please enqueue the /css/foundation.min.css stylesheet instead of foundation-custom.css.

Also included is rem polyfill, respond.js which fixes this puppy for IE8 and lower.


Custom javascripts that you want to run in the footer can be included in the /js/main.js.


####Template tags

#####smart_img($imgName, $imgClass, $imgWidth, $imgHeight, $imgCrop, $imgRetina)

*$imgName options:

- 'url'
- 'thumbnail' works in archives and single view
- 'yourimage.png' gets the image from the theme image folder


*$imgClass options:

- appends the given class to the image


*$imgWidth options:

- (numeric) sets image width


*$imgHeight options: 

- (numeric) sets image height


*$imgCrop options:

- (boolean) hard or soft crop. Default is true (hard-crop)


*$imgRetina options:

- (boolean) better quality image? Default is false.


#####smart_pagination

kriesi pagination
