Avantime Social
===
# Usage
## Facebook
If in WordPress Editor just use the shortcode
```
[facebook-box account="avantimegroup" width="300" heigth="525" hidecover="false" showfaces="false" showposts="true"]
```
where all the above is the default values and all are optional.

If in php code, use the following
```php
echo do_shortcode('[facebook-box account="avantimegroup" width="300" heigth="525" hidecover="false" showfaces="false" showposts="true"]');
```
or
```php
if(class_exists('AvantimeSocial')) {
    $AVS = AvantimeSocial::getInstance();
    $AVS->FacebookBox();
}
```
with optional an array with keys according to above.