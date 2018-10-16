<div class="foot">
    @if (Route::currentRouteName() == 'contact')
<div class="add-line">
    <div class="container-fluid">
        <div class="row contact-panel">

            @if( !empty($contacts_cache->first()->phone) || !empty($contacts_cache->first()->address) || !empty($contacts_cache->first()->email) )
                @if(!empty($contacts_cache->first()->address))
                    <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <p class="contact-panel-address">{{ trans('front.contacts_address') }}<span>{{ $contacts_cache->first()->address }}</span></p>
                    </div>
                @endif
                @if(!empty($contacts_cache->first()->phone))
                    <div class="col-xl-3 col-lg-5 col-md-12 col-sm-12 col-xs-12">
                        <p class="contact-panel-phone">{{ trans('front.contacts_phone') }}<span>{{ $contacts_cache->first()->phone }}</span></p>
                    </div>
                @endif
                @if(!empty($contacts_cache->first()->email))
                    <div class="col-xl-4 col-lg-7 col-md-12 col-sm-12 col-xs-12">
                        <p class="contact-section-email">{{ trans('front.contacts_email') }}<span>{{ $contacts_cache->first()->email }}</span></p>
                    </div>
                @endif
            @endif

        </div>
    </div>

</div>
    @endif
    <div class="container-fluid">
        <div class="row pt-2">
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <a class="foot-legal" href="#">Terms of Service | </a><a class="foot-legal" href="#">Privacy Policy </a>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <p class="text-center">{{ config('app.name', 'MIRAGETOWER') }} &copy; | @php echo date("Y"); @endphp</p>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                @if(Settings::get(LaravelLocalization::getCurrentLocale().'.instagram_link'))
                    <span>
                        <a href="{{ Settings::get(LaravelLocalization::getCurrentLocale().'.instagram_link') }}" target="_blank" class="instagram">
                        <i id="ig" aria-hidden="true"></i>
                    </a>
                    </span>
                @endif
                @if(Settings::get(LaravelLocalization::getCurrentLocale().'.twitter_link'))
                    <span>
                    <a href="{{ Settings::get(LaravelLocalization::getCurrentLocale().'.twitter_link') }}" target="_blank" class="twitter">
                    <i id="tw" aria-hidden="true"></i>
                </a>
                </span>
                @endif
                @if(Settings::get(LaravelLocalization::getCurrentLocale().'.google_plus_link'))
                    <span>
                   <a href="{{ Settings::get(LaravelLocalization::getCurrentLocale().'.google_plus_link') }}" target="_blank" class="google">
                    <i id="g" aria-hidden="true"></i>
                </a>
                </span>
                @endif
                @if(Settings::get(LaravelLocalization::getCurrentLocale().'.facebook_link'))
                    <span>
                        <a href="{{ Settings::get(LaravelLocalization::getCurrentLocale().'.facebook_link') }}" target="_blank" class="facebook">
                        <i id="fb" aria-hidden="true"></i>
                    </a>
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>