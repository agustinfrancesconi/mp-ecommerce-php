<?php

function redirect_post($url, array $data)
{
    ?>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <script type="text/javascript">
            function closethisasap() {
                document.forms["redirectpost"].submit();
            }
        </script>
    </head>
    <body onload="closethisasap();">
    <form name="redirectpost" method="post" action="<? echo $url; ?>">
        <?php
        if ( !is_null($data) ) {
            foreach ($data as $key => $value) {
                echo '<input type="hidden" name="' . $key . '" value="' . $value . '"> ';
            }
        }
        ?>
    </form>
    </body>
    </html>
    <?php
    exit;
}

redirect_post($_POST["back_url"], $_POST);