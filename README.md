# FlashAlert
Laravel for Bootstrap4 Alert
## Requirement
php ^7.1.3  
laravel/framework 5.6.*  
BootStrap4.1
## Installation
### composer
`composer require albert-miyahira/flash-alert`  
### Artisan publish
`php artisan config:clear`  
`php artisan vendor:publish --provider="AlbertMiyahira\FlashAlert\FlashAlertServiceProvider"` 
/resources/lang/en/flash_msg.php  
/resources/lang/ja/flash_msg.php (example)  
/resources/views/vendor/flash_alert/flash_alert.blade.php
## Configuration
add your parent controller or controller in __construct()  
`Blade::component('vendor.flash_alert.flash_alert', 'flashAlert');`  
example in parent controller
```
<?php

    namespace App\Http\Controllers;

    use Illuminate\Foundation\Bus\DispatchesJobs;
    use Illuminate\Routing\Controller as BaseController;
    use Illuminate\Foundation\Validation\ValidatesRequests;
    use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
+    use Illuminate\Support\Facades\Blade;

    class Controller extends BaseController
    {

        use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

        public function __construct()
        {
+            Blade::component('vendor.flash_alert.flash_alert', 'flashAlert');
        }
    }
```
call parent::__construct() 

```
<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
   
    class UserController extends Controller
    {
        public function __construct()
        {
+            parent::__construct();
        }
```
add your layout.blade.php or base blade 
```
~
~
<body>
+   @include('vendor.flash_alert.flash_alert')
    <main role="main" class="container">
~
~
```
write flash message  
example
``` 
resources/lang/xxx/flash_msg.php  
<?php
/* Flash Message */
return [
    'flash_title' => [
        'success' => 'Success :',
        'info' => 'Info :',
        'warning' => 'Warning :',
        'danger' => 'Error :',
    ],
    'users' => [
        'register' => '%s様の会員情報を登録しました。',
        'update' => '%s様の会員情報を更新しました。',
        'delete' => '%s様の退会処理を行いました。',
    ],
    'error' => [
        'input' => '入力に誤りがあります。'
    ]
];
```

## Usage
```
->with([
    config('flash_alert.TYPE_KEY')  => 'primary | secondary | success | danger | warning | info | light | dark',
    config('flash_alert.TITLE_KEY') => trans('flash_msg.flash_title.success'),
    config('flash_alert.MSG_KEY')   => '<a href="/">msg</a>',
    // option
    // use html tag config('flash_alert.MSG_KEY') => '<strong class="xxx">title</strong>',
    config('flash_alert.TITLE_ESCAPE_KEY') => true,
    // use html tag config('flash_alert.MSG_KEY') => '<a href="/">msg</a>',
    config('flash_alert.MSG_ESCAPE_KEY')  => true,
    config('flash_alert.ALERT_CLASS_KEY') => 'primary | secondary | success | danger | warning | info | light | dark'
])
```
example
```
in Controller

  public function test()
        {
            // redirect
            return redirect(route('users.index'))->with([
                config('flash_alert.TYPE_KEY') => 'success',
                config('flash_alert.MSG_KEY')  => sprintf(trans('flash_msg.users.delete'), $userName)
            ]);
            // view
            return view('users.index')->with([
                config('flash_alert.TYPE_KEY') => 'success',
                config('flash_alert.MSG_KEY')  => sprintf(trans('flash_msg.users.delete'), $userName)
            ]);
        }
```
```
in FormRequest

 public function withValidator($validator)
        {
            $validator->after(function ($validator) {
                if (!$validator->errors()->isEmpty()) {
                    $validator->errors()->add(
                        config('flash_alert.MSG_KEY'), 
                        trans('flash_msg.error.input')
                    );
                }
            });
        }
```
change session key  
config/flash_alert.php  
```
<?php
return [
    'MSG_KEY' => 'FLASH_MSG',
    'TYPE_KEY' => 'FLASH_TYPE',
    'TITLE_KEY' => 'FLASH_TITLE',
    /* options */
    'MSG_NOT_ESCAPE_KEY' => 'false',// default
    'TITLE_NOT_ESCAPE_KEY' => 'false',// default
    // bootstrap alert class
    'ALERT_CLASS_KEY' => 'FLASH_CLASS',
];
```
