<?php

namespace Raakkan\Yali\Models;

use Illuminate\Database\Eloquent\Model;
use Raakkan\Yali\Core\Concerns\Database\HasTranslations;

class YaliModel extends Model
{
    use HasTranslations;
}
