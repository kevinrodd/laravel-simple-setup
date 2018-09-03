@extends('LaravelSimpleSetup::main')
@section('content')

    <div class="row">
        <div class="col-12 text-center mt-3">
            <ul class="progressbar">
                <li class="active"><a href="/setup">Basic Settings</a></li>
                <li class="active"><a href="/setup/step-2">Database</a></li>
                <li class="active"><a href="/setup/step-3">Expert Settings</a></li>
                <li class="active"><a href="/setup/step-4">Summary</a></li>
            </ul>
        </div>
    </div>


    <div class="row mt-3" style="padding:50px">

        <div class="col-12">

            <form action="{{route('lastStep')}}" method="post">
                @csrf

                <h2 class="mb-5">Do you want these settings to change?</h2>

                <div id="tochange">

                @if($data['APP_NAME'] != 'old')
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6 text-truncate">Application Name</div>

                            <div class="col-12 col-md-6 text-truncate"> {{ $data['APP_NAME'] }}</div>
                        </div>
                    </div>
                @endif

                @if($data['APP_KEY'] != 'old')
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-6 text-truncate font-weight-bold">Application Key</div>

                        <div class="col-12 col-md-6 text-truncate"> {{ $data['APP_KEY'] }}</div>
                    </div>
                </div>
                @endif

                @if($data['APP_DEBUG'] != 'old')
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6 text-truncate ">Application Debug Mode</div>

                            <div class="col-12 col-md-6 text-truncate"> {{ $data['APP_DEBUG'] }}</div>
                        </div>
                    </div>
                @endif


                    @if($data['APP_AUTH'] != 'old')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-6 text-truncate ">Create Basic User Management</div>

                                <div class="col-12 col-md-6 text-truncate"> {{ $data['APP_AUTH'] }}</div>
                            </div>
                        </div>
                    @endif

                @if($data['DB_CONNECTION'] != 'old')
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6 text-truncate">Database Connection Type</div>
                            @if($data['DB_CONNECTION'] != ' ')
                                <div class="col-12 col-md-6 text-truncate"> You disabled the database.</div>
                                @else
                                <div class="col-12 col-md-6 text-truncate"> {{$data['DB_CONNECTION']}}</div>
                                @endif


                        </div>
                    </div>
                @endif

                @if($data['DB_HOST'] != 'old')
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6 text-truncate">Database Host</div>

                            <div class="col-12 col-md-6 text-truncate"> {{ $data['DB_HOST'] }}</div>
                        </div>
                    </div>
                @endif

                @if($data['DB_PORT'] != 'old')
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6 text-truncate">Database Port</div>

                            <div class="col-12 col-md-6 text-truncate"> {{ $data['DB_PORT'] }}</div>
                        </div>
                    </div>
                @endif

                @if($data['DB_DATABASE'] != 'old')
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6 text-truncate">Database Selected</div>

                            <div class="col-12 col-md-6 text-truncate"> {{ $data['DB_DATABASE']}}</div>
                        </div>
                    </div>
                @endif

                @if($data['DB_USERNAME'] != 'old')
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6 text-truncate">Database Username</div>

                            <div class="col-12 col-md-6 text-truncate"> {{ $data['DB_USERNAME'] }}</div>
                        </div>
                    </div>
                @endif

                @if($data['DB_PASSWORD'] != 'old')
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6 text-truncate">Database Password</div>

                            <div class="col-12 col-md-6 text-truncate"> {{ $data['DB_PASSWORD']}}</div>
                        </div>
                    </div>
                @endif

                @if($data['BROADCAST_DRIVER'] != 'old')
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6 text-truncate">Broadcast Driver</div>

                            <div class="col-12 col-md-6 text-truncate"> {{ $data['BROADCAST_DRIVER'] }}</div>
                        </div>
                    </div>
                @endif

                @if($data['CACHE_DRIVER'] != 'old')
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6 text-truncate">Cache Driver</div>

                            <div class="col-12 col-md-6 text-truncate"> {{ $data['CACHE_DRIVER']}}</div>
                        </div>
                    </div>
                @endif

                @if($data['SESSION_DRIVER'] != 'old')
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6 text-truncate">Session Driver</div>

                            <div class="col-12 col-md-6 text-truncate"> {{ $data['SESSION_DRIVER'] }}</div>
                        </div>
                    </div>
                @endif

                @if($data['SESSION_LIFETIME'] != 'old')
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6 text-truncate">Session Lifetime</div>

                            <div class="col-12 col-md-6 text-truncate"> {{ $data['SESSION_LIFETIME'] }}</div>
                        </div>
                    </div>
                @endif

                @if($data['QUEUE_DRIVER'] != 'old')
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6 text-truncate">Queue Driver</div>

                            <div class="col-12 col-md-6 text-truncate"> {{ $data['QUEUE_DRIVER']}}</div>
                        </div>
                    </div>
                @endif

                @if($data['REDIS_HOST'] != 'old')
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6 text-truncate">Redis Host</div>

                            <div class="col-12 col-md-6 text-truncate"> {{ $data['REDIS_HOST'] }}</div>
                        </div>
                    </div>
                @endif

                @if($data['REDIS_PASSWORD'] != 'old')
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6 text-truncate">Redis Password</div>

                            <div class="col-12 col-md-6 text-truncate"> {{ $data['REDIS_PASSWORD'] }}</div>
                        </div>
                    </div>
                @endif

                @if($data['REDIS_PORT'] != 'old')
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6 text-truncate">Redis Port</div>

                            <div class="col-12 col-md-6 text-truncate"> {{ $data['REDIS_PORT'] }}</div>
                        </div>
                    </div>
                @endif

                @if($data['MAIL_DRIVER'] != 'old')
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6 text-truncate">Mail Driver</div>

                            <div class="col-12 col-md-6 text-truncate"> {{ $data['MAIL_DRIVER'] }}</div>
                        </div>
                    </div>
                @endif

                @if($data['MAIL_HOST'] != 'old')
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6 text-truncate">Mail Host</div>

                            <div class="col-12 col-md-6 text-truncate"> {{ $data['MAIL_HOST'] }}</div>
                        </div>
                    </div>
                @endif

                @if($data['MAIL_PORT'] != 'old')
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6 text-truncate">Mail Port</div>

                            <div class="col-12 col-md-6 text-truncate"> {{ $data['MAIL_PORT'] }}</div>
                        </div>
                    </div>
                @endif

                @if($data['MAIL_USERNAME'] != 'old')
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6 text-truncate">Mail Username</div>

                            <div class="col-12 col-md-6 text-truncate"> {{ $data['MAIL_USERNAME'] }}</div>
                        </div>
                    </div>
                @endif

                @if($data['MAIL_PASSWORD'] != 'old')
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6 text-truncate">Mail Password</div>

                            <div class="col-12 col-md-6 text-truncate"> {{ $data['MAIL_PASSWORD']}}</div>
                        </div>
                    </div>
                @endif

                @if($data['MAIL_ENCRYPTION'] != 'old')
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6 text-truncate">Mail Encryption</div>

                            <div class="col-12 col-md-6 text-truncate"> {{ $data['MAIL_ENCRYPTION'] }}</div>
                        </div>
                    </div>
                @endif

                @if($data['PUSHER_APP_ID'] != 'old')
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6 text-truncate">Pusher App ID</div>

                            <div class="col-12 col-md-6 text-truncate"> {{ $data['PUSHER_APP_ID']  }}</div>
                        </div>
                    </div>
                @endif

                @if($data['PUSHER_APP_KEY'] != 'old')
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6 text-truncate">Pusher App Key</div>

                            <div class="col-12 col-md-6 text-truncate"> {{ $data['PUSHER_APP_KEY']  }}</div>
                        </div>
                    </div>
                @endif

                @if($data['PUSHER_APP_SECRET'] != 'old')
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6 text-truncate">Pusher App Secret</div>

                            <div class="col-12 col-md-6 text-truncate"> {{ $data['PUSHER_APP_SECRET']  }}</div>
                        </div>
                    </div>
                @endif

                @if($data['PUSHER_APP_CLUSTER'] != 'old')
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6 text-truncate">Pusher App Cluster</div>

                            <div class="col-12 col-md-6 text-truncate"> {{$data['PUSHER_APP_CLUSTER']  }}</div>
                        </div>
                    </div>
                @endif
                </div>
                <div class="row mt-5">
                    <div class="col-12 col-md-6 text-truncate">
                        <a href="/setup/step-3" class="btn btn-outline-danger mb-2"  ><i class="fa fa-angle-left"></i> Previous Step </a>
                    </div>
                    <div class="col-12 col-md-6 text-truncate">
                        <button type="submit" class="btn btn-success mb-2 btn-block"  >Confirm <i class="fa fa-check"></i></button>
                    </div>
                </div>


            </form>
        </div>

    </div>
    </div>


    <script>

    </script>
@endsection
