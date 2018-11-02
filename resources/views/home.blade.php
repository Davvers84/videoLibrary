<style>
    #customBtn {
        width: 155px;
    }
    #customBtn:hover {
        box-shadow: 2px 2px 3px #888888;
        border-radius: 5px;
        cursor: hand;
    }
</style>

@if(!empty($user['email']))

    <p>USER ID = {{ $user['id'] }}</p>

    <p>Welcome {{ $user['name'] }}, thank you for signing in!</p>
    <a href="/video/downloads">My downloads videos</a>
    <center>
    <form action="/video/search" method="post">
        <label for="search">Search for videos:</label>
        <input type="text" id="search" name="query" alt="" title=""/>
        <input type="submit" id="submit" name="submit"/>
    </form>
    </center>
    <a href="/auth/signout">Sign out here!</a>
@else
    <a href="/auth/google"><img id="customBtn" src="/assets/img/signin_button.png" alt="Sign-in with Google" title="Sign-in with Google"/></a><!-- will come back to this if I get the rest done -->
@endif
{{--<a href="/videos/search"><img id="customBtn" src="/assets/img/signin_button.png" alt="Sign-in with Google" title="Sign-in with Google"/></a>--}}