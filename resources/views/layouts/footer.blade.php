<div class="foot">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <p>{{ config('app.name', 'MIRAGETOWER') }} &copy; | @php echo date("Y"); @endphp</p>
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