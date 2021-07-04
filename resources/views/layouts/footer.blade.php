<footer>
    <div class="d-flex flex-row justify-content-center">
        <div class="mt-0">
            <p>© Copyright {{date("Y")}} {{config('app.name', 'Laravel')}}</p>
        </div>
        <div class="ml-auto">
            <div class="d-flex flex-row justify-content-center align-items-center social">
                <div>
                    <a href="#" target="_blank" rel="noopener" class="d-flex">
                        <img src="{{ asset('images/social/facebook_logo.svg') }}" alt="Mail">
                    </a>
                </div>
                <div class="">
                    <a href="#" target="_blank" rel="noopener" class="d-flex">
                        <img src="{{ asset('images/social/twitter_logo.svg') }}" alt="Mail">
                    </a>
                </div>
                <div class="">
                    <a href="#" target="_blank" rel="noopener" class="d-flex">
                        <img src="{{ asset('images/social/instagram_logo.svg') }}" alt="Mail">
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
