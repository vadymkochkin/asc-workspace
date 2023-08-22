<?php
namespace App\Models\RemoteDB;

use Illuminate\Database\Eloquent\Model;
class Account extends Model
{
  protected $connection = 'auth';
  protected $table      = 'account';

}
