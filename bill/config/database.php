<?php

use Illuminate\Support\Str;

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
            'url' => env('DATABASE_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],

        'cmuPv' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '10.110.56.13'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'cmuPv'),
            'username' => env('DB_USERNAME', 'esm'),
            'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
        ],

		'pvtou' => [
		  'driver' => 'mysql',
		  'url' => env('DATABASE_URL'),
		  'host' => env('DB_HOST', '10.110.56.13'),
		  'port' => env('DB_PORT', '3306'),
		  'database' => env('DB_DATABASE', 'cmuElectric'),
		  'username' => env('DB_USERNAME', 'esm'),
		  'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
		  'unix_socket' => env('DB_SOCKET', ''),
		  'charset' => 'utf8mb4',
		  'collation' => 'utf8mb4_unicode_ci',
		  'prefix' => '',
		  'prefix_indexes' => true,
		  'strict' => false,
		],

	  'water' => [
		'driver' => 'mysql',
		'url' => env('DATABASE_URL'),
		'host' => env('DB_HOST', '202.28.244.143'),
		'port' => env('DB_PORT', '3306'),
		'database' => env('DB_DATABASE', 'cmuWater'),
		'username' => env('DB_USERNAME', 'esm'),
		'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
		'unix_socket' => env('DB_SOCKET', ''),
		'charset' => 'utf8mb4',
		'collation' => 'utf8mb4_unicode_ci',
		'prefix' => '',
		'prefix_indexes' => true,
		'strict' => false,
	  ],

	  'billpayment' => [
		'driver' => 'mysql',
		'url' => env('DATABASE_URL'),
		'host' => env('DB_HOST', '10.110.56.13'),
		'port' => env('DB_PORT', '3306'),
		'database' => env('DB_DATABASE', 'bill'),
		'username' => env('DB_USERNAME', 'esm'),
		'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
		'unix_socket' => env('DB_SOCKET', ''),
		'charset' => 'utf8mb4',
		'collation' => 'utf8mb4_unicode_ci',
		'prefix' => '',
		'prefix_indexes' => true,
		'strict' => false,
	  ],

        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'payment'),
            'username' => env('DB_USERNAME', 'esm'),
            'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'pv' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '10.110.56.13'),
            'port' => env('DB_PORT', '3306'),
            // 'database' => env('DB_DATABASE', 'forge'),
            // 'username' => env('DB_USERNAME', 'forge'),
            // 'password' => env('DB_PASSWORD', ''),
            'database' => env('DB_DATABASE', 'cmuElectric'),
            'username' => env('DB_USERNAME', 'esm'),
            'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],


        'pvProduceOffice' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'cmuElectric'),
            'username' => env('DB_USERNAME', 'esm'),
            'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

//==========================================================================================

      // 'cmu_smart_city_payment' => [
      //       'driver' => 'mysql',
      //       'host' => env('DB_HOST', '202.28.244.143'),
      //       'port' => env('DB_PORT', '3306'),
      //       'database' => env('DB44_DATABASE', 'cmu_smart_city_payment'),
      //       'username' => env('DB44_USERNAME', 'esm'),
      //       'password' => env('DB44_PASSWORD', 'vk0kipNgxuUpd'),
      //       'unix_socket' => env('DB_SOCKET', ''),
      //       'charset' => 'utf8mb4',
      //       'collation' => 'utf8mb4_unicode_ci',
      //       'prefix' => '',
      //       'strict' => false,
      //       'engine' => null,
      //   ],
//==========================================================================================

      'payment' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'cmu_smart_city_payment'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        // Additional options here
        'options'   => [PDO::ATTR_EMULATE_PREPARES => true]
      ],

	  'copayment' => [
		'driver' => 'mysql',
		'host' => env('DB_HOST', '202.28.244.143'),
		'port' => env('DB_PORT', '3306'),
		'database' => env('DB_DATABASE', 'co_payment'),
		'username' => env('DB_USERNAME', 'esm'),
		'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
		'unix_socket' => env('DB_SOCKET', ''),
		'charset' => 'utf8mb4',
		'collation' => 'utf8mb4_unicode_ci',
		'prefix' => '',
		'strict' => false,
		'engine' => null,
		// Additional options here
		'options'   => [PDO::ATTR_EMULATE_PREPARES => true]
	  ],

//==========================================================================================
      'bath' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'payment'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        // Additional options here
        'options'   => [PDO::ATTR_EMULATE_PREPARES => true]
      ],
//==========================================================================================

      'approvePV' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '10.110.56.13'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'payment'),
            'username' => env('DB_USERNAME', 'esm'),
            'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
  //==========================================================================================
	  'showMonitor' => [
		'driver' => 'mysql',
		'host' => env('DB_HOST', '10.110.56.13'),
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
		// Additional options here
		'options'   => [PDO::ATTR_EMULATE_PREPARES => true]
	  ],

//==========================================================================================
        'amr' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'cmu_amr'),
            'username' => env('DB_USERNAME', 'esm'),
            'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],

		'amrlocal' => [
		  'driver' => 'mysql',
		  'host' => env('DB_HOST', '10.110.56.12'),
		  'port' => env('DB_PORT', '3306'),
		  'database' => env('DB_DATABASE', 'cmuElectric'),
		  'username' => env('DB_USERNAME', 'esm'),
		  'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
		  'unix_socket' => env('DB_SOCKET', ''),
		  'charset' => 'utf8mb4',
		  'collation' => 'utf8mb4_unicode_ci',
		  'prefix' => '',
		  'strict' => true,
		  'engine' => null,
		],

	  //==========================================================================================
		'pvMap' => [
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

//==========================================================================================

        'mysqledmi' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'edmi_position'),
            'username' => env('DB_USERNAME', 'esm'),
            'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],

//==========================================================================================

        'co_payment' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'co_payment'),
            'username' => env('DB_USERNAME', 'esm'),
            'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],
//==========================================================================================

        'cmu_smart_city_angkaew_house' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'cmu_smart_city_angkaew_house'),
            'username' => env('DB_USERNAME', 'esm'),
            'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

        //---------------------------------
        'cmu_smart_city_human' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB18_DATABASE', 'cmu_smart_city_human'),
            'username' => env('DB18_USERNAME', 'esm'),
            'password' => env('DB18_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

        //---------------------------------
	  'cmu_smart_city_food_center' => [
		'driver' => 'mysql',
		'host' => env('DB_HOST', '202.28.244.143'),
		'port' => env('DB_PORT', '3306'),
		'database' => env('DB18_DATABASE', 'cmu_smart_city_food_center'),
		'username' => env('DB18_USERNAME', 'esm'),
		'password' => env('DB18_PASSWORD', 'vk0kipNgxuUpd'),
		'unix_socket' => env('DB_SOCKET', ''),
		'charset' => 'utf8mb4',
		'collation' => 'utf8mb4_unicode_ci',
		'prefix' => '',
		'strict' => false,
		'engine' => null,
	  ],

	  //---------------------------------

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

        //---------------------------------

        'cmu_smart_city_fine_arts' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB17_DATABASE', 'cmu_smart_city_fine_arts'),
            'username' => env('DB17_USERNAME', 'esm'),
            'password' => env('DB17_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

        //---------------------------------

        'cmu_smart_city_sripat_opd' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB41_DATABASE', 'cmu_smart_city_sripat_opd'),
            'username' => env('DB41_USERNAME', 'esm'),
            'password' => env('DB41_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

        //---------------------------------

        'cmu_smart_city_social' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB41_DATABASE', 'cmu_smart_city_social'),
            'username' => env('DB41_USERNAME', 'esm'),
            'password' => env('DB41_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

        //---------------------------------

        'cmu_smart_city_sci' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB38_DATABASE', 'cmu_smart_city_sci'),
            'username' => env('DB38_USERNAME', 'esm'),
            'password' => env('DB38_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

        //---------------------------------

        'cmu_smart_city_medicine' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB1_DATABASE', 'cmu_smart_city_medicine'),
            'username' => env('DB1_USERNAME', 'esm'),
            'password' => env('DB1_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

        //---------------------------------

        'cmu_smart_city_agriresearch' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB5_DATABASE', 'cmu_smart_city_agriresearch'),
            'username' => env('DB5_USERNAME', 'esm'),
            'password' => env('DB5_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

        //---------------------------------

        'cmu_smart_city_dent' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB12_DATABASE', 'cmu_smart_city_dent'),
            'username' => env('DB12_USERNAME', 'esm'),
            'password' => env('DB12_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

        //---------------------------------

        'cmu_smart_city_px' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB34_DATABASE', 'cmu_smart_city_px'),
            'username' => env('DB34_USERNAME', 'esm'),
            'password' => env('DB34_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

        //---------------------------------

        'cmu_smart_city_medicaltech' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB27_DATABASE', 'cmu_smart_city_medicaltech'),
            'username' => env('DB27_USERNAME', 'esm'),
            'password' => env('DB27_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

        //---------------------------------

        'cmu_smart_city_nurse' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB28_DATABASE', 'cmu_smart_city_nurse'),
            'username' => env('DB28_USERNAME', 'esm'),
            'password' => env('DB28_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_business' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB7_DATABASE', 'cmu_smart_city_business'),
            'username' => env('DB7_USERNAME', 'esm'),
            'password' => env('DB7_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_econ' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB14_DATABASE', 'cmu_smart_city_econ'),
            'username' => env('DB14_USERNAME', 'esm'),
            'password' => env('DB14_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_ach' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB2_DATABASE', 'cmu_smart_city_ach'),
            'username' => env('DB2_USERNAME', 'esm'),
            'password' => env('DB2_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],
    //---------------------------------

        'cmu_smart_city_masscom' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB26_DATABASE', 'cmu_smart_city_masscom'),
            'username' => env('DB26_USERNAME', 'esm'),
            'password' => env('DB26_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_posci' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB32_DATABASE', 'cmu_smart_city_posci'),
            'username' => env('DB32_USERNAME', 'esm'),
            'password' => env('DB32_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_law' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB22_DATABASE', 'cmu_smart_city_law'),
            'username' => env('DB22_USERNAME', 'esm'),
            'password' => env('DB22_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_camt' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB9_DATABASE', 'cmu_smart_city_camt'),
            'username' => env('DB9_USERNAME', 'esm'),
            'password' => env('DB9_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_graduate' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB18_DATABASE', 'cmu_smart_city_graduate'),
            'username' => env('DB18_USERNAME', 'esm'),
            'password' => env('DB18_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_language' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB20_DATABASE', 'cmu_smart_city_language'),
            'username' => env('DB20_USERNAME', 'esm'),
            'password' => env('DB20_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_sci_techno' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB39_DATABASE', 'cmu_smart_city_sci_techno'),
            'username' => env('DB39_USERNAME', 'esm'),
            'password' => env('DB39_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_lanna_research_center' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB1_DATABASE', 'cmu_smart_city_lanna_research_center'),
            'username' => env('DB1_USERNAME', 'esm'),
            'password' => env('DB1_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_lib' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB23_DATABASE', 'cmu_smart_city_lib'),
            'username' => env('DB23_USERNAME', 'esm'),
            'password' => env('DB23_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_social_research' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB1_DATABASE', 'cmu_smart_city_social_research'),
            'username' => env('DB1_USERNAME', 'esm'),
            'password' => env('DB1_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_scihealt' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB40_DATABASE', 'cmu_smart_city_scihealt'),
            'username' => env('DB40_USERNAME', 'esm'),
            'password' => env('DB40_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_calture_art' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB1_DATABASE', 'cmu_smart_city_calture_art'),
            'username' => env('DB1_USERNAME', 'esm'),
            'password' => env('DB1_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_sci_develop_tech' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB1_DATABASE', 'cmu_smart_city_sci_develop_tech'),
            'username' => env('DB1_USERNAME', 'esm'),
            'password' => env('DB1_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_itsc' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB19_DATABASE', 'cmu_smart_city_itsc'),
            'username' => env('DB19_USERNAME', 'esm'),
            'password' => env('DB19_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_dorm40_pink' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB1_DATABASE', 'cmu_smart_city_dorm40_pink'),
            'username' => env('DB1_USERNAME', 'esm'),
            'password' => env('DB1_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_dorm_pink' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB1_DATABASE', 'cmu_smart_city_dorm_pink'),
            'username' => env('DB1_USERNAME', 'esm'),
            'password' => env('DB1_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_dorm' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB13_DATABASE', 'cmu_smart_city_dorm'),
            'username' => env('DB13_USERNAME', 'esm'),
            'password' => env('DB13_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_vetsmall' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB44_DATABASE', 'cmu_smart_city_vetsmall'),
            'username' => env('DB44_USERNAME', 'esm'),
            'password' => env('DB44_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_reg' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB35_DATABASE', 'cmu_smart_city_reg'),
            'username' => env('DB35_USERNAME', 'esm'),
            'password' => env('DB35_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_management_resource' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB1_DATABASE', 'cmu_smart_city_management_resource'),
            'username' => env('DB1_USERNAME', 'esm'),
            'password' => env('DB1_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_cmumeeting' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB11_DATABASE', 'cmu_smart_city_cmumeeting'),
            'username' => env('DB11_USERNAME', 'esm'),
            'password' => env('DB11_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_uniserv' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB43_DATABASE', 'cmu_smart_city_uniserv'),
            'username' => env('DB43_USERNAME', 'esm'),
            'password' => env('DB43_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_wastewater_treat' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB1_DATABASE', 'cmu_smart_city_wastewater_treat'),
            'username' => env('DB1_USERNAME', 'esm'),
            'password' => env('DB1_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_calture_art_center' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB1_DATABASE', 'cmu_smart_city_calture_art_center'),
            'username' => env('DB1_USERNAME', 'esm'),
            'password' => env('DB1_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_public_health' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB1_DATABASE', 'cmu_smart_city_public_health'),
            'username' => env('DB1_USERNAME', 'esm'),
            'password' => env('DB1_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_physicsEx' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB1_DATABASE', 'cmu_smart_city_physicsEx'),
            'username' => env('DB1_USERNAME', 'esm'),
            'password' => env('DB1_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_Agri_Resources_meahea' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'cmu_smart_city_Agri_Resources_meahea'),
            'username' => env('DB_USERNAME', 'esm'),
            'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_Agri_Resources' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB1_DATABASE', 'cmu_smart_city_Agri_Resources'),
            'username' => env('DB1_USERNAME', 'esm'),
            'password' => env('DB1_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_harvest_tech' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB1_DATABASE', 'cmu_smart_city_harvest_tech'),
            'username' => env('DB1_USERNAME', 'esm'),
            'password' => env('DB1_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_technology_sci_service' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB1_DATABASE', 'cmu_smart_city_technology_sci_service'),
            'username' => env('DB1_USERNAME', 'esm'),
            'password' => env('DB1_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_royal_project' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB1_DATABASE', 'cmu_smart_city_royal_project'),
            'username' => env('DB1_USERNAME', 'esm'),
            'password' => env('DB1_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_veterinary_meahea' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB1_DATABASE', 'cmu_smart_city_veterinary_meahea'),
            'username' => env('DB1_USERNAME', 'esm'),
            'password' => env('DB1_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_agro_industry' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB1_DATABASE', 'cmu_smart_city_agro_industry'),
            'username' => env('DB1_USERNAME', 'esm'),
            'password' => env('DB1_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_Agri_meahea' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB1_DATABASE', 'cmu_smart_city_Agro_meahea'),
            'username' => env('DB1_USERNAME', 'esm'),
            'password' => env('DB1_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_innovation_food' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB1_DATABASE', 'cmu_smart_city_innovation_food'),
            'username' => env('DB1_USERNAME', 'esm'),
            'password' => env('DB1_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_animal_lab_meahea' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB1_DATABASE', 'cmu_smart_city_animal_lab_meahea'),
            'username' => env('DB1_USERNAME', 'esm'),
            'password' => env('DB1_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_dorm_meahea' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB1_DATABASE', 'cmu_smart_city_dorm_meahea'),
            'username' => env('DB1_USERNAME', 'esm'),
            'password' => env('DB1_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_cdce' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'cmu_smart_city_cdce'),
            'username' => env('DB_USERNAME', 'esm'),
            'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_socialenv' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'cmu_smart_city_socialenv'),
            'username' => env('DB_USERNAME', 'esm'),
            'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_lanna_research_meahea' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'cmu_smart_city_lanna_research_meahea'),
            'username' => env('DB_USERNAME', 'esm'),
            'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_satit' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB2_DATABASE', 'cmu_smart_city_satit'),
            'username' => env('DB2_USERNAME', 'esm'),
            'password' => env('DB2_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_ic' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB1_DATABASE', 'cmu_smart_city_ic'),
            'username' => env('DB1_USERNAME', 'esm'),
            'password' => env('DB1_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_step_tou' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'cmu_smart_city_step_tou'),
            'username' => env('DB_USERNAME', 'esm'),
            'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

	  'cmu_smart_city_erdi' => [
		'driver' => 'mysql',
		'host' => env('DB_HOST', '202.28.244.143'),
		'port' => env('DB_PORT', '3306'),
		'database' => env('DB_DATABASE', 'cmu_smart_city_erdi'),
		'username' => env('DB_USERNAME', 'esm'),
		'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
		'unix_socket' => env('DB_SOCKET', ''),
		'charset' => 'utf8mb4',
		'collation' => 'utf8mb4_unicode_ci',
		'prefix' => '',
		'strict' => false,
		'engine' => null,
		// Additional options here
		'options'   => [PDO::ATTR_EMULATE_PREPARES => true,]
	  ],

    //---------------------------------

	  'cmu_smart_city_eng' => [
		'driver' => 'mysql',
		'host' => env('DB_HOST', '202.28.244.143'),
		'port' => env('DB_PORT', '3306'),
		'database' => env('DB_DATABASE', 'cmu_smart_city_eng'),
		'username' => env('DB_USERNAME', 'esm'),
		'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
		'unix_socket' => env('DB_SOCKET', ''),
		'charset' => 'utf8mb4',
		'collation' => 'utf8mb4_unicode_ci',
		'prefix' => '',
		'strict' => false,
		'engine' => null,
		// Additional options here
		'options'   => [PDO::ATTR_EMULATE_PREPARES => true,]
	  ],

    //---------------------------------

        'cmu_smart_city_personal_house_cmu' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB1_DATABASE', 'cmu_smart_city_personal_house_cmu'),
            'username' => env('DB1_USERNAME', 'esm'),
            'password' => env('DB1_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],
  
  
	  //---------------------------------
	  'cmu_smart_city_public_plan' => [
		'driver' => 'mysql',
		'host' => env('DB_HOST', '202.28.244.143'),
		'port' => env('DB_PORT', '3306'),
		'database' => env('DB18_DATABASE', 'cmu_smart_city_public_plan'),
		'username' => env('DB18_USERNAME', 'esm'),
		'password' => env('DB18_PASSWORD', 'vk0kipNgxuUpd'),
		'unix_socket' => env('DB_SOCKET', ''),
		'charset' => 'utf8mb4',
		'collation' => 'utf8mb4_unicode_ci',
		'prefix' => '',
		'strict' => false,
		'engine' => null,
	  ],
	  
    //---------------------------------
	  
	  

        'cmu_smart_city_personal_house_meahea' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB1_DATABASE', 'cmu_smart_city_personal_house_meahea'),
            'username' => env('DB1_USERNAME', 'esm'),
            'password' => env('DB1_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_central' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '202.28.244.143'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'cmu_smart_city_central'),
        'username' => env('DB_USERNAME', 'esm'),
        'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => null,
        ],

    //---------------------------------

        'cmu_smart_city_central_meahea' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '202.28.244.143'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'cmu_smart_city_central_meahea'),
            'username' => env('DB_USERNAME', 'esm'),
            'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],




//==========================================================================================

      'inverter' => [
		'driver' => 'mysql',
		'host' => env('DB_HOST', '202.28.244.143'),
		'port' => env('DB_PORT', '3306'),
		'database' => env('DB_DATABASE', 'payment_inverter'),
		'username' => env('DB_USERNAME', 'esm'),
		'password' => env('DB_PASSWORD', 'vk0kipNgxuUpd'),
		'unix_socket' => env('DB_SOCKET', ''),
		'charset' => 'utf8mb4',
		'collation' => 'utf8mb4_unicode_ci',
		'prefix' => '',
		'strict' => false,
		'engine' => null,
		// Additional options here
		'options'   => [PDO::ATTR_EMULATE_PREPARES => true, ]
	  ],

        'pgsql' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
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
    | provides a richer body of commands than a typical key-value system
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_database_'),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
        ],

    ],

];
