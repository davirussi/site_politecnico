<html>
    <head>
        <link rel="stylesheet" href="css/style.css" type="text/css" />
        <script type="text/javascript">

            window.setInterval("update_timer()", 120000); // update a cada 2 mins
            function showRSS()
            {
                if (window.XMLHttpRequest)
                {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
                }
                else
                {// code for IE6, IE5
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function()
                {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200)
                    {
                        document.getElementById("rssOutput").innerHTML=xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET","extensions/rss/reader_rss.php",true);
                xmlhttp.send();
            }

            function update_timer() {
                showRSS();
            }
        </script>
    </head>
    <body onload="showRSS()">
        <div id="rssOutput">
            <img src="images/carregando.gif" style="width: 40px; height: 40px;"/><br/>
            Carregando...</div>
    </body>
</html>