<h3>LOGIN</h3>

<form method="POST">
	<table>
		<tbody>
			<tr>
				<td><label for="email">Email: </label></td>
				<td><input type="email" name="email"
					value="<?= (isset($email)) ? $email : '' ?>" /></td>
			</tr>
			<tr>
				<td><label for="password">Password: </label></td>
				<td><input type="password" name="password" /></td>
			</tr>
		</tbody>
	</table>
	<input type="hidden" name="logincsrf" value="<? $logincsrf ?>"> 
	<input type="submit" value="Login" />
</form>