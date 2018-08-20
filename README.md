# yii2-seo-behavior
This behavior helps with generating slug and filling seo attributes for model based on its name field value

## Install via Composer

Run the following command

```bash
$ composer require oxy-coach/yii2-seo-behavior "*"
```

or add

```bash
$ "oxy-coach/yii2-seo-behavior": "*"
```

to the require section of your `composer.json` file.

## Configuring

Attach the behavior to your model class:

```php
use oxycoach\seobehavior\SeoBehavior;

\\ ...

    public function behaviors()
    {
        return [
            'SeoBehavior' => [
                'class' => SeoBehavior::className(),
                'nameAttribute' => 'name',
                'slugAttribute' => 'slug',
                'seoAttributes' => ['seoTitle', 'seoKeywords', 'seoDescription']
            ],
        ];
    }
    
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'slug', 'seoTitle', 'seoKeywords', 'seoDescription'], 'string'],
        ];
    }
    
```
So with that configuration before saving your AR model, if `slug` attribute is empty, it would be filled with generated slug from attribute `name`, and so if any of `seoAttributes` attribute is empty, it would be filled with `name` field value. 

> Note that by default slug is generated from string that **expects to contain cytillic symbols**, so if you work with another encoding or symbols, you can provide your own function/method for generating slug using `transliterationFunction` property, like in example below

```php
\\ ...

    public function behaviors()
    {
        return [
            'SeoBehavior' => [
                'class' => SeoBehavior::className(),
                'nameAttribute' => 'name',
                'slugAttribute' => 'slug',
                'transliterationFunction' => 'namespace\for\MyTransliterator::myMethod',
                'seoAttributes' => ['seoTitle', 'seoKeywords', 'seoDescription']
            ],
        ];
    }
```
