<!DOCTYPE html>
<html>

<head>
    <!-- we need jquery -->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript">
        function register(username, password, name) {
            // post data to the login handler
            $.post("./registerhandler.php", {
                a: username,
                b: password,
                c: name
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
    <h4>Registerpanel</h4>
    Username <input id="usernamefield" type="text" autocomplete="off" />
    <br/>
    Password <input id="passwordfield" type="password" autocomplete="off" />
    <br/>
    Person name <input id="namefield" type="text" autocomplete="off" />
    <br/>
    <!-- simple <button> or <a> with an onclick that performs a javascript function -->
    <button type="submit" onclick="register(usernamefield.value, passwordfield.value, namefield.value)" name="action">Register</button><br/><br/>
    <a href="./index.php">Already have an account? Click here to login!</a>
</body>

</html>
