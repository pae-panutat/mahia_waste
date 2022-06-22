<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
        ],
      
//======================================================================================================================
//======================================================================================================================
//===========================================================
        'smart_wash_air_con' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_wash_air_con'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//======================================================================================================================
//======================================================================================================================
//===========================================================
        'mysql' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'audit_cmu'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================       
//===========================================================
        'audit_cmu' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'audit_cmu'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],

//===========================================================       
//===========================================================
        'cmuElectric' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'cmuElectric'),
            'username' => env('DB_USERNAME', 'esm'),
            'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
            ],
//=========================================================== 
//===========================================================
        'smart_audit_sci' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_sci'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================    
//===========================================================
        'smart_audit_reg' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_reg'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//=========================================================== 
//===========================================================
        'smart_audit_edu' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_edu'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================         
//===========================================================
        'smart_audit_itsc' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_itsc'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_business' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_business'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_harvesting' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_harvesting'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================        
//===========================================================
        'smart_audit_sci_tecno' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_sci_tecno'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_agri_resources' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_agri_resources'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_society_research' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_society_research'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_society' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_society'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_economics' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_economics'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================        
//===========================================================
        'smart_audit_languages' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_languages'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_fine_art' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_fine_art'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_sci_health_suandok' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_sci_health_suandok'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_health_sci' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_health_sci'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_agri' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_agri'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_agro_indus' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_agro_indus'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_vet' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_vet'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_erdi' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_erdi'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_camt' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_camt'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_arc' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_arc'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_arc' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_arc'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_political_sci' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_political_sci'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_mass_com' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_mass_com'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_nurse' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_nurse'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================        
//===========================================================
        'smart_audit_human' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_human'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_eng' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_eng'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_human' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_human'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_dorm_diracted_mahea' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_dorm_diracted_mahea'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_saving' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_saving'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_small_animal_hospital' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_small_animal_hospital'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================        
//===========================================================
        'smart_audit_sathit' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_sathit'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//=========================================================== 
//===========================================================
        'smart_audit_sci_health_suansak' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_sci_health_suansak'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//=========================================================== 
//===========================================================
        'smart_audit_lib' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_lib'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//=========================================================== 
//===========================================================
        'smart_audit_edu_service' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_edu_service'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//=========================================================== 
//===========================================================
        'smart_audit_nana_digit' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_nana_digit'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//=========================================================== 
//===========================================================
        'smart_audit_suandok_dorm' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_suandok_dorm'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//=========================================================== 
//===========================================================
        'smart_audit_service_office' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_service_office'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_law' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_law'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_dent' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_dent'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_auditorium' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_auditorium'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_pharma' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_pharma'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_med_tech' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_med_tech'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_med' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_med'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_animal' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_animal'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_cmu_office' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_cmu_office'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================
        'smart_audit_dorm_office' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_dorm_office'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//===========================================================
//===========================================================        
        'smart_audit_agri_meahea' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_agri_meahea'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//=========================================================== 
//===========================================================
        'smart_audit_lanna_research_meahea' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_lanna_research_meahea'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//=========================================================== 
//===========================================================
        'smart_audit_dorm40_pink' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_dorm40_pink'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//=========================================================== 
//===========================================================
        'smart_audit_dorm_pink' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_dorm_pink'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//=========================================================== 
//===========================================================
        'smart_audit_management_resource_s1' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_management_resource_s1'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//=========================================================== 
//===========================================================
        'smart_audit_physicsEx' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_physicsEx'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//=========================================================== 
//===========================================================
        'smart_audit_technology_sci_service_office' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_technology_sci_service_office'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//=========================================================== 
//===========================================================
        'smart_audit_env_research' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_env_research'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//=========================================================== 
//===========================================================
        'smart_audit_sahakorn_cmu_shop' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_sahakorn_cmu_shop'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//=========================================================== 
//===========================================================
        'smart_audit_wastewater_treat_meahea' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_wastewater_treat_meahea'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//=========================================================== 
//===========================================================
        'smart_audit_agri_resources_meahea' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_agri_resources_meahea'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//=========================================================== 
//===========================================================
        'smart_audit_biomass' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_biomass'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//=========================================================== 
//===========================================================
        'smart_audit_student_dome' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_student_dome'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//=========================================================== 
//===========================================================
        'smart_audit_food_center' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_food_center'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//=========================================================== 
//===========================================================
        'smart_audit_calture_art' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'smart_audit_calture_art'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],
//=========================================================== 
//===========================================================
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//esm_db        
//===========================================================        
        'cmu_smart_city_sci' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_sci'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_reg' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_reg'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_edu' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_edu'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_itsc' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_itsc'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================        
//===========================================================        
        'cmu_smart_city_business' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_business'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_harvest_tech' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_harvest_tech'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_sci_develop_tech' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_sci_develop_tech'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_Agri_Resources' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_Agri_Resources'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_social_research' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_social_research'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_social' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_social'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_econ' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_econ'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_language' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_language'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_fine_arts' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_fine_arts'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_scihealt' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_scihealt'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_public_health' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_public_health'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_agriresearch' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_agriresearch'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_agro_industry' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_agro_industry'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================        
//===========================================================        
        'cmu_smart_city_veterinary_meahea' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_veterinary_meahea'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_erdi' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_erdi'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_camt' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_camt'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_ach' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_ach'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_posci' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_posci'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_masscom' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_masscom'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_nurse' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_nurse'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_human' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_human'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_eng' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_eng'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_vetsmall' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_vetsmall'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_satit' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_satit'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_sci_techno' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_sci_techno'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_lib' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_lib'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_graduate' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_graduate'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
        //===========================================================        
        'cmu_smart_city_ic' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_ic'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_uniserv' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_uniserv'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================        
//===========================================================        
        'cmu_smart_city_law' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_law'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_dent' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_dent'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_cmumeeting' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_cmumeeting'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_px' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_px'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_medicaltech' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_medicaltech'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_medicine' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_medicine'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_animal_lab_meahea' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_animal_lab_meahea'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_dorm' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_dorm'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_Agri_meahea' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_Agri_meahea'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_lanna_research_meahea' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_lanna_research_meahea'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_dorm40_pink' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_dorm40_pink'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_dorm_pink' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_dorm_pink'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_management_resource' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_management_resource'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_physicsEx' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_physicsEx'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_technology_sci_service' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_technology_sci_service'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_wastewater_treat' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_wastewater_treat'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_Agri_Resources_meahea' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_Agri_Resources_meahea'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================

//===========================================================        
        'cmu_smart_city_food_center' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_food_center'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================
//===========================================================        
        'cmu_smart_city_calture_art' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB15_DATABASE', 'cmu_smart_city_calture_art'),
            'username' => env('DB15_USERNAME', 'esm'),
            'password' => env('DB15_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],         
//===========================================================




























        'pgsql' => [
            'driver' => 'pgsql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer set of commands than a typical key-value systems
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => 'predis',

        'default' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => 0,
        ],

    ],

];
