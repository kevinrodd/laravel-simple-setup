<?php

namespace rowo\LaravelSimpleSetup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;


class SetupController extends Controller
{


    protected function changeEnv($data = array()){
        if(count($data) > 0){

            // Read .env-file
            $env = file_get_contents(base_path() . '/.env');

            // Split string on every " " and write into array
            $env = preg_split('/(\r\n|\n|\r)/', $env);;

            // Loop through given data
            foreach((array)$data as $key => $value){

                // Loop through .env-data
                foreach($env as $env_key => $env_value){

                    // Turn the value into an array and stop after the first split
                    // So it's not possible to split e.g. the App-Key by accident
                    $entry = explode("=", $env_value, 2);

                    // Check, if new key fits the actual .env-key
                    if($entry[0] == $key){
                        // If yes, overwrite it with the new one
                        if($value !== null)
                        {

                            $env[$env_key] = $key . "=" . $value;
                        }
                    } else {
                        // If not, keep the old one
                        $env[$env_key] = $env_value;
                    }
                }
            }

            // Turn the array back to an String
            $env = implode("\n", $env);

            // And overwrite the .env with the new data
            file_put_contents(base_path() . '/.env', $env);

            return true;
        } else {
            return false;
        }
    }

    public function viewStep1()
    {




        $data = array(
            "APP_NAME" => session('env.APP_NAME') ? str_replace('"', '', session('env.APP_NAME')) : str_replace('"', '', config('app.name')),
            "APP_ENV" => session('env.APP_ENV') ? session('env.APP_ENV') : config('app.env'),
            "APP_DEBUG" => session('env.APP_DEBUG') ? session('env.APP_DEBUG') : config('app.debug'),
            "APP_KEY" => session('env.APP_KEY') ? session('env.APP_KEY') : config('app.key'),
            "APP_AUTH" => session('env.APP_AUTH') ? session ('env.APP_AUTH') : $this->makeAuthUsed(),


        );

        //dd($this->makeAuthUsed());

        return view('LaravelSimpleSetup::step1',compact('data'));

    }

    public function viewStep2()
    {




if(config("database.default") == 'mysql')
        {
            $db = config('database.connections.mysql');

        }

        if(config("database.default") == 'pgsql')
        {
            $db = config('database.connections.pgsql');

        }

        if(config("database.default") == 'sqlite')
        {
            $db = config('database.connections.sqlite');

        }




        $data = array(
            "DB_CONNECTION" => session('env.DB_CONNECTION') ? session('env.DB_CONNECTION') : config("database.default"),
            "DB_HOST" => session('env.DB_HOST') ? session('env.DB_HOST') :  (isset($db['host']) ? $db['host'] : ''),
            "DB_PORT" => session('env.DB_PORT') ? session('env.DB_PORT') :  (isset($db['port']) ? $db['port'] : ''),
            "DB_DATABASE" => session('env.DB_DATABASE') ? session('env.DB_DATABASE') : (isset($db['database']) ? $db['database'] : ''),
            "DB_USERNAME" => session('env.DB_USERNAME') ? session('env.DB_USERNAME') : (isset($db['username']) ? $db['username'] : ''),
            "DB_PASSWORD" => session('env.DB_PASSWORD') ? session('env.DB_PASSWORD') : (isset($db['password']) ? $db['password'] : ''),
        );




        return view('LaravelSimpleSetup::step2',["data" => $data]);
    }

    public function viewStep3()
    {

        $data = array(
            "BROADCAST_DRIVER" => session('env.BROADCAST_DRIVER') ? session('env.BROADCAST_DRIVER') : config("broadcasting.default"),
            "CACHE_DRIVER" => session('env.CACHE_DRIVER') ? session('env.CACHE_DRIVER') : config("cache.default"),
            "SESSION_DRIVER" => session('env.SESSION_DRIVER') ? session('env.SESSION_DRIVER') : config("session.driver"),
            "SESSION_LIFETIME" => session('env.SESSION_LIFETIME') ? session('env.SESSION_LIFETIME') : config("session.lifetime"),
            "QUEUE_DRIVER" => session('env.QUEUE_DRIVER') ? session('env.QUEUE_DRIVER') : config("queue.default"),

            "REDIS_HOST" => session('env.REDIS_HOST') ? session('env.REDIS_HOST') : config("database.redis.default.host"),
            "REDIS_PASSWORD" => session('env.REDIS_PASSWORD') ? session('env.REDIS_PASSWORD') : config("database.redis.default.password"),
            "REDIS_PORT" => session('env.REDIS_PORT') ? session('env.REDIS_PORT') : config("database.redis.default.port"),

            "MAIL_DRIVER" => session('env.MAIL_DRIVER') ? session('env.MAIL_DRIVER') : config("mail.driver"),
            "MAIL_HOST" => session('env.MAIL_HOST') ? session('env.MAIL_HOST') : config("mail.host"),
            "MAIL_PORT" => session('env.MAIL_PORT') ? session('env.MAIL_PORT') : config("mail.port"),
            "MAIL_USERNAME" => session('env.MAIL_USERNAME') ? session('env.MAIL_USERNAME') : config("mail.username"),
            "MAIL_PASSWORD" => session('env.MAIL_PASSWORD') ? session('env.MAIL_PASSWORD') : config("mail.password"),
            "MAIL_ENCRYPTION" => session('env.MAIL_ENCRYPTION') ? session('env.MAIL_ENCRYPTION') : config("mail.encryption"),


            "PUSHER_APP_ID" => session('env.PUSHER_APP_ID') ? session('env.PUSHER_APP_ID') : config("broadcasting.connections.pusher.app_id"),
            "PUSHER_APP_KEY" => session('env.PUSHER_APP_KEY') ? session('env.PUSHER_APP_KEY') : config("broadcasting.connections.pusher.key"),
            "PUSHER_APP_SECRET" => session('env.PUSHER_APP_SECRET') ? session('env.PUSHER_APP_SECRET') : config("broadcasting.connections.pusher.secret"),
            "PUSHER_APP_CLUSTER" => session('env.PUSHER_APP_CLUSTER') ? session('env.PUSHER_APP_CLUSTER') :config("broadcasting.connections.pusher.options.cluster"),

        );




        return view('LaravelSimpleSetup::step3', compact('data'));
    }

    public function viewStep4()
    {
        $dbtype = null;

        if( session('env.DB_CONNECTION') == null)
        {
            $dbtype =  config("database.default");
        }
        else
        {
            $dbtype =  session('env.DB_CONNECTION');
        }

        if($dbtype == 'mysql')
        {
            $db = config('database.connections.mysql');

        }

        if($dbtype == 'pgsql')
        {
            $db = config('database.connections.pgsql');


        }
        $dbDatabase = session('env.DB_DATABASE');
        if($dbtype == 'sqlite')
        {
            $db = config('database.connections.sqlite');

            \Debugbar::info($db['database']);
            \Debugbar::info(session('env.DB_DATABASE'));


            //Fullpath from Session
            $dbDatabase = database_path().DIRECTORY_SEPARATOR.session('env.DB_DATABASE').'.sqlite';

        }

            $data = array(


                "APP_NAME" => str_replace('"', '', session('env.APP_NAME')) == str_replace('"', '', config('app.name'))  ? 'old'  : str_replace('"', '', session('env.APP_NAME')),
                "APP_ENV" => session('env.APP_ENV') == config('app.env')? 'old' : session('APP_ENV'),
                "APP_DEBUG" => session('env.APP_DEBUG') == config('app.debug')? 'old' : session('env.APP_DEBUG'),
                "APP_KEY" => session('env.APP_KEY') == config('app.key') ? 'old' :  session('env.APP_KEY'),

                 "DB_CONNECTION" => session('env.DB_CONNECTION') == config("database.default") ? 'old' :  session('env.DB_CONNECTION'),
              "DB_HOST" => session('env.DB_HOST') ==  (isset($db['host']) ? $db['host'] : '') ? 'old' : session('env.DB_HOST') ,
               "DB_PORT" => session('env.DB_PORT')== (isset($db['port']) ? $db['port'] : '') ? 'old':  session('env.DB_PORT'),
              "DB_DATABASE" => $dbDatabase == (isset($db['database']) ? $db['database'] : '') ? 'old' :  session('env.DB_DATABASE'),
                 "DB_USERNAME" => session('env.DB_USERNAME') == (isset($db['username']) ? $db['username'] : '')? 'old' :  session('env.DB_USERNAME'),
               "DB_PASSWORD" => session('env.DB_PASSWORD') == (isset($db['password']) ? $db['password'] : '') ? 'old' :  session('env.DB_PASSWORD'),


                "BROADCAST_DRIVER" => session('env.BROADCAST_DRIVER') == config("broadcasting.default") ? 'old' : session('env.BROADCAST_DRIVER'),
                "CACHE_DRIVER" => session('env.CACHE_DRIVER') == config("cache.default") ? 'old' : session('env.CACHE_DRIVER') ,
                "SESSION_DRIVER" => session('env.SESSION_DRIVER') ==  config("session.driver") ? 'old' : session('env.SESSION_DRIVER'),
                "SESSION_LIFETIME" => session('env.SESSION_LIFETIME') == config("session.lifetime") ? 'old' : session('env.SESSION_LIFETIME') ,
                "QUEUE_DRIVER" => session('env.QUEUE_DRIVER') == config("queue.default") ? 'old' : session('env.QUEUE_DRIVER'),

                "REDIS_HOST" => session('env.REDIS_HOST') == config("database.redis.default.host") ? 'old' : session('env.REDIS_HOST'),
                "REDIS_PASSWORD" => session('env.REDIS_PASSWORD') ==  config("database.redis.default.password") ? 'old': session('env.REDIS_PASSWORD'),
                "REDIS_PORT" => session('env.REDIS_PORT') ==  config("database.redis.default.port") ? 'old': session('env.REDIS_PORT'),

                "MAIL_DRIVER" => session('env.MAIL_DRIVER') == config("mail.driver") ? 'old': session('env.MAIL_DRIVER') ,
                "MAIL_HOST" => session('env.MAIL_HOST') == config("mail.host") ? 'old': session('env.MAIL_HOST') ,
                "MAIL_PORT" => session('env.MAIL_PORT') ==  config("mail.port") ? 'old': session('env.MAIL_PORT'),
                "MAIL_USERNAME" => session('env.MAIL_USERNAME') == config("mail.username") ? 'old': session('env.MAIL_USERNAME'),
                "MAIL_PASSWORD" => session('env.MAIL_PASSWORD') ==  config("mail.password")? 'old' : session('env.MAIL_PASSWORD'),
                "MAIL_ENCRYPTION" => session('env.MAIL_ENCRYPTION') == config("mail.encryption")? 'old' : session('env.MAIL_ENCRYPTION'),


                "PUSHER_APP_ID" => session('env.PUSHER_APP_ID') == config("broadcasting.connections.pusher.app_id") ? 'old' : session('env.PUSHER_APP_ID'),
                "PUSHER_APP_KEY" => session('env.PUSHER_APP_KEY') == config("broadcasting.connections.pusher.key") ? 'old' : session('env.PUSHER_APP_KEY') ,
                "PUSHER_APP_SECRET" => session('env.PUSHER_APP_SECRET') ==  config("broadcasting.connections.pusher.secret") ? 'old' : session('env.PUSHER_APP_SECRET'),
                "PUSHER_APP_CLUSTER" => session('env.PUSHER_APP_CLUSTER') == config("broadcasting.connections.pusher.options.cluster") ? 'old' : session('env.PUSHER_APP_CLUSTER'),

                "APP_AUTH" => session('env.APP_AUTH') == $this->makeAuthUsed() ? 'old' :  session('env.APP_AUTH'),

            );



        $count = 0;

        foreach ($data as $mydata)
        {

            $mydata !== 'old' ? $count++ : false;
        }

        $count > 0 ?  $view = view('LaravelSimpleSetup::step4', compact('data')) : $view= view ('LaravelSimpleSetup::finishedSetup');


            return $view;
    }


    public function useLaravelBasicAuth()
    {

        $this->makeAuthUsed() == 'true' ? false : Artisan::call('make:auth');
    }


    public function makeAuthUsed()
    {
        $var = file_exists ( app_path().DIRECTORY_SEPARATOR.'Http'.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.'HomeController.php');
        return $var  ? 'true' : 'false';
    }


    public function removeLaravelBasicAuth()
    {


        File::deleteDirectory(resource_path().DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'auth');
        File::delete(resource_path().DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'home.blade.php');
        File::delete(resource_path().DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'layouts'.DIRECTORY_SEPARATOR.'app.blade.php');
        File::delete( app_path().DIRECTORY_SEPARATOR.'Http'.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.'HomeController.php');

        $str=file_get_contents(base_path().DIRECTORY_SEPARATOR.'routes'.DIRECTORY_SEPARATOR.'web.php');
        $str=str_replace("Auth::routes();", "",$str);
        $str=str_replace("Route::get('/home', 'HomeController@index')->name('home');", "",$str);
        file_put_contents(base_path().DIRECTORY_SEPARATOR.'routes'.DIRECTORY_SEPARATOR.'web.php', $str);


    }

    public function lastStep(Request $request)
    {


        try{

            if(session('env.APP_AUTH') == 'true')
            {
                $this->useLaravelBasicAuth();
            }
            else
            {
                $this->removeLaravelBasicAuth();
            }

            if(session('env.DB_CONNECTION') == 'sqlite')
            {
                $fullpathsqlite = database_path().DIRECTORY_SEPARATOR.session('env.DB_DATABASE').'.sqlite';
            }
            else
            {
                $fullpathsqlite = session('env.DB_DATABASE');
            }

            $this->changeEnv([
                'APP_NAME'   => session('env.APP_NAME'),
                'APP_ENV'   => session('env.APP_ENV'),
                'APP_KEY'   => session('env.APP_KEY'),
                'APP_DEBUG'   => session('env.APP_DEBUG'),
                'APP_URL'   => session('env.APP_URL'),

                'LOG_CHANNEL'   => session('env.LOG_CHANNEL'),

                'DB_CONNECTION'   => session('env.DB_CONNECTION'),
                'DB_HOST'   => session('env.DB_HOST'),
                'DB_PORT'   => session('env.DB_PORT'),
                'DB_DATABASE'   => $fullpathsqlite,
                'DB_USERNAME'   => session('env.DB_USERNAME'),
                'DB_PASSWORD'   => session('env.DB_PASSWORD'),

                'BROADCAST_DRIVER'   => session('env.BROADCAST_DRIVER'),
                'CACHE_DRIVER'   => session('env.CACHE_DRIVER'),
                'SESSION_DRIVER'   => session('env.SESSION_DRIVER'),
                'SESSION_LIFETIME'   => session('env.SESSION_LIFETIME'),
                'QUEUE_DRIVER'   => session('env.QUEUE_DRIVER'),

                'REDIS_HOST'   => session('env.REDIS_HOST'),
                'REDIS_PASSWORD'   => session('env.REDIS_PASSWORD'),
                'REDIS_PORT'   => session('env.REDIS_PORT'),

                'MAIL_DRIVER'   => session('env.MAIL_DRIVER'),
                'MAIL_HOST'   => session('env.MAIL_HOST'),
                'MAIL_PORT'   => session('env.MAIL_PORT'),
                'MAIL_USERNAME'   => session('env.MAIL_USERNAME'),
                'MAIL_PASSWORD'   => session('env.MAIL_PASSWORD'),
                'MAIL_ENCRYPTION'   => session('env.MAIL_ENCRYPTION'),

                'PUSHER_APP_ID'   => session('env.PUSHER_APP_ID'),
                'PUSHER_APP_KEY'   => session('env.PUSHER_APP_KEY'),
                'PUSHER_APP_SECRET'   => session('env.PUSHER_APP_SECRET'),
                'PUSHER_APP_CLUSTER'   => session('env.PUSHER_APP_CLUSTER'),


            ]);

            Artisan::call('config:cache');
            session()->forget('env');





        }
        catch (\Exception $e) {


            return $e->getMessage();

            return 'Something went wrong';
        }

        return view('LaravelSimpleSetup::finishedSetup');


    }


    public  function getNewAppKey()
    {

        Artisan::call('key:generate', ['--show' => true]);
        $output = (Artisan::output());
        $output =  substr($output, 0, -2);
        return $output;
    }

    public function setupStep1(Request $request)
    {




        $request->session()->put('env.APP_ENV', $request->app_env);
        $request->session()->put('env.APP_DEBUG', $request->app_debug);
        $request->session()->put('env.APP_AUTH', $request->app_auth);



        if(strlen($request->app_name) > 0){
            $request->session()->put('env.APP_NAME', '"'. $request->app_name.'"');
        }


        if(strlen($request->app_key) > 0){
            $request->session()->put('env.APP_KEY', $request->app_key);
        }



        return $this->viewStep2();
    }

    public function setupStep2(Request $request)
    {


        $request->session()->put('env.DB_CONNECTION', $request->db_connection);
        $request->session()->put('env.DB_HOST', $request->db_host);
        $request->session()->put('env.DB_PORT', $request->db_port);
        $request->session()->put('env.DB_DATABASE', $request->db_database);
        $request->session()->put('env.DB_USERNAME', $request->db_username);
        $request->session()->put('env.DB_PASSWORD', $request->db_password);

        if($request->db_connection == 'sqlite')
        {
        TestDbController::testSqLite();
        }


        \Debugbar::info($request->db_host);


        return $this->viewStep3();
    }

    public function setupStep3(Request $request)
    {

        $request->session()->put('env.BROADCAST_DRIVER', $request->input(strtolower('BROADCAST_DRIVER')));
        $request->session()->put('env.CACHE_DRIVER', $request->input(strtolower('CACHE_DRIVER')));
        $request->session()->put('env.SESSION_DRIVER', $request->input(strtolower('SESSION_DRIVER')));
        $request->session()->put('env.SESSION_LIFETIME', $request->input(strtolower('SESSION_LIFETIME')));
        $request->session()->put('env.QUEUE_DRIVER', $request->input(strtolower('QUEUE_DRIVER')));

        $request->session()->put('env.REDIS_HOST', $request->input(strtolower('REDIS_HOST')));
        $request->session()->put('env.REDIS_PASSWORD', $request->input(strtolower('REDIS_PASSWORD')));
        $request->session()->put('env.REDIS_PORT', $request->input(strtolower('REDIS_PORT')));

        $request->session()->put('env.MAIL_DRIVER', $request->input(strtolower('MAIL_DRIVER')));
        $request->session()->put('env.MAIL_HOST', $request->input(strtolower('MAIL_HOST')));
        $request->session()->put('env.MAIL_PORT', $request->input(strtolower('MAIL_PORT')));
        $request->session()->put('env.MAIL_USERNAME', $request->input(strtolower('MAIL_USERNAME')));
        $request->session()->put('env.MAIL_PASSWORD', $request->input(strtolower('MAIL_PASSWORD')));
        $request->session()->put('env.MAIL_ENCRYPTION', $request->input(strtolower('MAIL_ENCRYPTION')));

        $request->session()->put('env.PUSHER_APP_ID', $request->input(strtolower('PUSHER_APP_ID')));
        $request->session()->put('env.PUSHER_APP_KEY', $request->input(strtolower('PUSHER_APP_KEY')));
        $request->session()->put('env.PUSHER_APP_SECRET', $request->input(strtolower('PUSHER_APP_SECRET')));
        $request->session()->put('env.PUSHER_APP_CLUSTER', $request->input(strtolower('PUSHER_APP_CLUSTER')));



        return $this->viewStep4();

    }

}
