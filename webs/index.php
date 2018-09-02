<!DOCTYPE html>
<html>
<head>
	<?php
	include('head.php');
	?>
</head>
<body>
	<?php
	include('navbar.php');
	?>
	<div style="padding: 4rem 3rem;">
		<form action="./" method="post">
			<div class="row">
				<div class="col">
					<div class="form-group">
						<label for="service_select_form">Services</label>
						<select class="custom-select" id="service_select_form" name="service" required="">
							<option>NGINX</option>
						</select>
					</div>
				</div>
				<div style="float: left; margin-left: 1rem; margin-right: 2rem;">
					<label>Action</label>
					<div class="row">
						<div style="float: left; margin-left: 1rem;">
							<button type="submit" name="install" class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"></i> install</button>
						</div>
						<div style="float: left; margin-left: 1rem;">
							<button type="submit" name="start" class="btn btn-success"><i class="fa fa-play" aria-hidden="true"></i> start</button>
						</div>
						<div style="float: left; margin-left: 1rem;">
							<button type="submit" name="stop" class="btn btn-danger"><i class="fa fa-stop" aria-hidden="true"></i> stop</button>
						</div>
						<div style="float: left; margin-left: 1rem;">
							<button type="submit" name="restart" class="btn btn-warning"><i class="fa fa-repeat" aria-hidden="true"></i> restart</button>
						</div>
					</div>
				</div>
			</div>
		</form>
		<br>

		<?php
		if (isset($_POST['install'])) {
			$output = exec('ansible-playbook -i /home/zakyore/playbooks/hosts /home/zakyore/playbooks/work.yml');
			//ansible-playbook -i /home/zakyore/playbooks/hosts /home/zakyore/playbooks/work.yml
			$action = 'Install';
		}
		if (isset($_POST['start'])) {
			$output = exec('ansible-playbook -i /home/zakyore/playbooks/hosts /home/zakyore/playbooks/startnginx.yml');
			$action = 'Start';
		}
		if (isset($_POST['stop'])) {
			// $output = exec('ansible-playbook -i /home/zakyore/playbooks/hosts /home/zakyore/playbooks/stopnginx.yml');
			exec("ansible-playbook -i playbooks/hosts playbooks/stopnginx.yml", $output);
			$action = 'Stop';
		}
		if (isset($_POST['restart'])) {
			//$output = exec('ping -n -3 10.151.36.228');
			$ip="10.151.36.228";
			exec("ping -c 4 " . $ip, $output);
			$action = 'Restart';
		}
		if (isset($output)) {
			echo "Service : ".$_POST['service']."<br>";
			echo "Action : ".$action."<br>";
			echo "Output : <br>";//<br>".$output."<br>";
			print_r($output);
		}
		?>
	</div>
</body>
</html>