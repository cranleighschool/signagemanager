<?php
	require_once('conn.php');
	require_once('functions.php');

?><!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./jquery.datetimepicker.css"/>
<?php 
	include('head.php');

	fnadminreq($PDO, $_SESSION['user']['username'], $isadmin);
	$groups = fnglobalquery($PDO, '*', 'groups', 1, 1, 1, 1, 1, 1, 'id', 'ASC');
	
	if(!isset($_REQUEST['groupid'])) {
	$startGroup = $groups[0]['id'];
	} else {
		$startGroup = $_REQUEST['groupid'];
	}
	
	$permissionMembers = fnglobalquery($PDO, '*', 'permissions', 'groupID', $startGroup, 1,1,1,1, 'id', 'ASC');
	
	$groupName = fnglobalquery($PDO, 'groupName', 'groups', 'id', $startGroup, 1, 1, 1, 1, 'id', 'ASC');
	
?>
<title>Assign Users to Groups</title>	
</head>

<body>
<?php include('nav.php'); ?>
	<div class="container tjb_container">	
	
		<div class="page_title">
			<h1>Access / Permissions</h1>
		</div>			
		<form name="groupPermissions" action="grouppermissions.php" method="POST">
		<label for="groupName">Select Group</label>
			<select type="text" class="form-control" id="groupName" name="groupName" onchange="this.form.submit()">
			
			<?php foreach($groups as $group) {
				if($startGroup == $group['id']) {
					?>
					<option value="<?php echo $group['id']; ?>" selected="selected"><?php echo strtoupper($group['groupName']); ?></option>
				<?php
				} else {
				?>
					<option value="<?php echo $group['id']; ?>"><?php echo strtoupper($group['groupName']); ?></option>
				<?php
					}		
				}
			?>
			</select>
		</form>
		<div style="margin-top: 10px;">
			<a href="deletegroup.php?id=<?php echo $startGroup; ?>&groupName=<?php echo $groupName[0]['groupName']; ?>" onclick="return confirm('Are you sure you want to delete this Group?')">Delete Group</a>
		</div>
	
		<div class="table-responsive" style="margin-top: 50px;">
		<h3>Current Members (<?php echo $groupName[0]['groupName']; ?>)</h3>
			<table class="table text-center table-striped table-hover">
				<tr>
					<th class="text-center">Members</th>
					<th class="text-center">Remove</th>
				</tr>
				
				<?php foreach($permissionMembers as $row) {
					?>
				</tr>
					<td><?php echo strtoupper($row['username']); ?></td>
					<td><a href="deletemember.php?id=<?php echo $row['id']; ?>&member=<?php echo $row['username']; ?>&currentGroup=<?php echo $startGroup; ?>" onclick="return confirm('Are you sure you want to delete this Group Member?')"><i class="fa fa-trash-o"></i></a></td>
				</tr>
				<?php
					}
				?>
			</table>
				<form name="newMember" action="newMember.php" method="POST">
					<div class="form-group" style="margin-top: 50px">
				<h4>Add New Member to Existing Group</h4>
						<input type="text" name="groupid" id="groupid" value="<?php echo $startGroup; ?>" hidden>
						<input type="text" name="newMember" id="newMember" class="form-control" required>
					</div>
					<div class="row">
						<div class="col-md-3">
							<button style="" type="submit" class="btn">Add Member</button>
						</div>
					</div>
				</form>
				
				<form name="newGroup" action="newgroup.php" method="POST">
					<div class="form-group" style="margin-top:50px;">
					<h4>Create New Group</h4>
						<input class="form-control" type="text" name="newgroupname" id="newgroupname" required />
					</div>
					<div class="row">
						<div class="col-md-3">
							<button style="" type="submit" class="btn">Create New Group</button>
						</div>
					</div>
				</form>
			</div>			
	</div>				
	
	
		<?php include('footer.php'); ?>
	</body>
		</html>	