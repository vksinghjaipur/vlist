@extends('frontend.layouts.app')

@section('title', app_name())
@section('meta_description', '')
@section('meta_keyword',"FAQs")

@section('content')

<div class="inner-section">
  <div class="league-bg news-blog">
   	<div class="container">
      <h2>Best Player <span class="border-line"></span></h2>
         
      <div class="row">
        <div class="col-md-12">
          <div class="google-add-top">
           {{--  <img src="img/add-ggogle.PNG" alt=""> --}}
           @php
              $googleads_header= App\Models\Googlead::where('status','1')->orderBy('id')->where('title', 'best-player-page-ads-header-horizontal')->get();
                //echo '<pre>'; print_r($googleads);die();
            @endphp
            @foreach ($googleads_header as $adshere)
              <?php echo '<center>'.$adshere->adsensecode.'</center>';  ?>       
            @endforeach
          </div>
        </div> 
      </div>

      <div class="row">
            <div class="col-md-8">

                        
                @foreach ($bestplayer1 as $k => $playeritem)

                <div class="match-box-guess-user first-match"> 
                  <div class="row league-heading-second">
                  
                 
                  
                  <div class="col-md-12">
                    <div class="guess-league-name">{{ $playeritem['name'] }}</div>
                  </div>
                </div>
                    
                    @foreach ($playeritem['player'] as $key => $player)
                    
                    <div class="col-md-12">
                    @csrf  
                    {{-- <div class="countdown-box">Countdown: <strong><span id="vtime_{{ $key }}"></span></strong></div> --}}
                  
                  </div> 
                    <div class="">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="play-guess-name">
                            <div class="play-img">
                              <?php  $data= explode('https',$player->player_image1); ?>     
                              @if(isset($data)  && !empty( $data[1]))
                                <img  src="{{ $player->player_image1}}" height="60" width="110"> 
                              @else
                                <img src="{{ asset('/img/bestplayer/'.$player->player_image1) }}" height="60" width="110"> 
                              @endif  
                             {{--  <img  src="{{ $player['player_image1'] }}"> --}}
                              <div class="socal-icon-bt">
                                <ul>
                                  <!----- Snapchat Social Media 1 Start  ----->
                                  <li style="color: #bc2a8d"><a class="text-warning" href="{{settings()->social_media_name1_link}}" target="_blank"><i class="fab fa-snapchat-square"></i></a></li>

                                  <!----- Instagram Social Media 2 Start ----->
                                  <li style="color: #bc2a8d"><a class="text-danger" href="<?php echo settings()->social_media_name2_link;?>" target="_blank"><i class="fab fa-instagram-square"></i></a></li>

                                  <!----- Linkedin Social Media 3 Start ----->
                                  <li style="color: #bc2a8d"><a class="text-info" href="<?php echo settings()->social_media_name3_link ;?>" target="_blank"><i class="fab fa-linkedin-square"></i></a></li>

                                  <!----- Twitter Social Media 4 Start ----->
                                  <li style="color: #bc2a8d"><a class="text-primary" href="<?php echo settings()->social_media_name4_link ;?>" target="_blank"><i class="fab fa-twitter-square"></i></a></li>
                                </ul>
                              </div>

                              </div>
                              <div class="lionel-messi-name">
                            <form method="POST" action="{{url('guess-best-player')}}" accept-charset="UTF-8" class="form-horizontal" role="form" id="my-form"> 
                             
                                 <p>{{ $player['player_name1'] }}</p>
                                    @csrf  
                              <input type="hidden" name="best_player_id" value="{{$player->id}}" />
                              <input type="hidden" name="name" value="{{$player->name}}" />
                              <input type="hidden" name="guesspoint"/>  
                              <input type="hidden" name="player_id_name1" value="{{$player->player_id_name1}}" />   
                              <input type="hidden" name="player_image1" value="{{$player->player_image1}}" />
                              <input type="hidden" class="form-control" name="player_name1" value="{{$player->player_name1}}" />
                             
                             
                             
                              @if(Auth::check())

                                   @if(!in_array($player->id,$checkguess))
                                    <button type="submit" id="submit_btn" class="btn btn-danger vbtnbest_{{$key}}" data-target="#exampleModal">Select</button>
                                    
                                  @else
                                    <button type="submit" id="submit_btn" class="btn btn-danger vbtnbest disabled" data-target="" disabled title="Already Guessed">Selected</button>
                                  @endif

                                @else
                                  <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-secondary btn-block checkout-btn vbtnbest">Select</a>   
                                @endif

                              </form>
                              </div>
                            </div>
                            </div>
                          
                          
                            <div class="col-md-6">
                              <div class="play-guess-name">
                                <div class="play-img">
                                <?php  $data= explode('https',$player->player_image2); ?>     
                                @if(isset($data)  && !empty( $data[1]))
                                  <img  src="{{ $player->player_image2}}" height="60" width="110"> 
                                @else
                                  <img src="{{ asset('/img/bestplayer/'.$player->player_image2) }}" height="60" width="110"> 
                                @endif    
                                
                                <div class="socal-icon-bt">
                                  <ul>
                                    <!----- Snapchat Social Media 1 Start  ----->
                                    <li style="color: #bc2a8d"><a class="text-warning" href="{{settings()->social_media_name1_link}}" target="_blank"><i class="fab fa-snapchat-square"></i></a></li>

                                    <!----- Instagram Social Media 2 Start ----->
                                    <li style="color: #bc2a8d"><a class="text-danger" href="<?php echo settings()->social_media_name2_link;?>" target="_blank"><i class="fab fa-instagram-square"></i></a></li>

                                    <!----- Linkedin Social Media 3 Start ----->
                                    <li style="color: #bc2a8d"><a class="text-info" href="<?php echo settings()->social_media_name3_link ;?>" target="_blank"><i class="fab fa-linkedin-square"></i></a></li>

                                    <!----- Twitter Social Media 4 Start ----->
                                    <li style="color: #bc2a8d"><a class="text-primary" href="<?php echo settings()->social_media_name4_link ;?>" target="_blank"><i class="fab fa-twitter-square"></i></a></li>
                                  </ul>
                                </div>  

                              </div>
                              
                            <div class="lionel-messi-name">
                            <form method="POST" action="{{url('guess-best-player')}}" accept-charset="UTF-8" class="form-horizontal" role="form" id="my-form"> 
                                 <p>{{ $player['player_name2'] }}</p> 
                                   @csrf  
                              <input type="hidden" name="best_player_id" value="{{$player->id}}" />
                              <input type="hidden" name="name" value="{{$player->name}}" /> 
                              <input type="hidden" name="player_id_name2" value="{{$player->player_id_name2}}" />  
                              <input type="hidden" name="player_image2" value="{{$player->player_image2}}" />
                              <input type="hidden" class="form-control" name="player_name2" value="{{$player->player_name2}}" />
                              

                                @if(Auth::check())
                                   @if(!in_array($player->id,$checkguess))
                                    <button type="submit" id="submit_btn" class="btn btn-danger vbtnbest_{{$key}}" data-target="#exampleModal">Select</button>
                                    
                                @else
                                    <button type="submit" id="submit_btn" class="btn btn-danger vbtnbest disabled" data-target="" disabled title="Already Guessed">Selected</button>
                                  @endif

                                @else
                                  <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-secondary btn-block checkout-btn vbtnbest">Select</a>   
                                @endif

                               </form>
                              </div>
                              </div>
                            </div>
                        </div>
                       
                    
                    </div>
                     @endforeach
                     {{-- <button type="button" class="btn btn-light pull-right">See More</button> --}}
                  </div>
                  @endforeach
            </div>

            <div class="col-md-4 "> 
              <div class="news-video mb-10">
                @php
                  $googleads= App\Models\Googlead::where('status','1')->orderBy('id')->where('title', 'best-player-page-ads-sidebar-vertical')->get();
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


  	 <div class="add-here">
  	 	<div class="container">
  	 	   <div class="add-img">
  	 	   	  {{-- <img src="{{ asset('img/add-banner.png') }}"> --}}
            @php
            $googleads_footer= App\Models\Googlead::where('status','1')->orderBy('id')->where('title', 'best-player-page-ads-footer-horizontal')->get();
          //echo '<pre>'; print_r($googleads);die();
          @endphp
          @foreach ($googleads_footer as $adshere)
             <?php echo '<center>'.$adshere->adsensecode.'</center>'; ?>   
          @endforeach

  	 	   </div>
  	 	</div>
  	 </div>
</div>



<!-- V Modal Login Pop up start-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content model-content-guess">
     
      <div class="modal-body">
         {{-- <div class="login-sec"> --}}
      <div class="league-bg league-bg-model">
      <div class="container">
         {{-- <div class="row login-box"> --}}
          
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
                     

                    <button type="submit" class="btn-md btn-theme btn-block">Login </button>  
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
<!-- V Model Login Pop up end---->




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

<!----------V Countdown timer Best Player but now showing in page start------>
@foreach ($bestplayer1 as $k => $playeritem)
  @foreach ($playeritem['player'] as $key => $player)
    <script>

    var x = setInterval(function() { 
    //Guess Close Time
    var guess_end_date = "<?php echo ($player->end_guess_datetime); ?>";
    //alert(guess_end_date);
    
    var deadline = new Date(guess_end_date).getTime();
    //var deadline = new Date("Jan 28, 2022 17:50:00").getTime();
    //alert(deadline);
    
    
    //V Guess Closed Time before 1, 2, 5 minutes (ByDefualt 1 minute)...
    //var admin_closetime= "";
    //alert(admin_closetime);

    var guess_closetime = 60300;
    //alert(guess_closetime);

    var deadlineonemin=deadline-guess_closetime;
    
    
    //publish_datetime start time for guess
    var now = new Date().getTime();
    //var now = new Date("01 24, 2022 14:00:00").getTime();
    //alert(now);
    console.log(now);
    var t = deadlineonemin-now;
    if(t==0){
      //$('#submit_btn').disabled=true;
      $(".vbtnbest_{{$key}}").prop('disabled', true);
    }
   
    if(t<345597552)
    {
    var days = Math.floor(t / (1000 * 60 * 60 * 24));
    var hours = Math.floor((t%(1000 * 60 * 60 * 24))/(1000 * 60 * 60));
    var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((t % (1000 * 60)) / 1000);
    document.getElementById("vtime_{{$key}}").innerHTML = days + "d "
    + hours + "h " + minutes + "m " + seconds + "s ";
      if (t < 0) {
        //clearInterval(x);
        document.getElementById("vtime_{{$key}}").innerHTML = "00:00 (Guess Closed)";
        $(".vbtnbest_{{$key}}").prop('disabled', true);  
      }}
      else{
      document.getElementById("vtime_{{$key}}").innerHTML = "Guess will start soon...";
      // $(".vbtnbest").prop('disabled', true);
    }
    });
    </script>
  @endforeach
@endforeach
<!----------V Countdown timer Best Player but now showing in page end-------------->



@endsection

