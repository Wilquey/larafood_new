<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'url',
        'price',
        'description',
    ];

    public function search($filter = null)
    {
        $results = $this
                    ->where('name', 'LIKE', "%{$filter}%")
                    ->orWhere('description', 'LIKE', "%{$filter}%")
                    ->paginate();

        return $results;
    }

}

// settings.json - anterior ;;;... agora está como         "editor.autoClosingBrackets": "always"
// "editor.defaultFormatter": "shufo.vscode-blade-formatter"

