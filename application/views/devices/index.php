<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OneSignal Manager</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
		<nav class="navbar navbar-inverse navbar-static-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">OneSignal Manager</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Actions<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><?php echo anchor("Quotes/broadcast/", 'Send to Everyone(Broadcast message!)') ;?></a></li>
								<li><?php echo anchor("Quotes/segment/", 'Send to a segment') ;?></a></li>
							</ul>
						</li>
						<li><a href="#">Contact</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<h1><?php echo "Users";?></h1>
		<div id="infoMessage"><?php echo $this->session->flashdata('message');?></div>
		<table class="table" cellpadding=0 cellspacing=10>
			<tr>
				<th>id</th>
				<th>device_model</th>
				<th>tags</th>
				<th>device type</th>
				<th>Action</th>

			</tr>

			<?php if(!empty($players)) {foreach ($players as $player):
				echo form_open("Quotes/subscribe") ?>
				<tr>
					<td><?php echo htmlspecialchars($player->id,ENT_QUOTES,'UTF-8');?></td>
		            <td><?php echo htmlspecialchars($player->device_model,ENT_QUOTES,'UTF-8');?></td>
								<td><input name="tags" value="<?php echo $player->tags->email."|".$player->tags->user_id."|".$player->tags->id;?>"></label> </td>
								<td><?php echo htmlspecialchars($player->device_type,ENT_QUOTES,'UTF-8');?></td>


					<td><input type="submit" value="Send Custom Message by tags"/><?php echo anchor("Quotes/sendMessage_playerID/".$player->id, 'Send Message by player ID') ;?></td>
				</tr>

			<?php echo form_close(); endforeach;} ?>
		</table>


		</p>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script>
		    function doconfirm() {
		        job = confirm("Are you sure to delete permanently?");
		        if (job != true) {
		            return false;
		        }
		    }
				</script>

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>
