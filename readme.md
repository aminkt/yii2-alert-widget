How to install this widget:

Step1: Run below command
```
composer require aminkt/yii2-alert-widget
```
|Or add flowing line to require part of `composer.json` :
|```
|"aminkt/yii2-alert-widget": "*",
|```
|
|And then run bellow command in your composer :
|```
|Composer update aminkt/yii2-bootstrap-ajax-modal-widget
|```



Step2: Add flowing lines in your application view file:

```php
<?php echo \aminkt\widgets\alert\Alert::widget() ?>
```