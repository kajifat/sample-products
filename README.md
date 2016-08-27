# sample-products
Laravel 5 package to adding and editing products. Not for public use (just test).

    Для установки пакета подключите сервис-провайдер. В файле config/app.php добавте
Kajifat/SampleProducts/SampleProductsServiceProvider::class в массив $providers.

    Также необходимо подключить политики пакета. В файле app/Providers/AuthServiceProvider добавте
'Kajifat\SampleProducts\Product' => 'Kajifat\SampleProducts\ProductPolicy' в массив $policies.

    Для корректной работы политик необходимо определить app('current_user_type'). Это можно сделать в файле
app/Providers/AppServiceProvider. Добавте в функцию register() следующие строки

    $this->app->bind('current_user_type', function(){
                return 'manager';
            });
