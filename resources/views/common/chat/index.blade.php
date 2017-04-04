@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox chat-view">

                <div class="ibox-title">
                    <small class="pull-right text-muted">Last message: Mon Jan 26 2015 - 18:39:23</small>
                    Chat room panel
                </div>


                <div class="ibox-content">

                    <div class="row">

                        <div class="col-md-9 ">
                            <div class="chat-discussion">

                                <div class="chat-message">
                                    <img class="message-avatar" src="img/a1.jpg" alt="">
                                    <div class="message">
                                        <a class="message-author" href="#"> Michael Smith </a>
                                        <span class="message-date"> Mon Jan 26 2015 - 18:39:23 </span>
                                        <span class="message-content">
											Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
                                            </span>
                                    </div>
                                </div>
                                <div class="chat-message">
                                    <img class="message-avatar" src="img/a4.jpg" alt="">
                                    <div class="message">
                                        <a class="message-author" href="#"> Karl Jordan </a>
                                        <span class="message-date">  Fri Jan 25 2015 - 11:12:36 </span>
                                        <span class="message-content">
											Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover.
                                            </span>
                                    </div>
                                </div>
                                <div class="chat-message">
                                    <img class="message-avatar" src="img/a2.jpg" alt="">
                                    <div class="message">
                                        <a class="message-author" href="#"> Michael Smith </a>
                                        <span class="message-date">  Fri Jan 25 2015 - 11:12:36 </span>
                                        <span class="message-content">
											There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration.
                                            </span>
                                    </div>
                                </div>
                                <div class="chat-message">
                                    <img class="message-avatar" src="img/a5.jpg" alt="">
                                    <div class="message">
                                        <a class="message-author" href="#"> Alice Jordan </a>
                                        <span class="message-date">  Fri Jan 25 2015 - 11:12:36 </span>
                                        <span class="message-content">
											All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.
                                                It uses a dictionary of over 200 Latin words.
                                            </span>
                                    </div>
                                </div>
                                <div class="chat-message">
                                    <img class="message-avatar" src="img/a6.jpg" alt="">
                                    <div class="message">
                                        <a class="message-author" href="#"> Mark Smith </a>
                                        <span class="message-date">  Fri Jan 25 2015 - 11:12:36 </span>
                                        <span class="message-content">
											All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.
                                                It uses a dictionary of over 200 Latin words.
                                            </span>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-3">
                            <div class="chat-users">


                                <div class="users-list">
                                    @foreach($users as $user)
                                        <div class="chat-user">
                                            <span class="pull-right label label-primary">Online</span>
                                            <img class="chat-avatar" src="img/a2.jpg" alt="">
                                            <div class="chat-user-name">
                                                <a href="#">{{$user->staff->full_name}}</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="chat-message-form">

                                <div class="form-group">

                                    <textarea class="form-control message-input" name="message"
                                              placeholder="Enter message text"></textarea>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>

    </div>
@endsection