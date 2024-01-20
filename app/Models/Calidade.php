<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calidade extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'calidades';

    protected $fillable = ['name','medida','precio'];
	
}
