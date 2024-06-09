<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'notebook_id', 
        'title', 
        'content'];

    public function notebook()
    {
        return $this->belongsTo(Notebook::class);
    }
}

