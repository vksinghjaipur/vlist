@extends('frontend.layouts.app')

@section('title', app_name())
@section('meta_description', '')
@section('meta_keyword',"FAQs")

@section('content')

<div class="inner-section">
  <div class="league-bg news-blog">
    <div class="container">
      <h2>Guess-box<span class="border-line"></span></h2>
      <div class="row">
        <div class="col-md-12">
          <div class="google-add-top">
            {{-- <img src="{{ asset('img/add-ggogle.PNG') }}"> --}}
            @php
              $googleads_header= App\Models\Googlead::where('status','1')->orderBy('id')->where('title', 'guess-zone-page-ads-header-horizontal')->get();
              //echo '<pre>'; print_r($googleads_header);die();
            @endphp
            
            @foreach ($googleads_header as $adshere)
              <div class="row">
                <div class="col-sm-12">
                  <?php echo '<center>'.$adshere->adsensecode.'</center>';  ?>
                </div>
              </div>   
            @endforeach
          </div>
        </div> 
      </div>

      <?php $todaydate = timezone()->convertToLocal(\Carbon\Carbon::now(), 'd-m-Y'); ?>

      <div class="row">    
          <div class="col-md-9">
           @foreach ($leagues_new as $key=> $myleague)                
            <div class="match-box-guess-user first-match">
              <div class="row league-heading-first">
                <div class="guess-league-name">{{ $myleague->league_name }}</div>
                <div class="league-logo">
                  <img class="logo-vs" src="{{ $myleague->league_logo }}">
                  {{-- <span class="laliga-ttext">Laliga</span> --}}
                </div>
              </div> 
              <div class="guess-league-start">
                <form method="POST" action="{{url('guess-box')}}" accept-charset="UTF-8" class="form-horizontal" role="form" id="my-form"> 
                  <div class="league-match guess-box-league">
                      <div class="league-team start-left-side">
                        <div class="team-logo-guess">
                          <img src="{{ $myleague->team_home_logo }}">
                          <div class="home-name-guess">{{ $myleague->team_home_name }}</div>
                        </div> 
                        <div class="countdown-canter">
                            <input type="number" id="guess-btn-home" class="form-control txtName vbtnbest_{{$key}}" name="guess_number_home_team"  aria-describedby="emailHelp" placeholder="0-99" />
                          </div>
                      </div>

                      <div class="countdown-main">
                        @csrf  
                          <div class="countdown-box">Countdown: <strong><span id="vtime_{{$key}}"></span></strong></div>
                          <div class="count-input-field">
                          <input type="hidden" name="league_id" value="{{$myleague->league_id}}" />
                          <input type="hidden" name="league_name" value="{{$myleague->league_name}}" />
                          <input type="hidden" name="league_country" value="{{$myleague->league_country}}" />
                          <input type="hidden" name="league_logo" value="{{$myleague->league_logo}}" />
                          <input type="hidden" name="league_season" value="{{$myleague->league_season}}" />
                          <input type="hidden" name="fixture_id" value="{{$myleague->fixture_id}}" />
                          <input type="hidden" name="team_home_name" value="{{$myleague->team_home_name}}" />
                          <input type="hidden" name="goals_home" value="{{$myleague->goals_home}}" />
                          <input type="hidden" name="goals_away" value="{{$myleague->goals_away}}" />
                          <input type="hidden" name="team_away_name" value="{{$myleague->team_away_name}}" />

                          @foreach ($guesspoint as $myleague2) 
                          <input type="hidden" name="guess_point" value="{{$myleague2->guess_point}}" />
                          @endforeach
                          <div class="countdown-canter">
                              @if(Auth::check())
                              @if(!in_array($myleague->fixture_id,$checkguess))
                                <button type="submit" id="submit_btn" class="btn btn-danger vbtnbest_{{$key}}" data-target="#exampleModal">Guess</button>
                                
                              @else
                                <button type="submit" id="submit_btn" class="btn btn-danger vbtnbest disabled" data-target="" disabled title="Already Guessed">Guessed</button>
                              @endif
                              
                              @else
                              <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-danger">Guess</a>             
                              @endif
                          </div>
                         </div>
                         <div class="socal-icon-bt">
                            <span>{!! $shareComponent !!}</span>
                          </div> 
                       </div>
                       <div class="league-team">
                            <div class="countdown-canter">
                              <input type="number" id="guess-btn-away" class="form-control txtName vbtnbest_{{$key}}" name="guess_number_away_team"  aria-describedby="emailHelp" placeholder="0-99" />
                            </div>
                            <div class="team-logo-guess">
                            <div class="away-name-guess">{{ $myleague->team_away_name }}</div>
                                <img src="{{ $myleague->team_away_logo }}">
                            </div>
                       </div>
                     </div>
                       
                </form>
                  <hr/>
              </div>
            </div>
           @endforeach 
          {!! $leagues_new->links('vendor.pagination.custom') !!}     
          </div>  
         
        
      <div class="col-md-3">
          <div class="row">
            <div class="col-md-12">
              <div class="news-video mb-10">
                {{-- <img src="{{ asset('img/frontend/ads-competition-page.PNG') }}"/>  --}}
                @php
                $googleads= App\Models\Googlead::where('status','1')->orderBy('id')->where('title', 'guess-box-page-ads-sidebar-vertical')->get();
                //echo '<pre>'; print_r($googleads);die();
                @endphp

                @foreach ($googleads as $adshere)
                <?php echo $adshere->adsensecode;  ?>   
                @endforeach
              </div> 
            </div> 
          </div>
      </div>
      </div>  
    </div>
  </div>

  <div class="add-here">
    <div class="container">
      <div class="add-img">
        {{-- <img src="{{ asset('img/add-banner.png') }}"> --}}
          @php
          $googleads_header= App\Models\Googlead::where('status','1')->orderBy('id')->where('title', 'guess-zone-page-ads-header-horizontal')->get();
          //echo '<pre>'; print_r($googleads_header);die();
          @endphp
          
          @foreach ($googleads_header as $adshere)
            <?php echo '<center>'.$adshere->adsensecode.'</center>';  ?>   
          @endforeach

      </div>
    </div>
  </div>

</div>

<!-- Modal Login Pop up start-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content model-content-guess"> 
      <div class="modal-body">
        <div class="league-bg league-bg-model">
        <div class="container">
          <div class="col-lg-12 col-md-12 bg-color-8 align-self-center league-bg-model-guess">
            <div class="form-section">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
            {{ html()->form('POST', route('frontend.auth.login.post'))->open() }}
              {{-- <div class="logo-2 ">
                  <a href="index.html">
                      <img src="img/logo.png" alt="logo">
                  </a>
              </div> --}}
              <h3>Membership Login</h3>
              <div class="login-inner-form">
                <form action="#" method="GET">
                    <div class="form-group form-box">
                         {{ html()->text('username')
                            ->class('input-text')
                            ->placeholder(__('validation.attributes.frontend.username'))
                            ->attribute('maxlength', 191)
                            ->required()
                        }}
                    </div>
                    <div class="form-group form-box">
                        {{ html()->password('password')
                            ->class('input-text')
                            ->placeholder(__('validation.attributes.frontend.password'))
                            ->required() 
                        }}
                    </div>
                    <div class="checkbox clearfix">
                        <div class="form-check checkbox-theme">
                            {{ html()->label(html()->checkbox('remember', true, 1) . ' ' . __('labels.frontend.auth.remember_me'))->for('remember') }}
                        </div>
                        <a href="{{ route('frontend.auth.password.reset') }}">@lang('labels.frontend.passwords.forgot_password')</a>
                    </div>
                    <button type="submit" class="btn-md btn-theme btn-block">Login</button>  
                    <p class="text">Don't have an account? <a href="{{url('register') }}"> Register</a></p>
                </form>
                {{ html()->form()->close() }}
              </div>
            </div>
          </div>
         </div>
      
        </div>
      </div>
    </div>
  </div>

</div>


 

<!--Model Login Pop up end---->
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>


<!--V Countdown timer start---->
@foreach ($leagues_new as $key=> $myleague)

<script>
    var x = setInterval(function() {
    var guess_end_date = "<?php echo ($myleague->date); ?>";
    //alert(guess_end_date);
    //date end time (match start)
    var deadline = new Date(guess_end_date).getTime();
    //alert(deadline);
    //var deadline = new Date("Nov 07, 2021 16:54:25").getTime();
    
    //V Guess Closed Time before 1, 2, 5 minutes (ByDefualt 1 minute)...
    var admin_closetime= "<?php echo ($myleague->publish_datetime); ?>";
    //alert(admin_closetime);

    var guess_closetime = admin_closetime*60300;
    //alert(guess_closetime);

    var deadlineonemin=deadline-guess_closetime;
    
    //publish_datetime start time for guess
    var now = new Date().getTime();
    //var now = new Date("01 24, 2022 14:00:00").getTime();
    //alert(now);
    console.log(now);
    var t = deadlineonemin-now;
    //alert(t);
    if(t<0){
      //$('#submit_btn').disabled=true;
     $(".vbtnbest_{{$key}}").prop('disabled', true);
      
    }
    //V timestam in second
    if(t<345597552)
    {
    var days = Math.floor(t / (1000 * 60 * 60 * 24));

    var hours = Math.floor((t%(1000 * 60 * 60 * 24))/(1000 * 60 * 60));
    var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((t % (1000 * 60)) / 1000);
    document.getElementById("vtime_{{$key}}").innerHTML = days + "d "
    + hours + "h " + minutes + "m " + seconds + "s ";

    	if (t < 0) {
    		
        $(".vbtnbest").prop('disabled', true);
    	    document.getElementById("vtime_{{$key}}").innerHTML = "00:00 (Guess Closed)";
            $(".vbtnbest_{{$key}}").prop('disabled', true);        
        
    	}}
      else{
      document.getElementById("vtime_{{$key}}").innerHTML = "Guess will start soon...";
      $(".vbtnbest_{{$key}}").prop('disabled', true);
    }
    }, 1000);
</script>
@endforeach
<!--V Countdown timer end---->


@endsection

