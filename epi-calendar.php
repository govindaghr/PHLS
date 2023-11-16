<h4 class="widgetheading">EPI Calendar</h4>
				<?php
				  if(isset($_REQUEST['year'])) $year = $_REQUEST['year'];
				  if(isset($_REQUEST['month'])) $month = $_REQUEST['month'];
				?>
				<form action="<?php //the_permalink(); ?><?php echo esc_url( home_url( '/' ) ); ?><?php //echo $_SERVER['PHP_SELF']; ?>" method="Post">
					<?php
					  if(!isset($year) || $year == '') $year = date('Y');
					  if(!isset($month) || $month == '') $month = date('n');
					?>
					<select name="year">
						<option><?php echo $year; ?></option>
						<option><?php echo intval($year)-1; ?></option>
						<option><?php echo intval($year)+1; ?></option>
					</select>
					<select name="month">
						<?php
						  $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
						  for($i = 1; $i <= 12; $i++) {
							echo '<option value="' . $i . '"';
							if($i == $month) echo ' selected';
							echo '>' . $months[$i-1] . "</option>\n";
						  }
						?>
					</select>
					<input type="submit" value="Generate">
				</form>
				<?php
				  // include calendar class:
				  include('/inc/calendar.inc.php');
				  // create calendar:
				  $cal = new CALENDAR($year, $month);
				  $cal->offset = 2;
				  $cal->link = "./";//$_SERVER['PHP_SELF'];// "./";//$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]
				  echo $cal->create();
				?>