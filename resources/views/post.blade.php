<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Post - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">NutMarket</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="/admin">Admin Panel</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @if(Session::has('comment_msg'))
        <div class="bg-success">{{session('comment_msg')}}</div>
        @endif
        @if(Session::has('comment_reply_msg'))
        <div class="bg-success">{{session('comment_reply_msg')}}</div>
        @endif

        <div class="row">
            <div class="col-lg-8">
                <h1>{{$post->title}}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">{{$post->user->name}}</a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="{{$post->photo->name}}" alt="" style="max-height: 400px">

                <hr>

                <!-- Post Content -->
                <p class="lead">{!! $post->body !!}</p>


                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form method="POST" action="/admin/comments">
                        @csrf
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="body"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Comment -->


                <!-- Comment -->
                @if($postComments)
                @foreach ($postComments as $postComment)
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="{{$postComment->author_photo}}" alt="" style="max-height: 64px">
                    </a>

                    <div class="media-body">
                        <h4 class="media-heading">{{$postComment->author}}
                            <small>{{$postComment->created_at->diffForHumans()}}</small>
                        </h4>
                        {{$postComment->body}}
                        <!-- reply -->
                        <div class="btn-comment-reply">Reply</div>
                        <div class="reply-form">
                            <form method="post" action="/comment/reply">
                                @csrf
                                <input type="hidden" name="comment_id" value="{{$postComment->id}}">
                                <label for="body">Write your reply:</label>
                                <textarea name="body" id="" cols="90" rows="4" class="form-control"></textarea>
                                <br>
                                <button type="submit" class="btn btn-info">Send</button>
                            </form>
                        </div>
                        @if($postComment->replies->where('is_active', 1))
                        @foreach ($postComment->replies->where('is_active', 1) as $reply)
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="{{$reply->author_photo}}" alt=""
                                    style="max-height: 64px">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">{{$reply->author}}
                                    <small>{{$reply->created_at->diffForHumans()}}</small>
                                </h4>
                                {{$reply->body}}
                            </div>
                        </div>
                        @endforeach
                        @endif
                        <!-- End Nested Comment -->
                    </div>
                </div>
                @endforeach
                @endif

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <div class="input-group">
                        <input type="text" id="search" class="form-control" name="search">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                Search
                            </button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4 id="serach-result">Search Result</h4>

                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <!-- /.row -->
                </div>


            </div>

        </div>


        <hr>

    </div>
    <!-- /.container -->


    <script src="{{asset('js/app.js')}}"></script>

</body>

</html>