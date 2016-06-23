<!-- Arquivo dos códigos dos SERVICOS -->

<!--
################################
##         Calendário         ##
################################
-->
<div class="servicos">
    <div class="titulo" >
        <div class="left">
            <div id="fundo_calendario"><div style="padding-top: 8px; padding-left: 2px; float: left;"><?php echo date('d'); ?></div></div> Calendário
        </div>
        <div class="right">
            <img onclick="onclickAbrir('calendario_corpo');" src="images/seta.png" width="15px" height="12px" style="padding-top: 8px;"/>
        </div>
        <br clear="both">
        <span></span>
    </div>
    <div id="calendario_corpo" class="corpo" style="display: none;">
        <div>
        <?php
        include('extensions/calendar/databaseConnection.php');

        include('extensions/calendar/settings.php');
        ?>
            </div>
        <style>
            calendario_corpo{
                font-family: Tahoma;
                font-size: 12px;
                text-align: center;
            }

            .calendarBox {

                margin: 0 auto;

                width: 220px;

            }

            .calendarFloat {
                float: left;
                width: 25px;
                height: 20px;
                margin: 1px 0px 0px 1px;
                padding: 1px;
                border: 1px solid #000;
            }
        </style>
        <!--[if ie]>
            <style>
               
                .calendarBox {
                    width: 220px !important;
                }
        .calendarFloat {
                width: 30px !important;
            }

            </style>
        <![endif]-->
        <script type="text/javascript">
            function highlightCalendarCell(element) {
                $(element).style.border = '1px solid #999999';
            }

            function resetCalendarCell(element) {
                $(element).style.border = '1px solid #000000';
            }
	
            function startCalendar(month, year) {
                new Ajax.Updater('calendarInternal', 'extensions/calendar/rpc.php', {method: 'post', postBody: 'action=startCalendar&month='+month+'&year='+year+''});
            }
	
            function showEventForm(day) {
                $('evtDay').value = day;
                $('evtMonth').value = $F('ccMonth');
                $('evtYear').value = $F('ccYear');
		
                displayEvents(day, $F('ccMonth'), $F('ccYear'));
		
                if(Element.visible('addEventForm')) {
                    // do nothing.
                } else {
                    Element.show('addEventForm');
                }
            }
	
            function displayEvents(day, month, year) {
                new Ajax.Updater('eventList', 'extensions/calendar/rpc.php', {method: 'post', postBody: 'action=listEvents&&d='+day+'&m='+month+'&y='+year+''});
                if(Element.visible('eventList')) {
                    // do nothing, its already visble.
                } else {
                    setTimeout("Element.show('eventList')", 300);
                }
            }
	
            function addEvent(day, month, year, body) {
                if(day && month && year && body) {
                    // alert('Add Event\nDay: '+day+'\nMonth: '+month+'\nYear: '+year+'\nBody: '+body);
                    new Ajax.Request('extensions/calendar/rpc.php', {method: 'post', postBody: 'action=addEvent&d='+day+'&m='+month+'&y='+year+'&body='+body+'', onSuccess: highlightEvent(day)});
                    $('evtBody').value = '';
                } else {
                    alert('There was an unexpected script error.\nPlease ensure that you have not altered parts of it.');
                }
		
                // highlightEvent(day);
            } // addEvent.
	
            function highlightEvent(day) {
                Element.hide('addEventForm');
                $('calendarDay_'+day+'').style.background = '#<?= $eventColor ?>';
            }
	
            function showLoginBox() {
                Element.show('loginBox');
            }
	
            function showCP() {
                Element.show('cpBox');
            }
	
            function deleteEvent(eid) {
                confirmation = confirm('Are you sure you wish to delete this event?\n\nOnce the event is deleted, it is gone forever!');
                if(confirmation == true) {
                    new Ajax.Request('extensions/calendar/rpc.php', {method: 'post', postBody: 'action=deleteEvent&eid='+eid+'', onSuccess: Element.hide('event_'+eid+'')});
                } else {
                    // Do not delete it!.
                }
            }
        </script>


        <div id="calendar" class="calendarBox">
            <div id="calendarInternal">
                &nbsp;
            </div>
            <br style="clear: both;">
            <span id="LoginMessageBox" style="color: red; margin-top: 10px;"><?= $loginMsg; ?></span>
            <div id="eventList" style="display: none; padding-right: 5px;"></div>
            <div style="display: none; margin-top: 10px;" id="addEventForm">
                <div style="display:none;">
                    <br>
                    Data: <input type="text" size="2" id="evtDay" disabled> <input type="text" size="2" id="evtMonth" disabled> <input type="text" size="4" id="evtYear" disabled>
                    <br>
                    <textarea id="evtBody" cols="32" rows="5"></textarea>
                    <br>
                    <input type="button" value="Add Evento" onClick="addEvent($F('evtDay'), $F('evtMonth'), $F('evtYear'), $F('evtBody'));">
                    <a href="#" onClick="Element.hide('addEventForm');">Fechar</a>
                </div>
            </div>


        </div> <!-- FINAL DIV DO NOT REMOVE -->

        <script type="text/javascript">
            startCalendar(0,0);
        </script>

    </div>
</div>

<!--
################################
##            onibus          ##
################################
-->

<div class="servicos">
    <div class="titulo" >
        <div class="left">
            <img src="images/icon_bus.png" align="center" width="30px" height="30px"/> Ônibus
        </div>
        <div class="right">
            <img onclick="onclickAbrir('onibus_corpo');" src="images/seta.png" width="15px" height="12px" style="padding-top: 8px;"/>
        </div>
        <br clear="both">
        <span></span>
    </div>
    <div id="onibus_corpo" class="corpo" style="display: none;">
        <center>
            <?php include "extensions/onibus/bus.php"; ?>
        </center>
    </div>
</div>


<!--
################################
##            RU              ##
################################
-->

<div class="servicos">
    <div class="titulo" >
        <div class="left">
            <img src="images/icon_ru.png" align="center" width="30px" height="30px"/> RU
        </div>
        <div class="right">
            <img onclick="onclickAbrir('ru_corpo');" src="images/seta.png" width="15px" height="12px" style="padding-top: 8px;"/>
        </div>
        <br clear="both">
        <span></span>
    </div>
    <div id="ru_corpo" class="corpo" style="display: none;">
        <center>
            <?php include "extensions/ru/cardapio.php"; ?>
        </center>
    </div>
</div>

<!--
################################
##            RSS             ##
################################
-->

<div class="servicos">
    <div class="titulo" >
        <div class="left">
            <img src="images/icon_rss.png" align="center" width="30px" height="30px"/> RSS
        </div>
        <div class="right">
            <img onclick="onclickAbrir('rss_corpo1');" src="images/seta.png" width="15px" height="12px" style="padding-top: 8px;"/>
        </div>
        <br clear="both">
        <span></span>
    </div>
    <div id="rss_corpo1" class="corpo" style="display: none;">
        <center>
            <?php include "extensions/rss/index.php"; ?>
        </center>
    </div>
</div>


<!--
################################
##            RSS             ##
################################
-->

<!--<div class="servicos">
    <div class="titulo" >
        <div class="left">
            <img src="images/icon_rss.png" align="center" width="30px" height="30px"/> RSS
        </div>
        <div class="right">
            <img onclick="onclickAbrir('rss_corpo');" src="images/seta.png" width="15px" height="12px" style="padding-top: 8px;"/>
        </div>
        <br clear="both">
        <span></span>
    </div>
    <div id="rss_corpo" class="corpo" style="display: none;">
        <center>
<?php //include "extensions/rss/reader_rss.php"; ?>
        </center>
    </div>
</div>-->
