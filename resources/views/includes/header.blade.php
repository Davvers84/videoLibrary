<div class="masthead-content">
    <div class="container">
        <h1 class="masthead-heading mb-0">Vibrary</h1>
        <h2 class="masthead-subheading mb-0">Meeting your Video Library needs.</h2>
        @if(empty($user['email']))
            <a href="/auth/google" class="btn btn-primary btn-xl rounded-pill mt-5">Sign In with Google</a>
        @else
            <center>
                <form action="/video/search" method="post">
                    <label for="search" class="search-button-label"></label>
                    <input type="text" class="btn-xl rounded-pill mt-5" id="search" name="query" alt="" title="" placeholder="Search for videos"/>
                    <input type="submit" class="btn btn-primary btn-xl rounded-pill ml-3" id="submit" name="submit" value="Go"/>
                </form>
            </center>
        @endif
    </div>
</div>
<div class="bg-circle-1 bg-circle"></div>
<div class="bg-circle-2 bg-circle"></div>
<div class="bg-circle-3 bg-circle"></div>
<div class="bg-circle-4 bg-circle"></div>