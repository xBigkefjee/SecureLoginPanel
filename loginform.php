<!DOCTYPE html>
<html>

<head>
    <!-- we need jquery -->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript">
        function checklogin(username, password) {
            // post data to the login handler
            $.post("./loginhandler.php", {
                a: username,
                b: password
            }, function (data) {
                // check if there is data received
                if (data) {
                    // split the data in parts
                    var result = data.split('|');
                    alert(result[0]);
                    if (result[1] == 'index.php') {
                        // redirect to corrosponding page
                        window.location.replace("./" + result[1]);
                    }
                }
            });
        }
    </script>
</head>

<body>

    <!-- Chrome autofill workaround -->
    <input style="display:none" type="text" name="fakeusernameremembered" />
    <input style="display:none" type="password" name="fakepasswordremembered" />
    <!-- Chrome autofill workaround -->
    <h4>Loginpanel</h4>
    <input id="usernamefield" type="text" autocomplete="off" />
    <input id="passwordfield" type="password" autocomplete="off" />
    <!-- simple <button> or <a> with an onclick that performs a javascript function -->
    <button type="submit" onclick="checklogin(usernamefield.value, passwordfield.value)" name="action">Log in</button><br/><br/>
    <a href="./registerform.php">No account? Register one here!</a>
</body>

</html>
