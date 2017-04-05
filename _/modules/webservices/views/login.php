<section id="login-block">
    <div class="block-border">
        <div class="block-content">
            <h1>Webservices</h1>
            <div class="block-header">Login</div>
            <form class="form with-margin" name="login-form" id="login-form" method="post" action="">
                <p class="message error no-margin" style="display: none;"></p>
                <p class="inline-small-label">
                    <label for="login"><span class="big">Email</span></label>
                    <input class="input full-width" type="text" id="user" name="user" />
                </p>
                <p class="inline-small-label">
                    <label for="pass"><span class="big">Password</span></label>
                    <input class="input full-width" type="password" id="pwd" name="pwd" />
                </p>
                <button type="button" class="float-right" id="submit" name="submit">Login</button>
                <p class="input-height"></p>
            </form>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        $('.input').keypress(function (e) {
            if (e.which == 13) {
              login();
              return false;
            }
        });
        $('#submit').click(function() {
            login();
        });
        function login() {
            var user = $('#user').val();
            var pwd = $('#pwd').val();
            $.ajax({
                type: 'POST',
                async: false,
                url: '<?php echo $base_url; ?>webservices/login/checklogin',
                data: 'user=' + user + '&pwd=' + pwd,
                success: function(response) {
                    var rs = JSON.parse(response);
                    if (rs.value === 'yes') {
                        window.location.href = rs.href;
                    } else {
                        $('p.error').html("Incorrect user or password!");
                        $('p.error').fadeIn();
                    }
                }
            });
        }
    });
</script>