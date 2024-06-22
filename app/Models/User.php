<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Domicilio;
use App\Models\DescuentoUsuario;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use App\Notifications\NotificacionBaseDeDatos;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'dni',
        'email',
        'password',
        'foto',
        'dinero_en_cuenta',
        'puntos_sportivo',
        'compras_realizadas',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return $this->administrator;
    }

    public function descuentoUsuario(){
        return $this->hasOne(DescuentoUsuario::class);
    }

    public function domicilio()
    {
        return $this->hasOne(Domicilio::class);
    }

    
    public function enviarNotificacion()
    {
        $user = User::find(1); // Encuentra al usuario al que deseas enviar la notificación

        $details = [
            'message' => 'Tienes una nueva notificación!',
            'url' => url('/notificaciones')
        ];

        $user->notify(new NotificacionBaseDeDatos($details));

        return response()->json(['message' => 'Notificación enviada!']);
    }
}
