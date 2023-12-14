<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Application extends Model
{
    use HasFactory;
   
    // protected $fillable = [
    //     'artical',
    //     'Affiliation',
    //     'Co_authors',
    //     'abstract_file_path',
    //     'figures_file_path',
    //     'SCHFS',
    // ];

    protected $fillable = ['user_id', 'artical', 'author','title',
     'Affiliation', 'Co_authors', 'abstract_file_path', 'figures_file_path', 'SCHFS',
     'title_or_position','link','conference','oral'
    ];
    // protected $casts = [
    //     'Co_authors' =>'array'
    // ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
