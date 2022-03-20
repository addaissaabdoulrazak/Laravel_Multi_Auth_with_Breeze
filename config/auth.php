<?php

/**
 * Remarque:
 * ----------
 * De plus, le système(laravel) lui-même est conçu de manière à ce que vous puissiez l’étendre et brancher vos adaptateurs 
 * d’authentification personnalisés.
 * Avant d’aller de l’avant et de plonger dans la mise en œuvre de la protection d’authentification personnalisée,
 * nous allons commencer par une discussion sur les éléments de base du système d’authentification Laravel : 
 * les gardes(guard) et les fournisseurs.
 * 
 * NB:Le système d’authentification Laravel est composé de deux éléments à la base :les gardes et les fournisseurs.
 */
return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */
    /*------------------------------- Don't touch ------------------------------------------------  */
    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session"
    |
    */

    /*------------------------------------------- Modify this -----------------------------------------------------*/

    /* 
    * Definition: Vous pourriez penser à un garde comme un moyen de fournir la logique utilisée pour identifier
    * <<les utilisateurs "authentifiés.">>
    * 
    * Note: nous allons appliquer le même principe utiliser pour les utilisations(user) au niveau des administrateur
    * pour determiner nos different administrateur qui sont authentifiés
    */
    /**
     * implémentation un garde qui vérifie simplement la présence d’une chose spécifique dans les en-têtes de demande
     * et authentifie les utilisateurs(admin pour notre cas ici present) en fonction de cela.
     **/


    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        //<< guards >>(comment on authentifie un utilisateur, par exemple avec des session)
        'admin' => [
            'driver' => 'session',
            // table names from My database
            'provider' => 'admins',
        ],
    ],



    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    /**------------------------------------ Modify this is some providers ----------------------------------------------------------------------------------------------------------
     *
     *  Si le gardien(guard) définit la logique d’authentification, le fournisseur d’authentification est responsable 
     *  de la récupération de l’utilisateur à partir du stockage principal(après enregistrement dans la data base suite au formulaire register).
     *  Si le gardien(guard) exige que l’utilisateur soit validé par rapport au stockage principal(après enregistrement dans la data base suite au formulaire register ),
     *  l’implémentation de la récupération de l’utilisateur va dans le fournisseur d’authentification.
     *  
     *  
     -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/


    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        //<<Provider>>(comment on retrouve un utilisateur authentifié,par exemple avec Eloquent)
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expire time is the number of minutes that each reset token will be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */
    /*----------------------------------- Don't touch -----------------------------------------------------------*/
    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirmation
    | times out and the user is prompted to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => 10800,

];
