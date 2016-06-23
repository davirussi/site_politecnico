<?php

if (!isset($_SESSION))
    exit;
valida_logado(1);
?>

<?php

##############################################################
#####/* se a ação selecionada for ADMIN   (action default)*/##
##############################################################
if (!isset($_GET['action']) || $_GET['action'] == 'admin') {

    /* breadcrumbs */
    echo breadcrumbs(array('Calendário' => ''));

    /* titulo principal */
    echo '<h1>Calendário</h1>';

   include('../extensions/calendar/databaseConnection.php');

	$action = $_POST['action'];

	switch($action) {
//		case 'login':
//			// Login.
//			$username = stripslashes(trim($_POST['username']));
//			$password = sha1(stripslashes(trim($_POST['password'])));
//
//			if(empty($username) || empty($password)) {
//				// Stop, someone tried entering nothing into here.
//				// Show an error.
//				$loginMsg = 'You must enter a username and password';
//			} else {
//				// The input seems to be ok, check it against the database.
//				$checkDetails = mysql_query("SELECT id FROM user WHERE username='$username' AND password='$password' LIMIT 1", $conn);
//				if($checkDetails) {
//					if(mysql_num_rows($checkDetails) > 0) {
//						setcookie('nodstrumCalendarV2', '1', time()+3600);	// Cookie will expire in 1 hour.
//						// $loginMsg = '<span style="color: green">You are logged in<i>!</i></span>';
//					} else {
//						$loginMsg = 'Senha ou login incorreto';
//					}
//				} else {
//                                            $loginMsg = 'Erro de conexão';
//				}
//			}
//			break;
//		case 'logout':
//			setcookie('nodstrumCalendarV2', '0', time()-3600000);
//			header('location: index.php');
//			break;
		case 'updatePassword':
			$pass1 = sha1($_POST['password1']);
			$pass2 = sha1($_POST['password2']);

			if($pass1 == $pass2) {
				$updatePassword = mysql_query("UPDATE user SET password='$pass1' WHERE username='admin' LIMIT 1", $conn);
				if($updatePassword) {
					$loginMsg = '<span style="color: green">Senha modificada com sucesso</span>';
				} else {
					$loginMsg = 'Houve um erro ao atualizar sua senha.';
				}
			} else {
				$loginMsg = 'Suas senhas não foram encontradas, por favor, tente novamente.';
			}

			break;
		case 'updateColours':
			$dc = $_POST['dayColor'];
			$wc = $_POST['weekendColor'];
			$tc = $_POST['todayColor'];
			$ec = $_POST['eventColor'];
			$ic1 = $_POST['iteratorColor1'];
			$ic2 = $_POST['iteratorColor2'];

			$updateColours = mysql_query("UPDATE settings SET dayColor='$dc', weekendColor='$wc', todayColor='$tc', eventColor='$ec', iteratorColor1='$ic1', iteratorColor2='$ic2' WHERE id='1' LIMIT 1", $conn);

			if($updateColours) {
				$loginMsg = '<span style="color: green"> Suas cores foram atualizadas</span>';
			} else {
				$loginMsg = 'Houve um problema atualizando as cores';
			}

			break;
	}

	include('../extensions/calendar/settings.php');
       
?>





<style>
	calendario_corpo{
		font-family: Tahoma;
		font-size: 12px;
	}

	.calendarBox {

		margin: 0 auto;

		width: 280px;

	}

	.calendarFloat {
		float: left;
		width: 32px;
		height: 20px;
		margin: 1px 0px 0px 1px;
		padding: 1px;
		border: 1px solid #000;
	}
</style>

<script type="text/javascript">
	function highlightCalendarCell(element) {
		$(element).style.border = '1px solid #999999';
	}

	function resetCalendarCell(element) {
		$(element).style.border = '1px solid #000000';
	}

	function startCalendar(month, year) {
		new Ajax.Updater('calendarInternal', '../extensions/calendar/rpc.php', {method: 'post', postBody: 'action=startCalendar&month='+month+'&year='+year+''});
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
		new Ajax.Updater('eventList', '../extensions/calendar/rpc.php', {method: 'post', postBody: 'action=listEvents&&d='+day+'&m='+month+'&y='+year+''});
		if(Element.visible('eventList')) {
			// do nothing, its already visble.
		} else {
			setTimeout("Element.show('eventList')", 300);
		}
	}

	function addEvent(day, month, year, body) {
		if(day && month && year && body) {
			// alert('Add Event\nDay: '+day+'\nMonth: '+month+'\nYear: '+year+'\nBody: '+body);
			new Ajax.Request('../extensions/calendar/rpc.php', {method: 'post', postBody: 'action=addEvent&d='+day+'&m='+month+'&y='+year+'&body='+body+'', onSuccess: highlightEvent(day)});
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
			new Ajax.Request('../extensions/calendar/rpc.php', {method: 'post', postBody: 'action=deleteEvent&eid='+eid+'', onSuccess: Element.hide('event_'+eid+'')});
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
		<div id="eventList" style="display: none;"></div>
		<div style="display: none; margin-top: 10px;" id="addEventForm">
			<b>Add Evento</b>
			<br>
			Data: <input type="text" size="2" id="evtDay" disabled> <input type="text" size="2" id="evtMonth" disabled> <input type="text" size="4" id="evtYear" disabled>
			<br>
			<textarea id="evtBody" cols="32" rows="5"></textarea>
			<br>
			<input type="button" value="Add Evento" onClick="addEvent($F('evtDay'), $F('evtMonth'), $F('evtYear'), $F('evtBody'));">
			<a href="#" onClick="Element.hide('addEventForm');">Fechar</a>
		</div>

<!--		<div style="display: none; margin-top: 10px;" id="loginBox">
			<b>Login</b>
			<br>
			<form action="index.php?s=calendario&action=admin" method="post">
				Username:<br> <input type="text" name="username" size="20">
				<br>
				Password: <br><input type="password" name="password" size="20">
				<br>
				<input type="hidden" name="action" value="login">
				<input type="submit" value="Login">
				<a href="#" onClick="Element.hide('loginBox');">Fechar</a>
			</form>
		</div>-->

		<div style="display: none; margin-top: 10px;" id="cpBox">
			<b>Painel Controle</b> <a href="#" onClick="Element.hide('cpBox');">Fechar</a>
			<br><br>
			<b>Mude as cores</b>
			<br>
			<form action="" method="post">
				Cor dia: <input type="text" name="dayColor" size="6" maxlength="6" value="<?= $dayColor; ?>">
				<br>
				Cor fim de semana: <input type="text" name="weekendColor" size="6" maxlength="6" value="<?= $weekendColor; ?>">
				<br>
				Cor hoje: <input type="text" name="todayColor" size="6" maxlength="6" value="<?= $todayColor; ?>">
				<br>
				Cor Evento: <input type="text" name="eventColor" size="6" maxlength="6" value="<?= $eventColor; ?>">
				<br>
				Cor Evento ímpar: <input type="text" name="iteratorColor1" size="6" maxlength="6" value="<?= $iteratorColor2; ?>">
				<br>
				Cor Evento par: <input type="text" name="iteratorColor2" size="6" maxlength="6" value="<?= $iteratorColor1; ?>">
				<br>
				<input type="hidden" name="action" value="updateColours">
				<input type="submit" value="Alterar Cores">
			</form>

<!--			<br>
			<form action="index.php" method="post">
				<input type="hidden" name="action" value="updatePassword">
				<b>Altere sua senha</b>
				<br>
				Nova senha: <input type="password" name="password1" size="20">
				<br>
				Repita: <input type="password" name="password2" size="20">
				<br>
				<input type="submit" value="Alterar Senha">
			</form>-->

<!--			<br><br>
			<b>Logout</b>
			<form action="index.php" method="post">
				<input type="hidden" name="action" value="logout">
				<input type="submit" value="Sair">
			</form>-->
		</div>

	</div> <!-- FINAL DIV DO NOT REMOVE -->

	<script type="text/javascript">
		startCalendar(0,0);
	</script>
<?php }

?>