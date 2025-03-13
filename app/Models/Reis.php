<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reis extends Model
{
    use HasFactory;

    protected $table = 'reizen'; // <-- Zorg ervoor dat dit er staat!

    protected $fillable = [
        'naam',
        'contactemail',
    ];
}
