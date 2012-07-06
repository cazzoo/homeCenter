<!doctype html> <!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
	<!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>Configuration</title>
		<meta name="description" content="">
		<meta name="author" content="">

		<meta name="viewport" content="width=device-width">

		<link rel="stylesheet/less" href="less/style.less">
		<script src="js/libs/less-1.3.0.min.js"></script>

		<!-- Use SimpLESS (Win/Linux/Mac) or LESS.app (Mac) to compile your .less files
		to style.css, and replace the 2 lines above by this one:

		<link rel="stylesheet" href="less/style.css">
		-->

		<script src="js/libs/modernizr-2.5.3-respond-1.1.0.min.js"></script>
	</head>
	<body>

		<?php
		require_once "constants.php";
		require_once ("classes/Database.php");
		require_once ("classes/Page.php");
		require_once ("classes/Action.php");

		$action = new Action(1, "myAction", "This is a first action that should create a file");

		$action -> activate();
		$action -> deactivate();

		$db = new Database();
		//$db -> saveToBase($action);
		//$db -> loadFromBase();
		?>
		<!--[if lt IE 7]><div class="alert alert-warn"><a class="close" data-dismiss="alert" href="#">×</a><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p></div><![endif]-->

		<div class="container">
			
			<ul	class="breadcrumb">
				<li>
					<a href="index.php"> <i class="icon-dashboard"></i> Dashboard</a><span class="divider">/</span>
				</li>
				<li class="active">
					<i class="icon-settings"></i> Configuration
				</li>
			</ul>

			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#admin_pages" data-toggle="tab">Pages</a>
				</li>
				<li>
					<a href="#admin_actions" data-toggle="tab">Actions</a>
				</li>
			</ul>

			<div class="tab-content">
				<div class="tab-pane active" id="admin_pages">
					<?php
					$result = $db -> loadFromBase('page');
					if (count($result) > 0) {
						echo '
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Id</th>
									<th>Name</th>
									<th>Description</th>
									<th>Icon</th>
									<th>Link</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>';
						foreach ($result as $value) {
							echo '
								<tr>
									<td>' . $value -> _id . '</td>
									<td>' . $value -> _name . '</td>
									<td>' . $value -> _content . '</td>
									<td>' . $value -> _icon . '</td>
									<td>' . $value -> _link . '</td>
									<td>
										<a href="#" class="btn btn-primary btn-mini"><i class="icon-edit icon-white"></i> Modify</a>
										<a href="#" class="btn btn-danger btn-mini"><i class="icon-remove icon-white"></i> Delete</a>
									</td>
								</tr>';
						}
						echo '
							</tbody>
						</table>';
					} else
						echo '<div class="alert alert-info">No element found in the database for pages.</div>';
					?>
					<div class="well row" style="margin: 0 auto !important;">
						<a id="collapse_add_page" class="close" href="#">&minus;</a>
						<div id="collapsable_add_page">
							<div class="span5">
								<h4>Add a page</h4>
								<hr />
								<form id="admin_add_page" name="admin_add_page" method="post" action="test.php">
								  <div class="input-prepend">
								  	<span class="add-on prepend-mini">Title</span><input type="text" class="span3" name="page_title" placeholder="Enter page title…"> <span class="label label-important">* required</span>
								  </div>
								  <span class="help-block">Example block-level help text here.</span>
								  <div class="input-prepend">
								  	<span class="add-on prepend-mini">Content</span><textarea type="text" class="span3" name="page_content" placeholder="Enter page content…" rows="3" style="resize: vertical;"></textarea> <span class="label label-important">* required</span>
								  </div>
								  <span class="help-block">Example block-level help text here.</span>
								  <div class="input-prepend">
								  	<span class="add-on prepend-mini">Icon</span><select id="icon_select" name="icon_select" class="span3">
								  		<?php
										$dirPath = dir('img/icon/');
										$imgArray = array();
										while (($file = $dirPath -> read()) !== false) {
											if ((substr($file, -3) == "gif") || (substr($file, -3) == "jpg") || (substr($file, -3) == "png")) {
												$imgArray[] = trim($file);
											}
										}
										$dirPath -> close();
										sort($imgArray);
										$c = count($imgArray);
										for ($i = 0; $i < $c; $i++) {
											echo "<option value=\"" . $imgArray[$i] . "\">" . $imgArray[$i] . "\n";
										}
									?>
								  </select>
								  </div>
								  <span class="help-block">Example block-level help text here.</span>
								  <div class="input-prepend">
								  	<span class="add-on prepend-mini">Link</span><input type="text" class="span3" name="page_link" placeholder="Enter page link…"> <span class="label label-important">* required</span>
								  </div>
								  <span class="help-block">Example block-level help text here.</span>
								  <button type="submit" class="btn">Submit</button>
								</form>
							</div>
							<div class="span5">
								<ul class="nav nav-tabs">
									<li class="active">
										<a href="#icon_preview" data-toggle="tab">Icon preview</a>
									</li>
									<li>
										<a href="#page_preview" data-toggle="tab">Page preview</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="icon_preview">
										<img id="preview-icon-mini" src=""/> &nbsp; <img id="preview-icon-maxi" src=""/>
									</div>
									<div class="tab-pane" id="page_preview">
										Coming later
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="admin_actions">
					<?php
					$result = $db -> loadFromBase('action');
					if (count($result) > 0) {
						echo '
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Id</th>
									<th>Title</th>
									<th>Content</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>';
						foreach ($result as $value) {
							echo '
								<tr>
									<td>' . $value -> _id . '</td>
									<td>' . $value -> _name . '</td>
									<td>' . $value -> _description . '</td>
									<td>
										<a href="#" class="btn btn-primary btn-mini"><i class="icon-edit icon-white"></i> Modify</a>
										<a href="#" class="btn btn-danger btn-mini"><i class="icon-remove icon-white"></i> Delete</a>
									</td>
								</tr>';
						}
						echo '
							</tbody>
						</table>';
					} else
						echo '<div class="alert alert-info">No element found in the database for actions.</div>';
					?>
				</div>
			</div>

			<hr>

			<footer>
				<div class="row">
					<h3>
					<div class="span3">
						<span><?php echo APP_NAME
							?></span>
					</div>
					<div class="span4 offset5">
						<span class="pull-right"> <span id="jclock"></span> </span>
					</div></h3>
				</div>
			</footer>

		</div>
		<!-- /container -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script>
			window.jQuery || document.write('<script src="js/libs/jquery-1.7.2.min.js"><\/script>')
		</script>
		<script src="js/libs/jquery.jclock.js"></script>

		<!-- scripts concatenated and minified via ant build script-->
		<script src="js/libs/bootstrap/bootstrap.min.js"></script>

		<script src="js/plugins.js"></script>
		<script src="js/script.js"></script>
		<!-- end scripts-->

	</body>
</html>