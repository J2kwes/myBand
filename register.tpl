<br>
<br>
<br>

<form method="post" action="index.php">
    <div class="input-group">
        <label>Gebruikersnaam:</label><br>
        <input type="text" name="username">
    </div>
    <div class="input-group">
        <br>
        <label>E-Mail adres:</label><br>
        <input type="email" name="email">
    </div>
    <div class="input-group">
        <br>
        <label>Wachtwoord:</label><br>
        <input type="password" name="password1">
    </div>
    <div class="input-group"><br>
        <label>Herhaling Wachtwoord:</label><br>
        <input type="password" name="password2">
    </div>
    <div class="input-group">
        <br><button type="submit" name="submit_registration">Registreer!</button>
    </div>
    <p>
        Already registered? <a href="index.php?page=login">Log in</a>.
    </p>
</form>