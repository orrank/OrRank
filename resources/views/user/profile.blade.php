@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="/">OrRank</a></li>
                            @if (Auth::user() && Auth::user()->id == $user->id)
                                <li class="breadcrumb-item"><a
                                        href="/{{ Auth::user()->username }}">~{{ Auth::user()->username }}</a></li>
                            @else
                                <li class="breadcrumb-item"><a href="/{{ $user->username }}">~{{ $user->username }}</a>
                                </li>
                            @endif
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Profile</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col-xl-3 col-md-4">
                            <div class="text-center card-box shadow-none border border-secoundary">
                                <div class="member-card">
                                    <div class="avatar-xl member-thumb mb-3 mx-auto d-block">
                                        @if (Auth::user() && Auth::user()->id == $user->id)
                                            @if (Auth::user()->profile_image)
                                                <img class="rounded-circle img-thumbnail"
                                                    src="{{ asset('uploads/images/users/' . Auth::user()->profile_image) }}"
                                                    alt="{{ Auth::user()->username }}">
                                            @else
                                                <img class="rounded-circle img-thumbnail"
                                                    src="https://avatar.tobi.sh/tobiaslins.svg?size=180&text={{ substr(Auth::user()->firstname, 0, 1) }}{{ substr(Auth::user()->lastname, 0, 1) }}"
                                                    alt="{{ Auth::user()->username }}">
                                            @endif
                                            @if (Auth::user()->isVerified)
                                                <i class="mdi mdi-star-circle member-star text-success"
                                                    data-placement="right" data-toggle="tooltip" class="tooltips"
                                                    data-original-title="verified user"></i>
                                            @endif
                                        @else
                                            @if ($user->profile_image)
                                                <img class="rounded-circle img-thumbnail"
                                                    src="{{ asset('uploads/images/users/' . $user->profile_image) }}"
                                                    alt="{{ $user->username }}">
                                            @else
                                                <img class="rounded-circle img-thumbnail"
                                                    src="https://avatar.tobi.sh/tobiaslins.svg?size=180&text={{ substr($user->firstname, 0, 1) }}{{ substr($user->lastname, 0, 1) }}"
                                                    alt="{{ $user->username }}">
                                            @endif
                                            @if ($user->isVerified)
                                                <i class="mdi mdi-star-circle member-star text-success"
                                                    data-placement="right" data-toggle="tooltip" class="tooltips"
                                                    data-original-title="verified user"></i>
                                            @endif
                                        @endif
                                    </div>
                                    @if (Auth::user() && Auth::user()->id == $user->id)
                                        <div class="">
                                            <h5 class="font-18 mb-1">{{ Auth::user()->firstname }}
                                                {{ Auth::user()->lastname }}</h5>
                                            <p class="text-muted mb-2">~{{ Auth::user()->username }}</p>
                                        </div>
                                    @else
                                        <div class="">
                                            <h5 class="font-18 mb-1">{{ $user->firstname }}
                                                {{ $user->lastname }}</h5>
                                            <p class="text-muted mb-2">~{{ $user->username }}</p>
                                        </div>
                                    @endif
                                    @if (Auth::user() && Auth::user()->id == $user->id)
                                        <a href="/{{ Auth::user()->username }}/profile:edit"
                                            class="btn btn-dark btn-sm width-sm waves-effect mt-2 waves-light">Edit
                                            Profile</a>
                                    @else
                                        @if (Auth::user())
                                            @livewire('components.follow-button', ['frdId' => $user->id],
                                            key($user->id))
                                        @endif
                                    @endif
                                    @if (Auth::user() && Auth::user()->id == $user->id)
                                        <p class="sub-header mt-3">
                                            {{ Auth::user()->bio }}
                                        </p>
                                    @else
                                        <p class="sub-header mt-3">
                                            {{ $user->bio }}
                                        </p>
                                    @endif
                                    <p class="text-muted font-13">
                                        {{-- <i class="mdi mdi-account-multiple-check"></i> --}}
                                        <a href="?tab=followers">{{ $followers }} Followers</a>
                                        &nbsp;&nbsp; • &nbsp;&nbsp;
                                        <a href="?tab=following">{{ $following }} Following</a>
                                    </p>
                                    <hr />
                                    <div class="text-left">
                                        @if (Auth::user())
                                            @if (Auth::user()->mobile)
                                                <p class="text-muted font-13">
                                                    <strong>
                                                        <i class="mdi mdi-cellphone-iphone"></i>
                                                    </strong>
                                                    <span class="ml-4">
                                                        {{ Auth::user()->mobile }}</span>
                                                </p>
                                            @endif
                                            @if (Auth::user()->email)
                                                <p class="text-muted font-13">
                                                    <strong>
                                                        <i class="mdi mdi-email-outline"></i>
                                                    </strong>
                                                    <span class="ml-4">
                                                        {{ Auth::user()->email }}</span>
                                                </p>
                                            @endif
                                            @if (Auth::user()->location)
                                                <p class="text-muted font-13">
                                                    <strong>
                                                        <i class="mdi mdi-map-marker-outline"></i>
                                                    </strong>
                                                    <span class="ml-4">
                                                        {{ Auth::user()->location }}</span>
                                                </p>
                                            @endif
                                        @endif
                                    </div>

                                    <ul class="social-links list-inline mt-4">
                                        <li class="list-inline-item">
                                            <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#"
                                                data-original-title="Facebook"><i class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#"
                                                data-original-title="Twitter"><i class="fab fa-twitter"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#"
                                                data-original-title="Instagram"><i class="fab fa-instagram"></i></a>
                                        </li>
                                    </ul>

                                </div>

                            </div>
                            <!-- end card-box -->

                        </div>
                        <!-- end col -->

                        <div class="col-xl-9 col-md-8">
                            <div class="row">
                                <div class="col-xl-8">
                                    <h5 class="header-title">Recent Activities</h5>

                                    <div class=" pt-2">
                                        <h5 class="font-16 mb-1">Lead designer / Developer</h5>
                                        <p class="mb-0">websitename.com</p>
                                        <p><b>2010-2015</b></p>

                                        <p class="sub-header"></p>
                                    </div>

                                    <hr />

                                    <div class="">
                                        <h5 class="font-16 mb-1">Senior Graphic Designer</h5>
                                        <p class="mb-0">coderthemes.com</p>
                                        <p><b>2007-2009</b></p>

                                        <p class="sub-header"></p>
                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col-xl-4">
                                    <h5 class="header-title">Recently joined users</h5>

                                    <div class="inbox-widget">
                                        @foreach ($users as $user)
                                            <div>
                                                <div class="inbox-item">
                                                    <div class="inbox-item-img">
                                                        @if ($user->profile_image)
                                                            <img src="{{ asset('uploads/images/users/' . $user->profile_image) }}"
                                                                class="rounded-circle" alt="{{ $user->username }}">
                                                        @else
                                                            <img class="rounded-circle"
                                                                src="https://avatar.tobi.sh/tobiaslins.svg?size=180&text={{ substr($user->firstname, 0, 1) }}{{ substr($user->lastname, 0, 1) }}"
                                                                alt="{{ $user->username }}">
                                                        @endif
                                                    </div>
                                                    <a href="/{{ $user->username }}">
                                                        <p class="inbox-item-author">{{ $user->firstname }}
                                                            {{ $user->lastname }}</p>
                                                        <p class="inbox-item-text">~{{ $user->username }}</p>
                                                    </a>
                                                    <p class="inbox-item-date">
                                                        @livewire('components.follow-button', ['frdId' => $user->id],
                                                        key($user->id))
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end col -->

                    </div>
                </div>
            </div>
        </div>
        <!-- End row -->

    </div>
    <!-- end container-fluid -->
@stop
