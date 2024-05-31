---
lang: en-US
title: Resources
description: Resources
---

# Resources
Yali provides a convenient way to generate resource classes for your Laravel application. A resource class represents a single model and defines the structure and behavior of the associated table and form in the Yali admin panel.

To create a new Yali resource, you can use the yali:resource Artisan command followed by the name of the model class. For example:

```bash
php artisan yali:resource User
```

This command will generate a new resource class named UserResource in the app/Yali/Resources directory.

Generated Resource Class
The generated resource class will have the following structure:

```php
<?php

namespace App\Yali\Resources;

use Raakkan\Yali\Core\Forms\YaliForm;
use Raakkan\Yali\Core\Table\YaliTable;
use Raakkan\Yali\Core\Resources\YaliResource;
use App\Models\User;

class UserResource extends YaliResource
{
    protected static $model = User::class;

    public function table(YaliTable $table): YaliTable
    {
        return $table->columns([
            // Define your table columns here
        ])->filters([
            // Define your table filters here
        ]);
    }

    public function form(YaliForm $form): YaliForm
    {
        return $form->fields([
            // Define your form fields here
        ]);
    }
}
```

The resource class extends the YaliResource base class and is associated with the specified model class using the $model property.

### Table Configuration
Inside the table method, you can define the columns and filters for the resource's table view in the admin panel. Use the columns method to specify the table columns and the filters method to define any filters that can be applied to the table data.

### Form Configuration
Inside the form method, you can define the fields for the resource's create and edit forms in the admin panel. Use the fields method to specify the form fields.

## Configuring the Resource

### Customizing Resource Titles and Subtitles
Yali provides several properties and methods in the HasTitles trait to customize the titles and subtitles displayed in the admin panel for your resources. By utilizing these options, you can tailor the text to better fit your application's terminology and improve the user experience.

### Available Properties and Related Methods
 * $title
 * getTitle()

The `$title` property allows you to set the main title of the resource. If no custom title is set, the `getTitle()` method will return the singular form of the model name. For example, if your model is named User, the default title will be User. To override the default title, set the `$title` property in your resource class. or, if you need to dynamically generate the title, you can override the `getTitle()` method. For example:

```php
protected static $title = 'User';

public static function getTitle(): string
{
    return 'Users';
}
```

### Using the Resource
Once you have generated and configured your resource class, Yali will automatically use it to display the corresponding model's data in the admin panel. You can access the resource's table and form views by navigating to the appropriate sections in the Yali admin panel.