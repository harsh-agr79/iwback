<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Company extends Model
{
    use HasFactory,Notifiable;

    protected $hidden = array('password', 'pannumber', 'emailverification' , 'adminverification', 'block' ,'pancertificate', 'extra1', 'extra2', 'extra3', 'extra4', 'extra5', 'extra6');
}
