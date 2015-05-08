<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
echo "<script type='text/javascript'> document.location = 'login.php'; </script>"; // Redirecting To Login Page
}
?>
