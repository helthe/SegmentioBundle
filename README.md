# Helthe Segment.io Bundle [![Build Status](https://travis-ci.org/helthe/SegmentioBundle.png?branch=master)](https://travis-ci.org/helthe/SegmentioBundle) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/helthe/SegmentioBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/helthe/SegmentioBundle/?branch=master)

Helthe Segment.io Bundle integrates the [Helthe Segment.io Component](https://github.com/helthe/Segmentio)
with your Symfony2 application.

## Installation

### Step 1: Add package requirement in Composer

#### Manually

Add the following in your `composer.json`:

```json
{
    "require": {
        // ...
        "helthe/segmentio-bundle": "dev-master"
    }
}
```

#### Using the command line

```bash
$ composer require 'helthe/segmentio-bundle=dev-master'
```

### Step 2: Register the bundle in the kernel

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Helthe\Bundle\SegmentioBundle\HeltheSegmentioBundle(),
    );
}
```

## Bugs

For bugs or feature requests, please [create an issue](https://github.com/helthe/SegmentioBundle/issues/new).
