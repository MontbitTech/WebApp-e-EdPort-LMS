<?php return array (
  'app' => 
  array (
    'name' => 'Local-lms-schooltimes-d',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://localhost',
    'asset_url' => NULL,
    'timezone' => 'Asia/Kolkata',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'key' => 'base64:G00niuYKEg8+OLvaSfWumJmhDGFJG2HYu168Ej8PoYw=',
    'cipher' => 'AES-256-CBC',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'Tzsk\\Sms\\Provider\\SmsServiceProvider',
      23 => 'Barryvdh\\DomPDF\\ServiceProvider',
      24 => 'LaraCrud\\LaraCrudServiceProvider',
      25 => 'App\\Providers\\AppServiceProvider',
      26 => 'App\\Providers\\AuthServiceProvider',
      27 => 'App\\Providers\\EventServiceProvider',
      28 => 'App\\Providers\\RouteServiceProvider',
      29 => 'Laravel\\Passport\\PassportServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Arr' => 'Illuminate\\Support\\Arr',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Http' => 'Illuminate\\Support\\Facades\\Http',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'Str' => 'Illuminate\\Support\\Str',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Sms' => 'Tzsk\\Sms\\Facade\\Sms',
      'PDF' => 'Barryvdh\\DomPDF\\Facade',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'admin' => 
      array (
        'driver' => 'session',
        'provider' => 'admin',
      ),
      'api' => 
      array (
        'driver' => 'passport',
        'provider' => 'users',
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\User',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
        'throttle' => 60,
      ),
    ),
    'password_timeout' => 10800,
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => NULL,
        'secret' => NULL,
        'app_id' => NULL,
        'options' => 
        array (
          'cluster' => NULL,
          'useTLS' => true,
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
        'serialize' => false,
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => '/Users/krtrth/Sites/e-EdPort/storage/framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
      ),
      'dynamodb' => 
      array (
        'driver' => 'dynamodb',
        'key' => NULL,
        'secret' => NULL,
        'region' => 'us-east-1',
        'table' => 'cache',
        'endpoint' => NULL,
      ),
    ),
    'prefix' => 'local_lms_schooltimes_d_cache',
  ),
  'constants' => 
  array (
    'WebMessageCode' => 
    array (
      100 => 'Teacher added successfully',
      101 => 'Teacher updated successfully',
      102 => 'Teacher deleted successfully',
      103 => 'Only %s file(s) can be imported',
      104 => 'File is blank!',
      105 => 'Header missing  %s',
      106 => 'Data Missing for line %s',
      107 => 'Password changed successfully.',
      108 => 'Password not updated.',
      109 => 'Current Password does not match.',
      111 => 'Help ticket generated successfully.',
      112 => 'Updated Successfully.',
      113 => 'Notification id missing.',
      114 => 'Student number empty.',
      115 => 'Student Notified Successfully.',
      116 => 'Message Send Successfully.',
      117 => 'Error Code %s, Please contact Support',
      118 => 'Error! You don\'t have permission, Please contact Support',
      119 => 'Something went wrong, Please try again.',
      120 => 'Class and Section not found',
      121 => 'Something went wrong!',
      122 => 'Timetable imported successfully!',
      123 => 'Class %s successfully',
      124 => 'Profile Updated Successfully.',
      125 => 'Class Created Successfully.',
      126 => 'Teacher not found.',
      127 => 'Class Course Created Successfully.',
      128 => 'Student details missing.',
      129 => 'Student details wrongly updated.',
      130 => 'Student added successfully',
      131 => 'Topic Updated successfully',
      132 => 'Email or Phone is required!!',
      133 => 'Invalid Phone no!!',
      134 => 'Help Ticket Status Updated.',
      135 => 'Assignment Successfully Assign.',
      136 => 'Issue while uploading students file, if issue persists, contact Admin/Support',
      137 => 'CSV file Header/(1st line) mismatch!!, check the file format!!',
      138 => 'Student number or Email empty.',
      139 => 'Student deleted successfully',
    ),
    'Email' => 
    array (
      101 => '',
    ),
  ),
  'cors' => 
  array (
    'paths' => 
    array (
      0 => 'api/*',
    ),
    'allowed_methods' => 
    array (
      0 => '*',
    ),
    'allowed_origins' => 
    array (
      0 => '*',
    ),
    'allowed_origins_patterns' => 
    array (
    ),
    'allowed_headers' => 
    array (
      0 => '*',
    ),
    'exposed_headers' => 
    array (
    ),
    'max_age' => 0,
    'supports_credentials' => false,
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'url' => NULL,
        'database' => 'elearn',
        'prefix' => '',
        'foreign_key_constraints' => true,
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'elearn',
        'username' => 'root',
        'password' => 'root@1234',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
        'options' => 
        array (
        ),
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'elearn',
        'username' => 'root',
        'password' => 'root@1234',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'elearn',
        'username' => 'root',
        'password' => 'root@1234',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'phpredis',
      'options' => 
      array (
        'cluster' => 'redis',
        'prefix' => 'local_lms_schooltimes_d_database_',
      ),
      'default' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => '0',
      ),
      'cache' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => '1',
      ),
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => '/Users/krtrth/Sites/e-EdPort/storage/app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => '/Users/krtrth/Sites/e-EdPort/storage/app/public',
        'url' => 'http://localhost/storage',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => NULL,
        'secret' => NULL,
        'region' => NULL,
        'bucket' => NULL,
        'url' => NULL,
        'endpoint' => NULL,
      ),
    ),
    'links' => 
    array (
      '/Users/krtrth/Sites/e-EdPort/public/storage' => '/Users/krtrth/Sites/e-EdPort/storage/app/public',
    ),
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 10,
    ),
    'argon' => 
    array (
      'memory' => 1024,
      'threads' => 2,
      'time' => 2,
    ),
  ),
  'laracrud' => 
  array (
    'rootNamespace' => 'App',
    'model' => 
    array (
      'namespace' => 'Models',
      'propertyDefiner' => true,
      'methodDefiner' => false,
      'guarded' => false,
      'fillable' => true,
      'casts' => false,
      'scopes' => false,
      'mutators' => false,
      'accessors' => false,
      'relations' => 
      array (
      ),
      'protectedColumns' => 
      array (
        0 => 'id',
        1 => 'created_at',
        2 => 'updated_at',
        3 => 'deleted_at',
        4 => 'remember_token',
        5 => 'password',
      ),
      'getDateFormat' => 
      array (
        'time' => 'h:i A',
        'date' => 'm/d/Y',
        'datetime' => 'm/d/Y h:i A',
        'timestamp' => 'm/d/Y h:i A',
      ),
      'setDateFormat' => 
      array (
        'time' => 'H:i:s',
        'date' => 'Y-m-d',
        'datetime' => 'Y-m-d H:i:s',
        'timestamp' => 'Y-m-d H:i:s',
      ),
      'map' => 
      array (
      ),
    ),
    'factory' => 
    array (
      'path' => '/Users/krtrth/Sites/e-EdPort/database/factories',
      'suffix' => 'Factory',
    ),
    'view' => 
    array (
      'titles' => 
      array (
      ),
      'path' => '/Users/krtrth/Sites/e-EdPort/resources/views',
      'layout' => 'layouts.app',
      'bootstrap' => '4',
      'namespace' => false,
      'ignore' => 
      array (
      ),
      'page' => 
      array (
        'path' => 'pages',
        'index' => 
        array (
          'name' => 'index',
          'type' => 'table',
        ),
        'create' => 
        array (
          'name' => 'create',
        ),
        'edit' => 
        array (
          'name' => 'edit',
        ),
        'show' => 
        array (
          'name' => 'show',
        ),
      ),
    ),
    'controller' => 
    array (
      'namespace' => 'Http\\Controllers',
      'apiNamespace' => 'Http\\Controllers\\Api',
      'documentation' => false,
      'classSuffix' => 'Controller',
    ),
    'request' => 
    array (
      'namespace' => 'Http\\Requests',
      'apiNamespace' => 'Http\\Requests\\Api',
      'classSuffix' => 'Request',
    ),
    'policy' => 
    array (
      'namespace' => 'Policies',
      'classSuffix' => 'Policy',
    ),
    'route' => 
    array (
      'web' => 'routes/web.php',
      'api' => 'routes/api.php',
      'prefix' => false,
    ),
    'transformer' => 
    array (
      'namespace' => 'Transformers',
      'classSuffix' => 'Transformer',
    ),
    'test' => 
    array (
      'feature' => 
      array (
        'namespace' => 'Tests\\Feature',
        'suffix' => 'Test',
      ),
    ),
    'package' => 
    array (
      'path' => '/Users/krtrth/Sites/e-EdPort/packages',
    ),
    'migrationPath' => 'database/migrations/',
    'pivotTables' => 
    array (
    ),
    'image' => 
    array (
      'columns' => 
      array (
      ),
      'disk' => 'public',
    ),
    'informationSchema' => 'INFORMATION_SCHEMA',
  ),
  'logging' => 
  array (
    'default' => 'stack',
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'single',
        ),
        'ignore_exceptions' => false,
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => '/Users/krtrth/Sites/e-EdPort/storage/logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => '/Users/krtrth/Sites/e-EdPort/storage/logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'critical',
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'formatter' => NULL,
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
      'null' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\NullHandler',
      ),
      'emergency' => 
      array (
        'path' => '/Users/krtrth/Sites/e-EdPort/storage/logs/laravel.log',
      ),
    ),
  ),
  'mail' => 
  array (
    'default' => 'smtp',
    'mailers' => 
    array (
      'smtp' => 
      array (
        'transport' => 'smtp',
        'host' => 'smtp.gmail.com',
        'port' => '587',
        'encryption' => 'tls',
        'username' => 'developer@schooltimes-d.ca',
        'password' => 'e5MQy=Gyw2',
        'timeout' => NULL,
      ),
      'ses' => 
      array (
        'transport' => 'ses',
      ),
      'mailgun' => 
      array (
        'transport' => 'mailgun',
      ),
      'postmark' => 
      array (
        'transport' => 'postmark',
      ),
      'sendmail' => 
      array (
        'transport' => 'sendmail',
        'path' => '/usr/sbin/sendmail -bs',
      ),
      'log' => 
      array (
        'transport' => 'log',
        'channel' => NULL,
      ),
      'array' => 
      array (
        'transport' => 'array',
      ),
    ),
    'from' => 
    array (
      'address' => 'hello@example.com',
      'name' => 'Example',
    ),
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => '/Users/krtrth/Sites/e-EdPort/resources/views/vendor/mail',
      ),
    ),
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => 0,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => NULL,
        'secret' => NULL,
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'suffix' => NULL,
        'region' => 'us-east-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
      ),
    ),
    'failed' => 
    array (
      'driver' => 'database',
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
      'endpoint' => 'api.mailgun.net',
    ),
    'postmark' => 
    array (
      'token' => NULL,
    ),
    'ses' => 
    array (
      'key' => NULL,
      'secret' => NULL,
      'region' => 'us-east-1',
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => '120',
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => '/Users/krtrth/Sites/e-EdPort/storage/framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'local_lms_schooltimes_d_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => NULL,
    'http_only' => true,
    'same_site' => 'lax',
  ),
  'sms' => 
  array (
    'default' => 'textlocal',
    'drivers' => 
    array (
      'sns' => 
      array (
        'key' => 'Your AWS SNS Access Key',
        'secret' => 'Your AWS SNS Secret Key',
        'region' => 'Your AWS SNS Region',
        'sender' => 'Your AWS SNS Sender ID',
        'type' => 'Tansactional',
      ),
      'textlocal' => 
      array (
        'url' => 'http://api.textlocal.in/send/',
        'username' => 'developer@montbit.tech',
        'hash' => '3d7a9f3f9bc31209a8ee264fad6b9c7a3ed7a97e096a72281307d1df28a704b3',
        'sender' => 'ELEARN',
      ),
      'nexmo' => 
      array (
        'key' => 'Your Nexmo API Key',
        'secret' => 'Your Nexmo API Secret',
        'from' => 'Your Nexmo From Number',
      ),
      'twilio' => 
      array (
        'sid' => 'Your SID',
        'token' => 'Your Token',
        'from' => 'Your Default From Number',
      ),
      'clockwork' => 
      array (
        'key' => 'Your clockwork API Key',
      ),
      'linkmobility' => 
      array (
        'url' => 'http://simple.pswin.com',
        'username' => 'Your Username',
        'password' => 'Your Password',
        'sender' => 'Sender name',
      ),
      'melipayamak' => 
      array (
        'username' => 'Your Username',
        'password' => 'Your Password',
        'from' => 'Your Default From Number',
        'flash' => false,
      ),
      'kavenegar' => 
      array (
        'apiKey' => 'Your Api Key',
        'from' => 'Your Default From Number',
      ),
      'smsir' => 
      array (
        'url' => 'https://ws.sms.ir/',
        'apiKey' => 'Your Api Key',
        'secretKey' => 'Your Secret Key',
        'from' => 'Your Default From Number',
      ),
      'tsms' => 
      array (
        'url' => 'http://www.tsms.ir/soapWSDL/?wsdl',
        'username' => 'Your Username',
        'password' => 'Your Password',
        'from' => 'Your Default From Number',
      ),
      'farazsms' => 
      array (
        'url' => '37.130.202.188/services.jspd',
        'username' => 'Your Username',
        'password' => 'Your Password',
        'from' => 'Your Default From Number',
      ),
      'smsgatewayme' => 
      array (
        'apiToken' => 'Your Api Token',
        'from' => 'Your Default Device ID',
      ),
    ),
    'map' => 
    array (
      'sns' => 'Tzsk\\Sms\\Drivers\\Sns',
      'textlocal' => 'Tzsk\\Sms\\Drivers\\Textlocal',
      'nexmo' => 'Tzsk\\Sms\\Drivers\\Nexmo',
      'twilio' => 'Tzsk\\Sms\\Drivers\\Twilio',
      'clockwork' => 'Tzsk\\Sms\\Drivers\\Clockwork',
      'linkmobility' => 'Tzsk\\Sms\\Drivers\\Linkmobility',
      'melipayamak' => 'Tzsk\\Sms\\Drivers\\Melipayamak',
      'kavenegar' => 'Tzsk\\Sms\\Drivers\\Kavenegar',
      'smsir' => 'Tzsk\\Sms\\Drivers\\Smsir',
      'tsms' => 'Tzsk\\Sms\\Drivers\\Tsms',
      'farazsms' => 'Tzsk\\Sms\\Drivers\\Farazsms',
    ),
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => '/Users/krtrth/Sites/e-EdPort/resources/views',
    ),
    'compiled' => '/Users/krtrth/Sites/e-EdPort/storage/framework/views',
  ),
  'dompdf' => 
  array (
    'show_warnings' => false,
    'orientation' => 'portrait',
    'defines' => 
    array (
      'font_dir' => '/Users/krtrth/Sites/e-EdPort/storage/fonts/',
      'font_cache' => '/Users/krtrth/Sites/e-EdPort/storage/fonts/',
      'temp_dir' => '/var/folders/rk/7v081d352c7_mdf76c1qqwf40000gn/T',
      'chroot' => '/Users/krtrth/Sites/e-EdPort',
      'enable_font_subsetting' => false,
      'pdf_backend' => 'CPDF',
      'default_media_type' => 'screen',
      'default_paper_size' => 'a4',
      'default_font' => 'serif',
      'dpi' => 96,
      'enable_php' => false,
      'enable_javascript' => true,
      'enable_remote' => true,
      'font_height_ratio' => 1.1,
      'enable_html5_parser' => false,
    ),
  ),
  'flare' => 
  array (
    'key' => NULL,
    'reporting' => 
    array (
      'anonymize_ips' => true,
      'collect_git_information' => false,
      'report_queries' => true,
      'maximum_number_of_collected_queries' => 200,
      'report_query_bindings' => true,
      'report_view_data' => true,
      'grouping_type' => NULL,
    ),
    'send_logs_as_events' => true,
  ),
  'ignition' => 
  array (
    'editor' => 'phpstorm',
    'theme' => 'light',
    'enable_share_button' => true,
    'register_commands' => false,
    'ignored_solution_providers' => 
    array (
      0 => 'Facade\\Ignition\\SolutionProviders\\MissingPackageSolutionProvider',
    ),
    'enable_runnable_solutions' => NULL,
    'remote_sites_path' => '',
    'local_sites_path' => '',
    'housekeeping_endpoint_prefix' => '_ignition',
  ),
  'passport' => 
  array (
    'private_key' => NULL,
    'public_key' => NULL,
    'client_uuids' => false,
    'personal_access_client' => 
    array (
      'id' => NULL,
      'secret' => NULL,
    ),
    'storage' => 
    array (
      'database' => 
      array (
        'connection' => 'mysql',
      ),
    ),
  ),
  'trustedproxy' => 
  array (
    'proxies' => NULL,
    'headers' => 30,
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'alias' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
);
