@extends('LaravelSimpleSetup::main')
@section('content')

    <div class="row">
        <div class="col-12 text-center mt-3">
            <ul class="progressbar">
                <li class="active"><a href="/setup">Basic Settings</a></li>
                <li class="active"> <a href="/setup/step-2">Database</a></li>
                <li class="active"><a href="/setup/step-3">Expert Settings</a></li>
                <li>Summary</li>
            </ul>
        </div>
    </div>


    <div class="row mt-3" style="padding:50px">

        <div class="col-12">

            <form action="{{route('setupStep3')}}" method="post">
                @csrf


<div class="expertsettings">

    <div class="form-group">
        <label for="broadcast_driver">Broadcast Driver</label> <span class="tip" title="The broadcast driver that handle your event data"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
        <select class="form-control" id="broadcast_driver" name="broadcast_driver">

            <option value="log">Log</option>
            <option value="pusher">Pusher</option>
            <option value="redis">Redis</option>

        </select>
    </div>

    <div class="form-group">
        <label for="cache_driver">Cache Driver</label> <span class="tip" title="The cache driver that handle your caching data"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
        <select class="form-control" id="cache_driver" name="cache_driver">

            <option value="file">File</option>
            <option value="memcached">Memcached</option>
            <option value="redis">Redis</option>

        </select>
    </div>

    <div class="form-group">
        <label for="session_driver">Session Driver</label> <span class="tip" title="The session driver that handle your browser session data"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
        <select class="form-control" id="session_driver" name="session_driver">

            <option value="file">File</option>
            <option value="memcached">Memcached</option>
            <option value="redis">Redis</option>

        </select>
    </div>

    <div class="form-group">
        <label for="session_lifetime">Session Lifetime</label> <span class="tip" title="The lifetime of the session"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
        <input type="text" value="120" class="form-control" id="session_lifetime" name="session_lifetime" placeholder="120">
    </div>

    <div class="form-group">
        <label for="queue_driver">Queue Driver</label> <span class="tip" title="The queue driver that handle your queue data"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
        <select class="form-control" id="queue_driver" name="queue_driver">

            <option value="sync">Sync</option>
            <option value="beanstalkd">Beanstalkd</option>
            <option value="amazonsqs">Amazon SQS</option>
            <option value="redis">Redis</option>

        </select>
    </div>

    <hr style="margin-top:50px">
    <div class="form-group">
        <label for="redis_host">Redis Host</label> <span class="tip" title="The Redis host ip or domain"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
        <input value="127.0.0.1" type="text" class="form-control" id="redis_host" name="redis_host" placeholder="127.0.0.1">
    </div>

    <div class="form-group">
        <label for="redis_password">Redis Password</label> <span class="tip" title="Your Redis connection password"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
        <input value="" type="password" class="form-control" id="redis_password" name="redis_password" placeholder="Password">
    </div>

    <div class="form-group">
        <label for="redis_port">Redis Port</label> <span class="tip" title="The port on which your redis instance is running"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
        <input value="6379" type="text" class="form-control" id="redis_port" name="redis_port">
    </div>

    <hr style="margin-top:50px">

    <div class="form-group">
        <label for="mail_driver">Mail Driver</label><span class="tip" title="The mail driver that handles the mailing"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
        <select class="form-control" id="mail_driver" name="mail_driver">

            <option value="sendmail">Sendmail</option>
            <option value="smtp">SMTP</option>
            <option value="mailgun">Mailgun</option>
            <option value="mandrill">Mandrill</option>
            <option value="sparkpost">SparkPost</option>
            <option value="amazonses">Amazon SES</option>

        </select>
    </div>

    <div class="form-group">
        <label for="mail_host">Mail Host</label> <span class="tip" title="The mail host ip or domain"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
        <input value="smtp.mailtrap.io" type="text" class="form-control" id="mail_host" name="mail_host" placeholder="smtp.mailtrap.io">
    </div>

    <div class="form-group">
        <label for="mail_port">Mail Port</label> <span class="tip" title="The port on which your mail instance is running"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
        <input value="2525" type="text" class="form-control" id="mail_port" name="mail_port">
    </div>

    <div class="form-group">
        <label for="mail_username">Mail Username</label> <span class="tip" title="The username for the mail server"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
        <input value="" type="text" class="form-control" id="mail_username" name="mail_username" placeholder="Username">
    </div>

    <div class="form-group">
        <label for="mail_password">Mail Password</label> <span class="tip" title="The password for the mail server"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
        <input value="" type="password" class="form-control" id="mail_password" name="mail_password" placeholder="Password">
    </div>

    <div class="form-group">
        <label for="mail_encryption">Mail Encryption</label> <span class="tip" title="the mail encryption technique used"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
        <input value="" type="text" class="form-control" id="mail_encryption" name="mail_encryption">
    </div>

    <hr style="margin-top:50px">

    <div class="form-group">
        <label for="pusher_app_id">Pusher App ID</label> <span class="tip" title="The pusher App ID provided by Pusher"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
        <input value="" type="text" class="form-control" id="pusher_app_id" name="pusher_app_id">
    </div>

    <div class="form-group">
        <label for="pusher_app_key">Pusher App Key</label> <span class="tip" title="The pusher App key provided by Pusher"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
        <input value="" type="text" class="form-control" id="pusher_app_key" name="pusher_app_key">
    </div>

    <div class="form-group">
        <label for="pusher_app_secret">Pusher App Secret</label> <span class="tip" title="the pusher App Secret provided by Pusher"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
        <input value="" type="text" class="form-control" id="pusher_app_secret" name="pusher_app_secret">
    </div>

    <div class="form-group">
        <label for="pusher_app_cluster">Pusher App Cluster</label> <span class="tip" title="The pusher app cluster on which pusher is running"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
        <input value="mt1" type="text" class="form-control" id="pusher_app_cluster" name="pusher_app_cluster">
    </div>

</div>

                <div class="row">
                    <div class="col-12 col-md-6">
                        <a href="/setup/step-2" class="btn btn-outline-danger mb-2"  ><i class="fa fa-angle-left"></i> Previous Step </a>
                    </div>
                    <div class="col-12 col-md-6">
                        <button type="submit" class="btn btn-outline-danger mb-2  float-md-right"  > Next Step <i class="fa fa-angle-right"></i></button>
                    </div>
                </div>
            </form>
        </div>

    </div>



@endsection
