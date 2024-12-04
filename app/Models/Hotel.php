<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'city', 'nit', 'max_rooms'];

    public function accommodations()
    {
        return $this->hasMany(Accommodation::class);
    }
}

?>
