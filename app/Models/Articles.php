<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Articles extends Model
{
    use HasFactory;

    protected $table = "articles";
    protected $fillable = ["title", "content", "createdby"];
}
